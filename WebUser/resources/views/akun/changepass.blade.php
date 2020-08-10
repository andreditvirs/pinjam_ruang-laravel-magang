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
    <input class="input100" type="text" name="new_password">
    <span class="focus-input100"></span>
  </div>

  <span class="txt1 p-b-11">
    Konfirmasi Password Baru
  </span>
  <div class="wrap-input100 validate-input m-b-36">
    <input class="input100" type="text" name="confirm_password">
    <span class="focus-input100"></span>
  </div>
    <a href="{{ URL::to('profile/edit') }}"><button type="button" class="btn btn-outline-info btn-lg">Kembali</button></a>
    <button type="submit" class="btn btn-info btn-lg">Submit</button>
  </form>
</div>
@endsection