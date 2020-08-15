@extends('layouts.layoutform')
@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
<form method="POST" action="{{ route('changepass')}}">
  @csrf
  <span class="login100-form-title p-b-32">
    Ubah Password
  </span>
  <span class="txt1 p-b-11">
    Password Lama
  </span>
  <div class="wrap-input100 validate-input m-b-36">
    <input class="input100" type="text" name="old_password">
    <span class="focus-input100"></span>
  </div>

  <span class="txt1 p-b-11">
    Password Baru
  </span>
  <div class="wrap-input100 validate-input m-b-36">
    <input class="input100" type="text" name="new_password" id="new_password">
    <span class="focus-input100"></span>
  </div>

  <span class="txt1 p-b-11">
    Konfirmasi Password Baru
  </span>
  <div class="wrap-input100 validate-input m-b-36">
    <input class="input100" type="text" name="confirm_password" id="confirm_password">
    <span class="focus-input100"></span>
  </div>
    <a href="{{ URL::to('profile/edit') }}"><button type="button" class="btn btn-outline-info btn-lg">Kembali</button></a>
    <button type="submit" class="btn btn-info btn-lg" onclick="return validate()">Submit</button>
    <div class="registrationFormAlert" id="divCheckPasswordMatch" style="color: red"></div>
  </form>
</div>
<script type="text/javascript">
  function validate() {
      var password = document.getElementById("new_password").value;
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