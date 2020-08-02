@extends('lte.adminlte')
@section('content')   
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
            <div class="row">
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('r_id', 'ID Ruangan') }}
                        {{ Form::text('r_id', '', ['class'=>'form-control', 'placeholder'=>'Masukkan ID Ruangan']) }}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('u_id', 'ID Peminjam') }}
                        {{ Form::text('u_id', '', ['class'=>'form-control', 'placeholder'=>'Masukkan ID Peminjam']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('tanggal_mulai', 'Tanggal Mulai)') }}
                        <input name="tanggal_mulai" type="text" class="datepicker-here form-control" data-timepicker="true" data-language='en'>
                        </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('tanggal_selesai', 'Tanggal Selesai') }}
                        <input name="tanggal_selesai" type="text" class="datepicker-here form-control" data-timepicker="true" data-language='en'>
                        </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">  
                    <div class="form-group">
                        {{ Form::label('keperluan', 'Keperluan') }}
                        {{ Form::textarea('keperluan', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Keperluan']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ URL::to('bookings') }}" class="btn btn-outline-info">Kembali</a>
            {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
        </div>
    </div>
    <!-- </form> -->
    {{ Form::close() }}
@endsection