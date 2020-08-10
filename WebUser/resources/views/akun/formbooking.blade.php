@extends('layouts.layoutform')
@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('bookings') }}">
        @csrf
        <span class="login100-form-title p-b-32">
          Pinjam Ruangan
        </span>
        <div class="container p-b-11">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <span class="txt1 p-b-11">
                        Nama Ruangan
                    </span>
                    <div class="mb-3 validate-input m-b-36">
                        <select class="custom-select" name="r_id" required>
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
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <span class="txt1 p-b-11">
                        Waktu Mulai
                    </span>
                    <input name="tanggal_mulai" type="text" class="datepicker-here form-control wrap-input100 validate-input m-b-36" data-timepicker="true" data-language='en'>
                </div>
            </div>
            <div class="col-md-6">
            <div class="form-group">
                <span class="txt1 p-b-11">
                    Waktu Selesai
                </span>
                <input name="tanggal_selesai" type="text" class="datepicker-here form-control wrap-input100 validate-input m-b-36" data-timepicker="true" data-language='en'>
            </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <span class="txt1 p-b-11">
                        Keperluan
                    </span>
                    <textarea name="keperluan" class="form-control is-invalid wrap-input100 validate-input m-b-36" id="validationTextarea" placeholder="Tuliskan kepentingan Anda" required></textarea>
                </div>
            </div>
        </div>
    
        <span class="txt1">
            Upload Surat Izin
            <br><br>    
            <input class="form-control-file " type="file" name="foto" required>
          </span>

          <a href="{{ URL::to('bookings/status') }}"><button type="button" class="btn btn-outline-info btn-lg mt-5">Kembali</button></a>
        <button type="submit" class="btn btn-info btn-lg float-right mt-5">Submit</button>
    </div>
  </form>
</div>
@endsection