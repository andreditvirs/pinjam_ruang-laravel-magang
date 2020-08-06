<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Cookie\CookieJar;
use Cookie;

class GuzzleController extends Controller
{
    public function login(Request $request){
        $client = new Client();
        // $cookieJar = new CookieJar();
        $result = $client->post('http://127.0.0.1/pinjam_ruang_bitbucket/WebAdmin/public/api/auth/login', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded'],
          'form_params' => [
              'username' => $request->username,
              'password' => $request->password,
            ],
            // 'cookies' => $cookieJar,
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        $access_token = $json["success"]["token"];
        Cookie::queue(Cookie::make('access_token', $access_token, 60));
        
        $this->detail($access_token);
        return redirect('home');
      }

      public function settingCookie($key, $value){
        Cookie::queue(Cookie::make($key, $value, 60));
        return;
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
            // 'cookies' => $cookieJar,
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        $message_succes = $json["success"];
        return redirect('login');
      }


      public function booking(Request $request){
        $client = new Client();
        $access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiNDU2NjkyODBjZTFmMThkMGFjNjc5NmYzMTUwZDlhY2Y5NzgzMWFiMWEzMTMyMDBjZmYwMjdjMGM5MWY3ZWU2ZDcwN2RjY2ZlOTZjMWEyYzIiLCJpYXQiOjE1OTY1MTUzMTEsIm5iZiI6MTU5NjUxNTMxMSwiZXhwIjoxNjI4MDUxMzExLCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.nWL-UnYhfDjyHUKORR0tyFh2mX43yHfFFV88bCCP5fhI5wGIWPFxoUF3CYbCeddjnX-zrfVZflWxY2xJpqS01BrSbS9kUR4VNA0sEONaGRPtmbauMBKawlx94rnSyf76toDrXHRwqDoQ-dmZm3a2fYsDi7fLYuNOzc98soxPBuhyd5yduTDabNi6EwwKGMbZy5l1Q5vA3VszDwGzLodhxWEaNvEm12KUH5qmu81uOqF-Vb5GVJn5eCcipxB4EBrY4WceLKfLJvYInoD9EC7XnLdl2bt5fmGUps04UUgsFmEEeRz-blpGPiWab7OYXqtPWFI87a5fE59mhmcWIQj705VspMcuTpDTKeG43FJ-_bDKrX5YMpaH8V6BNL-Xjh0f0lLA6_Q09NF3UeFeGQUHOEXmisVQOjaWulQ1wNzBcTeJ27_KwrOmdN6hSiirXkFfFn9F432ttKCf9grtxd85tSugL8e7bLCm2E7F9oEjvQAfOqBvfAjDo_csU8o82zBanjb0vqs9Ap4zvJ6MDA1qKaYjHByrXPT-Daz_K0sJiudItufyO3bwApYGaWm1_WxxcfMi5C7LRUvAFoHKgoi0JS2AkOovhqUe0-bGGsY_9Y2ZOGa9rqugHnGBq0fGgMSe02E9R4Nz2BJ2ktcP4qMzc-ZPDM4O7B_vYeUBHFein5g";
        // $access_token = Cookie::get('access_token');
        // echo $access_token;
        // $cookieJar = new CookieJar();
        // echo $request->username.$request->password;
        $result = $client->post('http://127.0.0.1/pinjam_ruang_bitbucket/WebAdmin/public/api/bookings', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'form_params' => [
              'r_id' => $request->r_id,
              'u_id' => $request->u_id,
              'tanggal_mulai' => $request->tanggal_mulai,
              'tanggal_selesai' => $request->tanggal_selesai,
              'keperluan' => $request->keperluan,
            ],
            // 'cookies' => $cookieJar,
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        // $access_token = $json["success"]["token"];
        // Cookie::queue(Cookie::make('access_token', $access_token, 60));
        // $value = Cookie::get('access_token');
        // echo $value;
        return view('coba', compact('json'));
      }

      public function changepassword (Request $request){
        $client = new Client();
        $access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMjY1M2E0ZDIxNmFlZDk1OTcxMmE1MzEzOWJiN2JkMThhOTNmMDVkNmMwMzI5YzIxOTJjYzliYmM0NDkwY2RiOTcwZjJiODQxODkyZWY5ZTEiLCJpYXQiOjE1OTY2MDcwMzYsIm5iZiI6MTU5NjYwNzAzNiwiZXhwIjoxNjI4MTQzMDM2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.iYjypKXaZ_APOHNqtwhFQL3mFcWYPZSLlWHE14s7bVdo80HP8SBJ5UqhIqCeYYCuWO9IrFMiG59YP5TR7tTolCSAGXiMioPrakkYqTWpv4QAO1jQKK9HCdMAqDO5YEqK2E1yPDJmMzJaFXJ_ukXKLABEiteODkVXBFdqyCqq4qajB0X2kb0AorK-L1FGpwmebyEhnzmV0D_uNLEBQjb26WhCSjcoBjZwYBZHcQ3DQgZGn79gef4z6x1DGHHEgawQDXnPd6fvZlaB4w7ydM1c9ulMzlLfAKhYdWnq4HHH7TU7X20GsWn7rs4t8XRztarDN9a9tSfSis11IijSwbfYnuLhgwaTBlg3uCNie6CtRH4OFKZe2nFJqbhmrrWsmWqx1aitibVjVrE0Qst8c5NKYW0MYa8fIwiCVC9t3-Pe8OYWUWgwutRnSS7htqWbDcy8hlcrnJ8Q123VU5NlUloNOjjO-Acv-4r5RkcSZ7hZiDBSdPrRkGs3U-c6O83lzGKEvnSczeE06prR42ZaMktMbTCuX82W3m3uSHKsFyaiQ4G1zI_TSKRcwFe6T3xVGTsXcxkrrOCNpTTYSh02lbpqVIEK8Il8bNMOnLcACoVtUeMpogQ94k-kIlMoGmII0nWebxpKhrG3Jf3AQRaLYBvv23R5W3IdBjstjVjOjOUlieo";
        // $cookieJar = new CookieJar();
        // echo $request->username.$request->password;
        $result = $client->post('http://localhost/pinjam_ruang_diskominfo_jatim/WebAdmin/public/api/auth/change_password', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
          'form_params' => [
              //yang awal dikirim ke database, yg $request-><nama> itu dari name di html
              'old_password' => $request->old_password,
              'new_password' => $request->new_password,
              'confirm_pasword'  => $request->confirm_password,
            ],
            // 'cookies' => $cookieJar,
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        $message_succes = $json["success"];
        // Cookie::queue(Cookie::make('access_token', $access_token, 60));
        // $value = Cookie::get('access_token');
        var_dump ($message_succes);
        //echo $message_succes;
        // return view('coba', compact('json'));
      }

      public function detail($access_token){
        $client = new Client();
        $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/auth/details', [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],]);
        $json = json_decode($result->getBody(), true);
        $this->settingCookie('nama', $json['profile']['nama']);
        $this->settingCookie('nip', $json['profile']['nip']);
        $this->settingCookie('jabatan', $json['profile']['position_in_department_name']);
        $this->settingCookie('bidang', $json['profile']['department_name']);
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
        return redirect('/');
      }

      public function detailroom(Request $request){
        $client = new Client();
        $access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiY2Q4Y2I0MDcwODgzNzdjYjYzZmEzZTBlY2VkZWRhNjAxMGNhNTM3ZmYxMDc3MGU5NDJkODYyNmFiMTFlNTY3ODA1ZDM5NWM3MjFmN2RjZjgiLCJpYXQiOjE1OTY2MDk2NTksIm5iZiI6MTU5NjYwOTY1OSwiZXhwIjoxNjI4MTQ1NjU5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Vf4w2hSlP0xsLRxO9NY2jRXkYTX9-wxwcEOM_blSUZXABvjAfaMkHo-tYAZINsVNTR61_q8lst4jiegrua6Yr9P463hkoFwg8XNUWPbbAtChPQi3hRfgFbfjxZx_qYyviFgTsP6jD7WNckJI6aWbUqHzd5uKeLvTZScdMiBZmG8cin5fOX7NSBDXP6xqp8VGML0OGip76spVJo6cpSw51K3a7jBwDCEdK5vAvlVcNeIh9_agL_v1W4TN4jwIdNCulkJQAUExFDpHCorFp058h8oYy1Z1SVWjqNsFB6QOiyblaWMenR2Zd5EJ6oa6y95MWeAHd0zZU9-_o3Z7U24xvD1IxcugBkhr5CGZPjgDnrTOIejmEn6gViF7N5N9iSeE-Xd2o67nP_0zjaLiAP_P5NEMDxXNksfAdR2XJnkjhWUnybrxEcav6Q05MsGLeeul2kM9HIOYFdCfVe1SJWsPwMXhYFvxgFTi5sKTFqJw40EWNbuQLs6emt8Uc5pO0U3S9UzdKEW3QwrvFFGvztK0Rz9HjHHzs6i4sYHNIHrdl1xDRTKjKTiL1RsIaJlHZTJS3z9Tjr3Jmng_Ydt_zPrgo1eq3QED436dltaEFqMy7xC5yvnSlKRx9DZY0331w5o1YRSiKls1eDNt7-gnYjXftXUgIEZhTXxXueKzMk1xxpk";
        // $access_token = Cookie::get('access_token');
        // echo $access_token;
        // $cookieJar = new CookieJar();
        // echo $request->username.$request->password;
        $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/detailromms/'.$request->r_id, [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
            // 'cookies' => $cookieJar,
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        // $access_token = $json["success"]["token"];
        // Cookie::queue(Cookie::make('access_token', $access_token, 60));
        // $value = Cookie::get('access_token');
        // echo $value;
        return view('coba', compact('json'));
      }
public function detailpeminjaman(Request $request){
        $client = new Client();
        $access_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiY2Q4Y2I0MDcwODgzNzdjYjYzZmEzZTBlY2VkZWRhNjAxMGNhNTM3ZmYxMDc3MGU5NDJkODYyNmFiMTFlNTY3ODA1ZDM5NWM3MjFmN2RjZjgiLCJpYXQiOjE1OTY2MDk2NTksIm5iZiI6MTU5NjYwOTY1OSwiZXhwIjoxNjI4MTQ1NjU5LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Vf4w2hSlP0xsLRxO9NY2jRXkYTX9-wxwcEOM_blSUZXABvjAfaMkHo-tYAZINsVNTR61_q8lst4jiegrua6Yr9P463hkoFwg8XNUWPbbAtChPQi3hRfgFbfjxZx_qYyviFgTsP6jD7WNckJI6aWbUqHzd5uKeLvTZScdMiBZmG8cin5fOX7NSBDXP6xqp8VGML0OGip76spVJo6cpSw51K3a7jBwDCEdK5vAvlVcNeIh9_agL_v1W4TN4jwIdNCulkJQAUExFDpHCorFp058h8oYy1Z1SVWjqNsFB6QOiyblaWMenR2Zd5EJ6oa6y95MWeAHd0zZU9-_o3Z7U24xvD1IxcugBkhr5CGZPjgDnrTOIejmEn6gViF7N5N9iSeE-Xd2o67nP_0zjaLiAP_P5NEMDxXNksfAdR2XJnkjhWUnybrxEcav6Q05MsGLeeul2kM9HIOYFdCfVe1SJWsPwMXhYFvxgFTi5sKTFqJw40EWNbuQLs6emt8Uc5pO0U3S9UzdKEW3QwrvFFGvztK0Rz9HjHHzs6i4sYHNIHrdl1xDRTKjKTiL1RsIaJlHZTJS3z9Tjr3Jmng_Ydt_zPrgo1eq3QED436dltaEFqMy7xC5yvnSlKRx9DZY0331w5o1YRSiKls1eDNt7-gnYjXftXUgIEZhTXxXueKzMk1xxpk";
        // $access_token = Cookie::get('access_token');
        // echo $access_token;
        // $cookieJar = new CookieJar();
        // echo $request->username.$request->password;
        $result = $client->post('http://localhost/pinjam_ruang_bitbucket/WebAdmin/public/api/detailpeminjamans/'.$request->r_id, [
          'headers' => ['Accept' => 'application/json', 'Content-Type' => 'application/x-www-form-urlencoded', 'Authorization' => 'Bearer '.$access_token],
            // 'cookies' => $cookieJar,
            'verify' => false,
        ]);
        $json = json_decode($result->getBody(), true);
        // $access_token = $json["success"]["token"];
        // Cookie::queue(Cookie::make('access_token', $access_token, 60));
        // $value = Cookie::get('access_token');
        // echo $value;
        return view('coba', compact('json'));
      }


}
