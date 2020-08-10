@extends('layouts.layoutform')
@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
<form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('editprofile') }}" enctype="multipart/form-data" >
  @csrf
  <span class="login100-form-title p-b-32">
    Edit Profile
  </span>
    <span class="txt1 p-b-11">
      NIP
    </span>
    <div class="wrap-input100 validate-input m-b-36">
      <input class="input100" type="text" name="nip"  value="{{ Cookie::get('nip') }}" disabled>
      <span class="focus-input100"></span>
    </div>

    <span class="txt1 p-b-11">
      Username
    </span>
    <div class="wrap-input100 validate-input m-b-36" data-validate = "Username harus diisi">
      {{-- untuk mengisi nama di dalam form, di ambil dari detail() dg memanggil cookie --}}
    <input class="input100" type="text" name="username" value="{{ Cookie::get('username') }}"> 
      <span class="focus-input100"></span>
    </div>

    <span class="txt1 p-b-11">
      Nama Lengkap
    </span>
    <div class="wrap-input100 validate-input m-b-36" data-validate = "Nama Lengkap harus diisi">
      {{-- untuk mengisi nama di dalam form, di ambil dari detail() dg memanggil cookie --}}
    <input class="input100" type="text" name="nama" value="{{ Cookie::get('nama') }}" required> 
      <span class="focus-input100"></span>
    </div>

    <span class="txt1 p-b-11">
      Jenis Kelamin
    </span>
    <div class="input-group m-b-20 ml-4">
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

    <div class="row m-b-50 w-100">
    <div class="form-group w-50 p-l-20 p-r-20">
      <span class="txt1 p-b-11">
        Bidang
      </span>
        <div class="mb-3">
            <select class="custom-select" name="edit_departemen">
              <option value="">Pilih salah satu</option>
              <option value="1">Bidang Informasi Public</option>
              <option value="2">Bidang Komunikasi Public</option>
              <option value="3">Bidang Aplikasi Informatika</option>
              <option value="4">Bidang Infrastruktur TIK</option>
              <option value="5">Bidang Pengolahan Data dan Statistik</option>
              <option value="6">Sekretariat</option>
              <option value="7">UPTD</option>
              <option value="8">Jafung</option>
            </select>
            <div class="invalid-feedback">Harus diisi!</div>
          </div>
    </div>

    <div class="form-group w-50 p-l-20 p-r-20">
      <span class="txt1 p-b-11">
        Jabatan
      </span>
        <div class="mb-3">
            <select class="custom-select" name="edit_jabatan">
              <option value="">Pilih salah satu</option>
              <option value="1">Ketua Bidang</option>
              <option value="2">Wakil Ketua Bidang</option>
              <option value="3">Sekertaris</option>
            </select>
            <div class="invalid-feedback">Harus diisi!</div>
          </div>
    </div>

    <div class="w-100 p-l-20">
      <span class="txt1 p-b-11">
        Ganti Foto
        <input class="form-control-file" type="file" name="foto" required>
      </span>
  </div>
  </div>
<a href="{{ URL::to('home') }}"><button type="button" class="btn btn-outline-info btn-lg">Kembali</button></a>
<a href="{{ URL::to('profile/password/edit') }}" class="btn btn-info btn-lg">
      <svg width="1em" height="1em" viewBox="0 0 13 13" class="bi bi-key-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M3.5 11.5a3.5 3.5 0 1 1 3.163-5H14L15.5 8 14 9.5l-1-1-1 1-1-1-1 1-1-1-1 1H6.663a3.5 3.5 0 0 1-3.163 2zM2.5 9a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
      </svg>
      Ubah Password 
    </a>
    <button type="submit" class="btn btn-info btn-lg">Submit</button>
  </form>
</div>
@endsection