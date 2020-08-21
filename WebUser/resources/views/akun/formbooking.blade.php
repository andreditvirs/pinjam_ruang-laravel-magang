@extends('layouts.layoutform')
@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    <form class="login100-form validate-form flex-sb flex-w" method="POST" action="{{ route('bookings1') }}">
        @csrf
        <span class="login100-form-title">
          Pinjam Ruangan
        </span>
        <div class="container p-b-32">
            <div class="row bs-wizard" style="border-bottom:0;">
                @if (Cache::has('booking_r_id'.Cookie::get('access_token')))
                <div class="col-md-4 bs-wizard-step complete">    
                @else
                <div class="col-md-4 bs-wizard-step active">    
                @endif
                  <div class="text-center bs-wizard-stepnum">Step 1</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="{{ URL::to('bookings/step/1')}}" class="bs-wizard-dot"></a>
                  <div class="bs-wizard-info text-center ml-3 mr-3">Masukkan Ruangan dan Tanggal Peminjaman</div>
                </div>
                @if (Cache::has('booking_r_id'.Cookie::get('access_token')))
                <div class="col-md-4 bs-wizard-step complete">    
                @else
                <div class="col-md-4 bs-wizard-step disabled">    
                @endif
                    <div class="text-center bs-wizard-stepnum">Step 2</div>
                    <div class="progress"><div class="progress-bar"></div></div>
                    <a href="{{ URL::to('bookings/step/2')}}" class="bs-wizard-dot"></a>
                    <div class="bs-wizard-info text-center ml-3 mr-3">Masukkan Keperluan Peminjaman</div>
                  </div>

                @if (Cache::has('booking_r_id'.Cookie::get('access_token')) && Cache::has('booking_keperluan'.Cookie::get('access_token')))
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
                        Nama Ruangan
                    </span>
                    <div class="mt-3 validate-input m-b-36">
                        <select class="custom-select" name="r_id" required>
                        <option value="">Pilih salah satu</option>
                        <option value="1">{{ Cache::get('1_nama')}}</option>
                        <option value="2">{{ Cache::get('2_nama')}}</option>
                        <option value="3">{{ Cache::get('3_nama')}}</option>
                        <option value="4">{{ Cache::get('4_nama')}}</option>
                        <option value="5">{{ Cache::get('5_nama')}}</option>
                        </select>
                        <div class="invalid-feedback">Harus diisi!</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <div class="col-md-4">
                <div class="form-group">
                    <span class="txt1">
                        Tanggal Peminjaman
                    </span>
                <input value="{{ Cache::get('booking_tanggal_pinjam'.Cookie::get('access_token'))}}" name="tanggal_pinjam" type="text" class="mt-3 datepicker-here form-control wrap-input100 validate-input m-b-36" data-language='en' placeholder="Gunakan kalender pop-up" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <span class="txt1 p-b-11">
                        Waktu Mulai
                    </span>
                    <div class="mt-3" style="margin-top:10px;float:left;">
                        <input value="{{ Cache::get('booking_waktu_mulai'.Cookie::get('access_token'))}}" id="timepkr" name="waktu_mulai" style="width:100px;float:left;" class="wrap-input100 form-control" placeholder="HH:MM" required />
                        <button type="button" class="btn btn-primary" onclick="showpickers('timepkr',24)" style="width:40px;float:left;"><i class="fa fa-clock-o"></i>
                      </div>
                  <div class="timepicker"></div> 
                </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <span class="txt1 p-b-11">
                            Waktu Selesai
                        </span>
                        <div class="mt-3" style="margin-top:10px;float:left;">
                            <input value="{{ Cache::get('booking_waktu_selesai'.Cookie::get('access_token'))}}" id="timepkr1" name="waktu_selesai" style="width:100px;float:left;" class="wrap-input100 form-control" placeholder="HH:MM" required/>
                            <button type="button" class="btn btn-primary" onclick="showpickers('timepkr1',24)" style="width:40px;float:left;"><i class="fa fa-clock-o"></i>
                          </div>
                      <div class="timepicker1"></div> 
                    </div>
                    </div>
        </div>
        
          @if (session('alert'))
          <div class="alert alert-danger m-t-24">
              {{ session('alert') }}
          </div>
          @endif

        <a href="{{ URL::to('bookings/status') }}"><button type="button" class="btn btn-outline-info btn-lg mt-5">Kembali</button></a>
        <button type="submit" class="btn btn-info btn-lg float-right mt-5">Submit</button>
    </div>
  </form>
</div>
@endsection