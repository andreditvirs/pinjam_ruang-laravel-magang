<!DOCTYPE html>
<html lang="en">
<head>
	<title>Daftar - Sewa Ruangan</title>
	<link rel="icon" type="image/png" href="{{ asset('assets/img/imageslogo.jpg') }}" />
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('akun/css/main.css') }}">
<!--===============================================================================================-->
</head>

<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
				<form class="login100-form validate-form flex-sb flex-w">
					<span class="login100-form-title p-b-32">
						Daftar Akun
					</span>

					<span class="txt1 p-b-11">
						NIP
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "NIP harus diisi">
						<input class="input100" type="text" name="NIP" >
						<span class="focus-input100"></span>
					</div>

					<span class="txt1 p-b-11">
						Nama Lengkap
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Nama Lengkap harus diisi">
						<input class="input100" type="text" name="NamaLengkap" >
						<span class="focus-input100"></span>
					</div>

					<span class="txt1 p-b-11">
						Jenis Kelamin
					</span>
					<div class="input-group m-b-36 ml-4">
						<div class="form-check">
							<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
							<label class="form-check-label" for="exampleRadios1">
							  Laki-laki
							</label>
						  </div>
						  <div class="form-check ml-5">
							<input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
							<label class="form-check-label" for="exampleRadios2">
							  Perempuan
							</label>
						  </div>
					</div>

					<span class="txt1 p-b-11">
						Bidang
					</span>
					<div class="input-group m-b-36">
						<select class="wrap-input100 custom-select" data-validate="Jenis Kelamin harus diisi" id="inputJenisKelamin">
							<option value="Bidang Teknologi dan Informatika">Bidang Teknologi dan Informatika</option>
							<option value="Bidang">Bidang gak tau</option>
						</select>
					</div>

					<span class="txt1 p-b-11">
						Jabatan
					</span>
					<div class="input-group m-b-36">
						<select class="wrap-input100 custom-select" data-validate="Jenis Kelamin harus diisi" id="inputJenisKelamin">
							<option value="Kabid 1">Kabid 1</option>
							<option value="Kabid 2">Kabid 2</option>
						</select>
					</div>

					<span class="txt1 p-b-11">
						Username
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Username harus diisi">
						<input class="input100" type="text" name="Username" >
						<span class="focus-input100"></span>
					</div>


					<!-- buat login -->

					<span class="txt1 p-b-11">
						Password
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Password harus diisi">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" >
						<span class="focus-input100"></span>
					</div>

					<span class="txt1 p-b-11">
						Konfirmasi Password
					</span>
					<div class="wrap-input100 validate-input m-b-36" data-validate = "Password harus diisi">
						<span class="btn-show-pass">
							<i class="fa fa-eye"></i>
						</span>
						<input class="input100" type="password" name="pass" >
						<span class="focus-input100"></span>
					</div>
					
					<!-- <div class="flex-sb-m w-full p-b-48">
						<div class="contact100-form-checkbox">
							<input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
							<label class="label-checkbox100" for="ckb1">
								Remember me
							</label>
						</div>

						<div>
							<a href="#" class="txt3">
								Forgot Password?
							</a>
						</div>
					</div> -->

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Daftar
						</button>
					</div>

				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	

<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('akun/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('akun/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('akun/js/main.js') }}"></script>

</body>
</html>