<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Cookie;
use Cache;

class GuzzleController extends Controller
{
  public function addCache($key, $value){
    Cache::forever($key, $value);
    return;
  }

  public function addCookie($key, $value){
    Cookie::queue(Cookie::make($key, $value, 60));
    return;
  }
  
  public function login(Request $request){
        $client = new Client();
        $result = $client->post('http://127.0.0.1/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/auth/login', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded'],
          'form_params' => [
              'username' => $request->username,
              'password' => $request->password,
            ],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        
        if(!$json['error']){
          $access_token = $json["success"]["token"];
          $addres_web_server = 'http://127.0.0.1/pinjam_ruang_diskominfo_jatim/WebAdmin/public/storage/'; // Merujuk ke penyimpanan Server
          $this->addCookie('access_token', $access_token);
          $this->addCookie('address_web_server', $addres_web_server);
          
          $this->detail($access_token); // Mengisi identitas profil di beranda
          $this->getRoom($access_token); // Mendapatkan informasi mengenai ruangan di beranda
          return redirect('home');
        }else{
          return redirect('login')->with('alert', 'Username atau Password salah');
        }
  }

  public function register (Request $request){
        $client = new Client();
        $imagePath = $request->file('foto')->getPathName();
        $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/auth/register', [
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
              'contents' => fopen($imagePath, 'r'),
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
      $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/bookings/', [
        'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'verify' => false,
      ]);
      $json = json_decode($result->getBody(), true);
      Cache::forget('bookings');
      Cache::forever('bookings', $json);
      return;
  }

  public function getFilterBooking(Request $request){
    $r_id = $request->r_id;
    $tanggal_pinjam = $request->tanggal_pinjam;
    $waktu_mulai = $request->waktu_mulai;
    $waktu_selesai = $request->waktu_selesai;
    $access_token = Cookie::get('access_token');
    if(!(is_null($r_id) && is_null($tanggal_pinjam) && is_null($waktu_mulai) && is_null($waktu_selesai))){
      $client = new Client();
      $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/bookings/filter', [
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
        if(Cache::has('bookings')){
          Cache::forget('bookings');
          Cache::forever('bookings', $json); // Memasukkan filter_booking ke dalam cache bookings
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
    $this->addCache('booking_r_id', $request->r_id);
    $this->addCache('booking_tanggal_pinjam', $request->tanggal_pinjam);
    $this->addCache('booking_waktu_mulai', $request->waktu_mulai);
    $this->addCache('booking_waktu_selesai', $request->waktu_selesai);
    return redirect('bookings/step/2');
  }

  public function booking2(Request $request){
    $this->addCache('booking_keperluan', $request->keperluan);
    return redirect('bookings/step/3');
  }

  public function booking3(Request $request){
        $client = new Client();
        $access_token = Cookie::get('access_token');
        $username = Cookie::get('username');
        $r_id = Cache::get('booking_r_id');
        $tanggal_pinjam = Cache::get('booking_tanggal_pinjam');
        $waktu_mulai = Cache::get('booking_waktu_mulai');
        $waktu_selesai = Cache::get('booking_waktu_selesai');
        $keperluan = Cache::get('booking_keperluan');
        $imagePath = $request->file('file')->getPathName();

        $result = $client->post('http://127.0.0.1/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/bookings', [
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
                'contents' => $tanggal_pinjam,
              ],
              [
                'name'     => 'waktu_mulai',
                'contents' => $waktu_mulai,
              ],
              [
                'name'     => 'waktu_selesai',
                'contents' => $waktu_selesai,
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
           Cache::forget('booking_r_id');
          Cache::forget('booking_tanggal_pinjam');
          Cache::forget('booking_waktu_mulai');
          Cache::forget('booking_waktu_selesai');
          Cache::forget('booking_keperluan');
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
      $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/auth/editprofile', [
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
        $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/auth/change_password', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'form_params' => [
              //yang awal dikirim ke database, yg $request-><nama> itu dari name di html
              'old_password' => $request->old_password,
              'new_password' => $request->new_password,
              // 'confirm_pasword' => $request->confirm_password,
            ],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        // var_dump($request->old_password);
        return redirect('home');
    }

    public function detail($access_token){
        $client = new Client();
        $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/auth/details', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],]);
        $json = json_decode($result->getBody(), true);
        $this->addCookie('username', $json['profile']['username']);
        $this->addCookie('nama', $json['profile']['nama']);
        $this->addCookie('nip', $json['profile']['nip']);
        $this->addCookie('jabatan', $json['profile']['position_in_department_name']);
        $this->addCookie('bidang', $json['profile']['department_name']);
        $this->addCookie('foto', $json['profile']['foto']);
        return $json;
    }

    public function logout(){
        $client = new Client();
        $cookie = Cookie::get('access_token');
        $access_token = $cookie;
        $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/auth/logout', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],]);
        // $json = json_decode($result->getBody(), true);
        Cookie::queue(Cookie::forget('access_token'));
        Cache::forget('user_booking');
        Cache::forget('bookings');
        return redirect('/');
    }

    public function getRoom($access_token){
        $client = new Client();
        $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/rooms/', [
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
        $result = $client->get('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/bookings/get_user_booking/'.$username, [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        // var_dump($json);
        Cache::forever('user_booking', $json);
        // $this->addCache('booking_room', $json);
    }

    public function deleteUserBooking(Request $request){
      $client = new Client();
      $access_token = Cookie::get('access_token');
      $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/bookings/delete', [
        'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
        'form_params' => [
          'r_id' => $request->r_id,
        ],
          'verify' => false,
      ]);
      
      $json = json_decode($result->getBody(), true);
      var_dump($json);
      if(!$json['error']){
        return redirect('bookings/status')->with('alert', 'Peminjaman Ruang Berhasil Dibatalkan');
      }else{
        return redirect('bookings/status')->with('alert', 'Peminjaman Ruang Gagal Dibatalkan');
      }
    }

    public static function getAvailableBooking($access_token){
      $client = new Client();
        $result = $client->get('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/get_available_booking',[
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        if(!$json['error']){
          Cache::forever('available_booking', $json);
        }
    }

    public static function validasiUser($access_token){
      $client = new Client();
      $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/auth/details', [
        'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],]);
      $json = json_decode($result->getBody(), true);
      if($json['error']){
        return false;
      }
      return true;
    }
  }
