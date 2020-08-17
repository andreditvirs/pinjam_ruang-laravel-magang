@extends('lte.adminlte')
@section('content')
<div class="row">
    <div class="col-12">   
    {{ Form::open(['route' => 'bookings.store', 'files' => true]) }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Peminjaman</h3>
        </div>
        <div class="card-body">
            @if(!empty($errors->all()))
            <div class="alert alert-danger">
                {{ Html::ul($errors->all())}}
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger m-t-24">
                {{ session('error') }}
            </div>
            @endif


            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('r_id', 'ID Ruangan') }}
                        {{ Form::text('r_id', '', ['class'=>'form-control', 'placeholder'=>'Masukkan ID Ruangan']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('u_id', 'ID Peminjam') }}
                        {{ Form::text('u_id', '', ['class'=>'form-control', 'placeholder'=>'Masukkan ID Peminjam']) }}
                    </div>
                </div>
                </div>
                
                
                
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('tanggal_pinjam', 'Tanggal Peminjaman') }}
                        <input name="tanggal_pinjam" type="text" class="datepicker-here form-control" data-language='en' required>
                        </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('waktu_mulai', 'Waktu Mulai') }}
                       
                       <div class= style="margin-top:10px;float:left;">
                            <input name="waktu_mulai" id="timepkr" style="width:100px;float:left;" class="wrap-input100 form-control" placeholder="HH:MM" required/>
                            <button class="btn btn-primary" onclick="showpickers('timepkr',24)" style="width:40px;float:left;"><i class="fa fa-clock-o"></i>
                        </div>
                    <div class="timepicker"></div> 
                        </div>
                    </div>
                    <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('waktu_selesai', 'Waktu Selesai') }}
                        <div class= style="margin-top:10px;float:left;">
                            <input name="waktu_selesai"id="timepkr1" style="width:100px;float:left;" class="wrap-input100 form-control" placeholder="HH:MM" required />
                            <button class="btn btn-primary" onclick="showpickers('timepkr1',24)" style="width:40px;float:left;"><i class="fa fa-clock-o"></i>
                          </div>
                      <div class="timepicker1"></div> 
                        </div>
                </div>
            </div>
                
            <div class="row">
                 <div class="col-md-6">
                            <div class="form-group">
                                <label for="status">Keperluan</label>
                                <input name="keperluan"id="status" type="text"  class="form-control" required/>
                            </div>
                        </div>
            </div>
            <div class="row">
                    <div class="col-md-4">  
                        <div class="form-group">
                            {{ Form::label('file', 'Foto Surat Izin') }}
                            {{ Form::file('file', ['class'=>'form-control','required'=>true]) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ URL::to('bookings') }}" class="btn btn-outline-info">Back</a>
                {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
            </div>
        </div>
        <!-- </form> -->
        {{ Form::close() }}
    </div>
</div>
@endsection