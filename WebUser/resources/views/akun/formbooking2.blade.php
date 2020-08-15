@extends('layouts.layoutform')
@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('bookings2') }}">
        @csrf
        <span class="login100-form-title">
          Pinjam Ruangan
        </span>
        <div class="container p-b-32">
            <div class="row bs-wizard" style="border-bottom:0;">
                @if (Cache::has('booking_r_id'))
                <div class="col-md-4 bs-wizard-step complete">    
                @else
                <div class="col-md-4 bs-wizard-step active">    
                @endif
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="{{ URL::to('bookings/step/1')}}" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center ml-3 mr-3">Masukkan Ruangan dan Tanggal Peminjaman</div>
                </div>
                @if (Cache::has('booking_keperluan'))
                <div class="col-md-4 bs-wizard-step complete">    
                @else
                <div class="col-md-4 bs-wizard-step active">    
                @endif
                    <div class="text-center bs-wizard-stepnum">Step 2</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="{{ URL::to('bookings/step/2')}}" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center ml-3 mr-3">Masukkan Keperluan Peminjaman</div>
                  </div>

                @if (Cache::has('booking_r_id') && Cache::has('booking_keperluan'))
                <div class="col-md-4 bs-wizard-step complete">    
                @else
                <div class="col-md-4 bs-wizard-step disabled">    
                @endif
                    <div class="text-center bs-wizard-stepnum">Step 3</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="{{ URL::to('bookings/step/3')}}" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center ml-3 mr-3">Upload Bukti Peminjaman</div>
                  </div>
            </div>
        </div>
        <div class="container p-b-11">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <span class="txt1 p-b-11">
                        Keperluan
                    </span>
                    <textarea onKeyPress="if(this.value.length==50) return false;" name="keperluan" class="form-control is-invalid wrap-input100 validate-input m-b-36" id="validationTextarea" placeholder="Tuliskan kepentingan Anda" required>{{ Cache::get('booking_keperluan')}}</textarea>
                </div>
            </div>
        </div>

          @if (session('alert'))
          <div class="alert alert-danger m-t-24">
              {{ session('alert') }}
          </div>
          @endif

          <a href="{{ URL::to('bookings/step/1') }}"><button type="button" class="btn btn-outline-info btn-lg mt-5">Kembali</button></a>
        <button type="submit" class="btn btn-info btn-lg float-right mt-5">Submit</button>
    </div>
  </form>
</div>
@endsection