@extends('lte/adminlte')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Peminjaman</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 cropcenter">
                            <img class="rounded" src="{{ asset('storage/'.$booking['file']) }}"
                                height="200" width="100%"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">       
                            <div class="form-group">
                                <label for="name">ID Ruangan</label>
                                <input id="name" type="text" value="{{ $booking['r_id'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="price">ID Peminjam</label>
                                <input id="price" type="text" value="{{ $booking['u_id'] }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('tanggal_pinjam', 'Tanggal Peminjaman') }}
                        <input name="tanggal_mulai" type="text" class="datepicker-here form-control" data-language='en' disabled> 
                        </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('waktu_mulai', 'Waktu Mulai') }}
                       {{--<input name="waktu_mulai" type="text" class="datepicker-here form-control" data-timepicker="true" data-language='en' placeholder="Gunakan kalender pop-up " >--}}
                       <div class= style="margin-top:10px;float:left;">
                            <input id="timepkr" style="width:100px;float:left;" class="wrap-input100 form-control" placeholder="HH:MM" disabled />
                            <button class="btn btn-primary" onclick="showpickers('timepkr',24)" style="width:40px;float:left;"><i class="fa fa-clock-o"></i>
                        </div>
                    <div class="timepicker"></div> 
                        </div>
                    </div>

                    <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('waktu_selesai', 'Waktu Selesai') }}
                        {{--<input name="waktu_selesai" type="text" class="datepicker-here form-control" data-timepicker="true" data-language='en' placeholder="Gunakan kalender pop-up">--}}
                        <div class= style="margin-top:10px;float:left;">
                            <input id="timepkr1" style="width:100px;float:left;" class="wrap-input100 form-control" placeholder="HH:MM" disabled />
                            <button class="btn btn-primary" onclick="showpickers('timepkr1',24)" style="width:40px;float:left;"><i class="fa fa-clock-o"></i>
                          </div>
                      <div class="timepicker1"></div> 
                        </div>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Keperluan</label>
                                <input id="status" type="text" value="{{ $booking['keperluan'] }}" class="form-control" disabled />
                            </div>
                        </div>
            </div>
                <div class="card-footer">
                    <a href="{{ URL::to('bookings') }}" class="btn btn-outline-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection