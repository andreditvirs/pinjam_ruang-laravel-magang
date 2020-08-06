@extends('layouts.layoutform')
@section('content')
<form>
    <h2>Pinjam Ruangan</h2>
    <br>
    <div class="form-group">
        <label for="">NIP</label>
        <input name="nip" class="form-control " type="text" placeholder="NIP" disabled>
    </div>

    <div class="form-group">
        <label for="">Nama Lengkap</label>
        <input name="profile_nama" class="form-control" type="text" placeholder="Nama" disabled>
    </div>

    <div class="form-group">
        <label for="username">Username</label>
        <input name="profile_username" class="form-control" type="text" placeholder="Username" disabled>
    </div>


    <div class="form-group">
        <label for="">Keperluan</label>
        <textarea name="booking_keperluan" class="form-control is-invalid" id="validationTextarea" placeholder="Kepentingan" required></textarea>
    
    </div>


    <div class="form-group">
        <label for="">Nama Ruangan</label>
        <div class="mb-3">
            <select class="custom-select" name="_booking_namaruangan" required>
              <option value="">Pilih salah satu</option>
              <option value="1">Ruang Aula</option>
              <option value="2">Ruang Smart Province</option>
              <option value="3">Ruang Rapat Kadis</option>
              <option value="4">Ruang Komando</option>
              <option value="5">Ruang Workshop</option>
            </select>
            <div class="invalid-feedback">Harus diisi!</div>
          </div>
    </div>

    <div class="form-group">
        <label for="">Waktu Mulai</label>
        <input name="tanggal_mulai" type="text" class="datepicker-here form-control m-b-36" data-timepicker="true" data-language='en'>
    </div>

    <div class="form-group">
        <label for="">Waktu Selesai</label>
        <input name="tanggal_selesai" type="text" class="datepicker-here form-control m-b-36" data-timepicker="true" data-language='en'>
    </div>

    <div class="form-group">
        <label for="">Upload surat izin</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="surat_izin" required>
            <label class="custom-file-label" for="surat_izin">Pilih file...</label>
            <div class="invalid-feedback">file tidak valid</div>
        </div>
    </div>

    <br>
    <button type="submit" class="btn btn-outline-info btn-lg">Submit</button>
  </form>
@endsection