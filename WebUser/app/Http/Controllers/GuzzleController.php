<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Illuminate\Support\Carbon;
use Cookie;
use Cache;

class GuzzleController extends Controller
{
  
  private $ip_address;
  private $path_in_server;

  // Jika ingin mengubah ip server, silahkan diganti disini
  public function __construct(){
    $this->ip_address = "http://192.168.43.147/";
    $this->path_in_server = "pinjam_ruang_diskominfo_jatim/WebAdmin/public/";
  }

  public function addCache($key, $value){
    Cache::forever($key.Cookie::get('access_token'), $value);
    return;
  }

  public function addCookie($key, $value){
    Cookie::queue(Cookie::make($key, $value, 60));
    return;
  }
  
  public function deleteCookie($key){
    if(Cookie::has($key.Cookie::get('access_token'))){
      Cookie::forget($key.Cookie::get('access_token'));
    }
  }

  public function login(Request $request){
      $this->deleteCookie('username');
      $this->deleteCookie('nama');
      $this->deleteCookie('nip');
      $this->deleteCookie('jabatan');
      $this->deleteCookie('bidang');
      $this->deleteCookie('foto');

        $client = new Client();
        $result = $client->post($this->ip_address.$this->path_in_server.'api/auth/login', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded'],
          'form_params' => [
              'username' => $request->username,
              'password' => $request->password,
            ],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        
        if(!$json['error']){
          $access_token = $json['success']['token'];
          $addres_web_server = $this->ip_address.$this->path_in_server.'storage/'; // Merujuk ke penyimpanan Server
          $this->addCookie('access_token', $access_token);
          $this->addCookie('address_web_server', $addres_web_server);
          if($this->validasiUser($access_token)){
            $this->detail($access_token); // Mengisi identitas profil di beranda
            $this->getRoom($access_token); // Mendapatkan informasi mengenai ruangan di beranda
            return redirect('home');
          }else{
            return redirect('login')->with('alert', 'Harap menggunakan data yang valid');
          }
        }else{
          return redirect('login')->with('alert', 'Username atau Password salah');
        }
  }

  public function register (Request $request){
        $client = new Client();
        $imagePath = $request->file('foto')->getPathName();
        $result = $client->post($this->ip_address.$this->path_in_server.'api/auth/register', [
          'headers' => ['Accept' => 'application/json'],
          'multipart' => [
            [
              'name'     => 'nip',
              'contents' => $request->nip,
            ],
            [
              'name'     => 'nama',
              'contents' => $request->nama,
            ],
            [
              'name'     => 'jenis_kelamin',
              'contents' => $request->jenis_kelamin,
            ],
            [
              'name'     => 'department_id',
              'contents' => $request->bidang,
            ],
            [
              'name'     => 'jabatan_id',
              'contents' => $request->jabatan,
            ],
            [
              'name'     => 'username',
              'contents' => $request->username,
            ],
            [
              'name'     => 'password',
              'contents' => $request->password,
            ],
            [
              'name'     => 'foto',
              'contents' => fopen($imagePath, 'r'), // buat ngambil gambarnya bukan pathnya
            ],
          ],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        
        if(!$json['error']){
          return redirect('login');
        }else{ 
          if ($json['msg']=='Username'){
            return redirect('register')->with('alert', 'Username telah digunakan');
          }
          if ($json['msg']=='Nip'){
              return redirect('register')->with('alert', 'NIP telah digunakan');
          }
          
          return redirect('register')->with('alert', 'Ada kesalahan terhadap data Anda, Mohon daftar kembali!');
        }
  }

  public static function getBooking($access_token){
      $client = new Client();
      $result = $client->post('http://192.168.43.147/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/bookings/', [
        'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'verify' => false,
      ]);
      $json = json_decode($result->getBody(), true);
      Cache::forget('bookings'.Cookie::get('access_token'));
      Cache::forever('bookings'.Cookie::get('access_token'), $json);
       
      if(!$json['error']){
        return redirect('login');
      }else{ 
        return;
      }
  }

  public function getFilterBooking(Request $request){
    $r_id = $request->r_id;
    $tanggal_pinjam = $request->tanggal_pinjam;
    $waktu_mulai = $request->waktu_mulai;
    $waktu_selesai = $request->waktu_selesai;
    $access_token = Cookie::get('access_token');
    if(!(is_null($r_id) && is_null($tanggal_pinjam) && is_null($waktu_mulai) && is_null($waktu_selesai))){
      $client = new Client();
      $result = $client->post($this->ip_address.$this->path_in_server.'api/bookings/filter', [
        'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
        'form_params' => [
          'r_id' => $r_id,
          'tanggal_pinjam' => $tanggal_pinjam,
          'waktu_mulai' => $waktu_mulai,
          'waktu_selesai' => $waktu_selesai,
        ],
        'verify' => false,
      ]);
      $json = json_decode($result->getBody(), true);
      if(!$json['error']){
        if(Cache::has('bookings'.Cookie::get('access_token'))){
          Cache::forget('bookings'.Cookie::get('access_token'));
          Cache::forever('bookings'.Cookie::get('access_token'), $json); // Memasukkan filter_booking ke dalam cache bookings
          return redirect('home')->with('filter_booking', true); // Mengindikasikan kalau cache masih mengandung filter_booking bukan semua booking
        }
      }else{
        return redirect('home');
      }  
    }else{
      return redirect('home');
    }
  }
    
  public function booking1(Request $request){
    // Cek dahulu bolehkan peminjaman dilakukan?
    $r_id = $request->r_id;
    $tanggal_pinjam = $request->tanggal_pinjam;
    $waktu_mulai = $request->waktu_mulai;
    $waktu_selesai = $request->waktu_selesai;
    $access_token = Cookie::get('access_token');

    $hari_pinjam = substr($tanggal_pinjam, 0, 2);
    $bulan_pinjam = substr($tanggal_pinjam, 3, 2);
    $tahun_pinjam = substr($tanggal_pinjam, 6, 4);

    $jam_mulai = substr($waktu_mulai, 0, 2);
    $menit_mulai = substr($waktu_mulai, 3, 2);
    
    $jam_selesai = substr($waktu_selesai, 0, 2);
    $menit_selesai = substr($waktu_selesai, 3, 2);

    $date = Carbon::createFromDate($tahun_pinjam, $bulan_pinjam, $hari_pinjam, 'GMT');
    $startTime = Carbon::createFromTime($jam_mulai, $menit_mulai, 00, 'GMT');
    $endTime = Carbon::createFromTime($jam_selesai, $menit_selesai, 00, 'GMT');

    if(Carbon::now()->gte($date)){
      return redirect('bookings/step/1')->with('alert', 'Mohon maaf, sewa dengan tanggal setelah/sama dengan hari ini');
    }

    if($startTime->gte($endTime)){
      return redirect('bookings/step/1')->with('alert', 'Mohon ambil waktu diantara waktu mulai dan selesai dengan benar');
    }

    $cekAvaiableBooking = $this->getAvailableBooking($r_id, $tanggal_pinjam, $waktu_mulai, $waktu_selesai);
    if(!$cekAvaiableBooking){
      return redirect('bookings/step/1')->with('alert', 'Mohon maaf, ruangan telah dipinjam beberapa waktu lalu');
    }else{
      $this->addCache('booking_r_id', $r_id);
      $this->addCache('booking_tanggal_pinjam', $tanggal_pinjam);
      $this->addCache('booking_waktu_mulai', $waktu_mulai);
      $this->addCache('booking_waktu_selesai', $waktu_selesai);
      return redirect('bookings/step/2');
    }
  }

  public function booking2(Request $request){
    $this->addCache('booking_keperluan', $request->keperluan);
    return redirect('bookings/step/3');
  }

  public function booking3(Request $request){
        $client = new Client();
        $access_token = Cookie::get('access_token');
        $username = Cookie::get('username');
        $r_id = Cache::get('booking_r_id'.Cookie::get('access_token'));
        $tanggal_pinjam = Cache::get('booking_tanggal_pinjam'.Cookie::get('access_token'));
        $waktu_mulai = Cache::get('booking_waktu_mulai'.Cookie::get('access_token'));
        $waktu_selesai = Cache::get('booking_waktu_selesai'.Cookie::get('access_token'));
        $keperluan = Cache::get('booking_keperluan'.Cookie::get('access_token'));
        $imagePath = $request->file('file')->getPathName();

        $hari_pinjam = substr($tanggal_pinjam, 0, 2);
        $bulan_pinjam = substr($tanggal_pinjam, 3, 2);
        $tahun_pinjam = substr($tanggal_pinjam, 6, 4);
        $tanggal_pin = $tahun_pinjam.'-'.$bulan_pinjam.'-'.$hari_pinjam;
    
        $jam_mulai = substr($waktu_mulai, 0, 2);
        $menit_mulai = substr($waktu_mulai, 3, 2);
        $waktu_mul = $waktu_mulai.':00';
        
        $jam_selesai = substr($waktu_selesai, 0, 2);
        $menit_selesai = substr($waktu_selesai, 3, 2);
        $waktu_sel = $waktu_selesai.':00';

        $result = $client->post($this->ip_address.$this->path_in_server.'api/bookings', [
          'headers' => ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$access_token],
            'multipart' => [
              [
                'name'     => 'r_id',
                'contents' => $r_id,
              ],
              [
                'name'     => 'username',
                'contents' => $username,
              ],
              [
                'name'     => 'tanggal_pinjam',
                'contents' => $tanggal_pin,
              ],
              [
                'name'     => 'waktu_mulai',
                'contents' => $waktu_mul,
              ],
              [
                'name'     => 'waktu_selesai',
                'contents' => $waktu_sel,
              ],
              [
                'name'     => 'keperluan',
                'contents' => $keperluan,
              ],
              [
                'name'     => 'file',
                'contents' => fopen($imagePath, 'r'),
              ],
            ],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        if(!$json['error']){
           Cache::forget('booking_r_id'.Cookie::get('access_token'));
          Cache::forget('booking_tanggal_pinjam'.Cookie::get('access_token'));
          Cache::forget('booking_waktu_mulai'.Cookie::get('access_token'));
          Cache::forget('booking_waktu_selesai'.Cookie::get('access_token'));
          Cache::forget('booking_keperluan'.Cookie::get('access_token')); //agar ketika user booking lagi, inputan hilang
          return redirect('bookings/status')->with('alert', 'Peminjaman Ruang Berhasil');
        }else{
          if($json['msg'] == 'Unvalid'){
            return redirect('bookings/step/1')->with('alert', 'Data Peminjaman Tidak Valid');
          }else if($json['msg'] == 'Not Available'){
            return redirect('bookings/step/1')->with('alert', 'Ruangan telah dipinjam beberapa saat lalu, Silahkan segarkan kembali halaman peminjaman');
          }else{
            return redirect('bookings/step/1')->with('alert', 'Server sedang dalam perbaikan');
          }
        }
  }

    public function editprofile (Request $request){
      $client = new Client();
      $imagePath = $request->file('foto')->getPathName();
      $access_token = Cookie::get('access_token');
      $result = $client->post($this->ip_address.$this->path_in_server.'api/auth/editprofile', [
        'headers' => ['Accept' => 'application/json', 'Authorization' => 'Bearer '.$access_token],
        'multipart' => [
          [
            'name'     => 'nip',
            'contents' => Cookie::get('nip'), // Tidak perlu mengganti cookie yang lama
          ],
          [
            'name'     => 'nama',
            'contents' => $request->nama,
          ],
          [
            'name'     => 'jenis_kelamin',
            'contents' => $request->jenis_kelamin,
          ],
          [
            'name'     => 'department_id',
            'contents' => $request->edit_departemen, //according to the name of input form in view.
          ],
          [
            'name'     => 'jabatan_id',
            'contents' => $request->edit_jabatan,
          ],
          [
            'name'     => 'username',
            'contents' => $request->username,
          ],
          [
            'name'     => 'foto',
            'contents' => fopen($imagePath, 'r'),
          ],
        ],
          'verify' => false,
      ]);
      $json = json_decode($result->getBody(), true);
      if(!$json['error']){
        // Lupakan semua cookie
        Cookie::forget('username');
        Cookie::forget('nama');
        Cookie::forget('jabatan');
        Cookie::forget('bidang');
        Cookie::forget('foto');
        // Atur cookie baru
        $this->detail(Cookie::get('access_token'));
        return redirect('home');
      }else{
        return redirect('editprofile');
      }
    }

    public function changepass (Request $request){
        $client = new Client();
        $access_token = Cookie::get('access_token');
        $result = $client->post($this->ip_address.$this->path_in_server.'api/auth/change_password', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'form_params' => [
              //yang awal dikirim ke database, yg $request-><nama> itu dari name di html
              'old_password' => $request->old_password,
              'new_password' => $request->new_password,
            ],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        // var_dump($request->old_password);
        $json = json_decode($result->getBody(), true);
      if(!$json['error']){
        return redirect('editprofile')->with('alert', 'Berhasil Edit Passsword.');
      }else{
        return redirect('changepass')->with('alert', 'Gagal Edit Password');
      }
      
    }

    public function detail($access_token){
        $client = new Client();
        $result = $client->post($this->ip_address.$this->path_in_server.'api/auth/details', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],]);
        $json = json_decode($result->getBody(), true);
        if(!$json['error']){
          $this->addCookie('username', $json['profile']['username']);
          $this->addCookie('nama', $json['profile']['nama']);
          $this->addCookie('nip', $json['profile']['nip']);
          $this->addCookie('jabatan', $json['profile']['position_in_department_name']);
          $this->addCookie('bidang', $json['profile']['department_name']);
          $this->addCookie('foto', $json['profile']['foto']);
          return $json;
        }else{
          return;
        }
    }

    public function logout(){
        $client = new Client();
        $cookie = Cookie::get('access_token');
        $access_token = $cookie;
        $result = $client->post($this->ip_address.$this->path_in_server.'api/auth/logout', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],]);
        // $json = json_decode($result->getBody(), true);
        Cookie::queue(Cookie::forget('access_token'));
        Cache::forget('user_booking'.Cookie::get('access_token'));
        Cache::forget('bookings'.Cookie::get('access_token'));
        return redirect('/');
    }

    public function getRoom($access_token){
        $client = new Client();
        $result = $client->post($this->ip_address.$this->path_in_server.'api/rooms/', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        foreach($json['rooms'] as $room){
          $this->addCache($room['id'].'_nama', $room['nama']);
          $this->addCache($room['id'].'_lantai', $room['lantai']);
          $this->addCache($room['id'].'_kapasitas', $room['kapasitas']);
          $this->addCache($room['id'].'_fasilitas', $room['fasilitas']);
          $this->addCache($room['id'].'_foto', $room['foto']);
        }
        return;
    }

    public static function getUserBooking($access_token){
        $client = new Client();
        $access_token = Cookie::get('access_token');
        $username = Cookie::get('username');
        $result = $client->get('http://192.168.43.147/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/bookings/get_user_booking/'.$username, [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        Cache::forever('user_booking'.Cookie::get('access_token'), $json);
    }

    public function deleteUserBooking(Request $request){
      $client = new Client();
      $access_token = Cookie::get('access_token');
      $result = $client->post($this->ip_address.$this->path_in_server.'api/bookings/delete', [
        'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
        'form_params' => [
          'r_id' => $request->r_id,
          'tanggal_pinjam' => $request->tanggal_pinjam,
          'waktu_mulai' => $request->waktu_mulai,
          'waktu_selesai' => $request->waktu_selesai
        ],
          'verify' => false,
      ]);
      
      $json = json_decode($result->getBody(), true);
      if(!$json['error']){
        return redirect('bookings/status')->with('alert', 'Peminjaman Ruang Berhasil Dibatalkan');
      }else{
        return redirect('bookings/status')->with('alert', 'Peminjaman Ruang Gagal Dibatalkan');
      }
    }

    // public static function getAvailableBooking($access_token){ 
    //   $client = new Client();
    //     $result = $client->get($this->ip_address.$this->path_in_server.'api/get_available_booking',[
    //       'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
    //         'verify' => false,
    //     ]);
    //     $json = json_decode($result->getBody(), true);
    //     if(!$json['error']){
    //       Cache::forever('available_booking', $json);
    //     }
    // }

    public function getAvailableBooking($r_id, $tanggal_pinjam, $waktu_mulai, $waktu_selesai){
      $access_token = Cookie::get('access_token');
      if(!(is_null($r_id) && is_null($tanggal_pinjam) && is_null($waktu_mulai) && is_null($waktu_selesai))){
        $client = new Client();
        $result = $client->post($this->ip_address.$this->path_in_server.'api/bookings/filter', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'form_params' => [
            'r_id' => $r_id,
            'tanggal_pinjam' => $tanggal_pinjam,
            'waktu_mulai' => $waktu_mulai,
            'waktu_selesai' => $waktu_selesai,
          ],
          'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        if(!$json['error']){
          if(count($json['bookings']) == 0){
            return true;
          }else{
            return false;
          }
        }else{
          return false;
        }  
      }else{
        return false;
      }
    }

    public static function validasiUser($access_token){ //called at homeauth to check if user has accesstoken
      $client = new Client();
      $result = $client->post('http://192.168.43.147/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/auth/details', [
        'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],]);
      $json = json_decode($result->getBody(), true);
      if($json['error']){
        return false;
      }
      return true;
    }
  }
