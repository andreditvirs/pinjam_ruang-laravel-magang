@extends('layouts.layoutform')
@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('register') }} " enctype="multipart/form-data">
  @csrf
    <span class="login100-form-title p-b-32">
      Daftar Akun
    </span>
    <span class="txt1 p-b-11">
      NIP
    </span>
    <div class="wrap-input100 validate-input m-b-36" data-validate = "NIP harus diisi">
      <input class="input100" type="text" name="nip" required>
      <span class="focus-input100"></span>
    </div>

    <span class="txt1 p-b-11">
      Nama Lengkap
    </span>
    <div class="wrap-input100 validate-input m-b-36" data-validate = "Nama Lengkap harus diisi">
      <input class="input100" type="text" name="nama" required>
      <span class="focus-input100"></span>
    </div>

    <span class="txt1 p-b-11">
      Jenis Kelamin
    </span>
    <div class="input-group m-b-36 ml-4">
      <div class="form-check">
        <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="L" required>
        <label class="form-check-label" for="exampleRadios1">
          Laki-laki
        </label>
        </div>
        <div class="form-check ml-5">
        <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios2" value="P" required>
        <label class="form-check-label" for="exampleRadios2">
          Perempuan
        </label>
        </div>
    </div>

    <span class="txt1 p-b-11">
      Bidang
    </span>
    <div class="input-group m-b-36">
      <select class="wrap-input100 custom-select" data-validate="Bidang harus diisi" id="inputBidang" name="bidang" required>
        <option value="">-- Pilih salah satu --</option>
        <option value="1">Bidang Informasi Public</option>
        <option value="2">Bidang Komunikasi Public</option>
        <option value="3">Bidang Aplikasi Informatika</option>
        <option value="4">Bidang Infrastruktur TIK</option>
        <option value="5">Bidang Pengolahan Data dan Statistik</option>
        <option value="6">Sekretariat</option>
        <option value="7">UPTD</option>
        <option value="8">Jafung</option>
      </select>
    </div>

    <span class="txt1 p-b-11">
      Jabatan
    </span>
    <div class="input-group m-b-36">
      <select class="wrap-input100 custom-select" data-validate="Jabatan harus diisi" id="inputJabatan" name="jabatan" required>
        <option value="">-- Pilih salah satu --</option>
        <option value="1">Kepala Bidang</option>
        <option value="2">Sekertaris</option>
        <option value="3">Kasubagian</option>
        <option value="4">Anggota</option>
      </select>
    </div>

    <span class="txt1 p-b-11">
      Username
    </span>
    <div class="wrap-input100 validate-input m-b-36" data-validate = "Username harus diisi">
      <input class="input100" type="text" name="username" required>
      <span class="focus-input100"></span>
    </div>

    <span class="txt1 p-b-11">
      Password
    </span>
    <div class="wrap-input100 validate-input m-b-36" data-validate = "Password harus diisi">
      <span class="btn-show-pass">
        <i class="fa fa-eye"></i>
      </span>
      <input id="password" class="input100" type="password" name="password" required>
      <span class="focus-input100"></span>
    </div>

    <span class="txt1 p-b-11">
      Konfirmasi Password
    </span>
    <div class="wrap-input100 validate-input m-b-36" data-validate = "Password harus diisi">
      <span class="btn-show-pass">
        <i class="fa fa-eye"></i>
      </span>
      <input id="confirm_password" class="input100" type="password" name="confirm_password" required>
      <span class="focus-input100"></span>
    </div>
    <div class="registrationFormAlert" id="divCheckPasswordMatch" style="color: red"></div>

    <span class="txt1 ">
      Upload Foto
      <br><br>
      <input class="form-control-file " type="file" name="foto" required>
    </span>
    

    <div class="container-login100-form-btn m-t-36">
      <button class="login100-form-btn" type="submit" onclick="return validate()">
        Daftar
      </button>
    </div>
  </form>
</div>
<script type="text/javascript">
  function validate() {
      var password = document.getElementById("password").value;
      var confirmPassword = document.getElementById("confirm_password").value;
      if (password != confirmPassword) {
        $("#divCheckPasswordMatch").html("* Password tidak cocok");
        document.getElementById("confirm_password").focus();
          return false;
      }
      return true;
  }
</script>
@endsection