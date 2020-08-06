@extends('layouts.layoutform')
@section('content')
<form>
    <h2>Edit Profile</h2>

    <div class="d-flex justify-content-center" style="height: 150px; background-color:transparent;" >
      <img class="h-100 d-inline-block " style=" max-width: 250px; min-width: 200px; background-color: lavender" src="#" alt=""> 
    </div>
    


    <div class="form-group">
      <br>
        <label for="">Foto Profile</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="validatedCustomFile" >
            <label class="custom-file-label" for="validatedCustomFile">Pilih file...</label>
            <div class="invalid-feedback">file tidak valid</div>
        </div>
    </div>




    <div class="form-group">
        <label for="">NIP</label>
        <input class="form-control form-control-lg" type="text" placeholder="NIP" disabled>
    </div>

    <div class="form-group">
        <label for="">Nama Lengkap</label>
        <input name="profile_nama" class="form-control form-control-lg" type="text" placeholder="Nama">
    </div>

    <div class="form-group">
        <label for="">Jenis Kelamin</label><br>
        <div class="form-check form-check-inline">
            <div class="custom-control custom-radio" >
                <input value="L" type="radio" class="custom-control-input" id="customControlValidation2" name="radio-stacked" disabled>
                <label class="custom-control-label" for="customControlValidation2">Laki-laki</label>
              </div>
          </div>
          <div class="form-check form-check-inline">
            <div class="custom-control custom-radio mb-3 ml-5">
                <input value="P" type="radio" class="custom-control-input" id="customControlValidation3" name="radio-stacked" disabled>
                <label class="custom-control-label" for="customControlValidation3">Perempuan</label>
                <div class="invalid-feedback">Harus diisi!</div>
            </div>
          </div>
    </div>

    <div class="form-group">
        <label for="">Bidang</label>
        <div class="mb-3">
            <select class="custom-select" name="edit_departemen">
              <option value="">Pilih salah satu</option>
              <option value="1">Departemen Teknologi dan informatika</option>
              <option value="2">departemen 2</option>
              <option value="3">departemen 3</option>
            </select>
            <div class="invalid-feedback">Harus diisi!</div>
          </div>
    </div>

    <div class="form-group">
        <label for="">Jabatan</label>
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

    <div class="form-group">
        <label for="username">Username</label>
        <input class="form-control form-control-lg" type="text" placeholder="Username" name="edit_username" required>
    </div>

    <div class="form-group" >
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="edit_password" required>
    </div>

    <div class="form-group" >
        <label for="exampleInputPassword1">Konfirmasi Password</label>
        <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" name="edit_konfirmpassword" required>
    </div>
    <br>
    <button type="submit" class="btn btn-outline-info btn-lg">Kembali</button>
    <button type="button" class="btn btn-info btn-lg">Submit</button>
  </form>
@endsection