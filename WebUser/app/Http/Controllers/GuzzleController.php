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
        $result = $client->post('http://127.0.0.1/pinjam_ruang_bitbucket/WebAdmin/public/api/auth/login', [
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
          $addres_web_server = 'http://127.0.0.1/pinjam_ruang_bitbucket/WebAdmin/public/storage/'; // Merujuk ke penyimpanan Server
          $this->addCookie('access_token', $access_token);
          $this->addCookie('address_web_server', $addres_web_server);
          
          $this->detail($access_token); // Mengisi identitas profil di beranda
          $this->getRoom($access_token); // Mendapatkan informasi mengenai ruangan di beranda
          return redirect('home');
        }else{
          return redirect('login');
        }
  }

  public function register (Request $request){
        $client = new Client();
        $imagePath = $request->file('foto')->getPathName();
        $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/auth/register', [
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
          return redirect('register');
        }
  }

  public static function getBooking($access_token){
      $client = new Client();
      $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/bookings/', [
        'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'verify' => false,
      ]);
      $json = json_decode($result->getBody(), true);
      Cache::forever('bookings', $json);
      return;
  }
    
  public function booking(Request $request){
        $client = new Client();
        $access_token = Cookie::get('access_token');
        $username = Cookie::get('username');
        $result = $client->post('http://127.0.0.1/pinjam_ruang_bitbucket/WebAdmin/public/api/bookings', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'form_params' => [
              'r_id' => $request->r_id,
              'username' => $username,
              'tanggal_mulai' => $request->tanggal_mulai,
              'tanggal_selesai' => $request->tanggal_selesai,
              'keperluan' => $request->keperluan,
            ],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        if(!$json['error']){
          return redirect('bookings/status');
        }else{
          return redirect('bookings/create');
        }
        
  }

    public function editprofile (Request $request){
      $client = new Client();
      $imagePath = $request->file('foto')->getPathName();
      $access_token = Cookie::get('access_token');
      // $cookieJar = new CookieJar();
      // echo $request->username.$request->password;
      $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/auth/editprofile', [
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
          // 'cookies' => $cookieJar,
          'verify' => false,
      ]);
      $json = json_decode($result->getBody(), true);
      Cookie::put('username', $request->username);
      Cookie::put('nama', $request->nama);
      Cookie::put('jabatan', $request->edit_jabatan);
      Cookie::put('bidang', $request->username);
      return redirect('home');
    }
    public function changepass (Request $request){
        $client = new Client();
        $access_token = Cookie::get('access_token');
        $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/auth/change_password', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'form_params' => [
              //yang awal dikirim ke database, yg $request-><nama> itu dari name di html
              'old_password' => $request->old_password,
              'new_password' => $request->new_password,
              'confirm_pasword'  => $request->confirm_password,
            ],
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        return redirect('home');
    }

    public function detail($access_token){
        $client = new Client();
        $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/auth/details', [
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
        $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/auth/logout', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],]);
        // $json = json_decode($result->getBody(), true);
        Cookie::queue(Cookie::forget('access_token'));
        Cache::forget('user_booking');
        Cache::forget('bookings');
        return redirect('/');
    }

    public function getRoom($access_token){
        $client = new Client();
        $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/rooms/', [
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
        $result = $client->get('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/bookings/get_user_booking/'.$username, [
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
      $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/bookings/delete', [
        'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
        'form_params' => [
          'r_id' => $request->r_id,
        ],
          'verify' => false,
      ]);
      
      $json = json_decode($result->getBody(), true);
      var_dump($json);
      if(!$json['error']){
        return URL::to('bookings/status');
      }else{
        return URL::to('bookings/create');
      }
    }

  }
