@extends('layouts.layoutform')
@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
  <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('login') }}">
    @csrf
      <span class="login100-form-title p-b-32">
          Masuk
      </span>
      <span class="txt1 p-b-11">
          Username
      </span>
      <div class="wrap-input100 validate-input m-b-36" data-validate = "Username harus diisi">
          <input class="input100" type="text" name="username" >
          <span class="focus-input100"></span>
      </div>
      <span class="txt1 p-b-11">
          Password
      </span>
      <div class="wrap-input100 validate-input m-b-12" data-validate = "Password harus diisi">
          <span class="btn-show-pass">
              <i class="fa fa-eye"></i>
          </span>
          <input class="input100" type="password" name="password" >
          <span class="focus-input100"></span>
      </div>
      <div class="flex-sb-m w-full p-b-48">
          <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1">
                  Remember me
              </label>
          </div>
      </div>

      <div class="container-login100-form-btn">
        <button class="login100-form-btn" type="submit">
                Masuk
        </button>
      </div>
  </form>
</div>
@endsection