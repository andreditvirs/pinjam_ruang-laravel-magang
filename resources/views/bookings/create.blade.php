@extends('lte.adminlte')
@section('content')   
    {{ Form::open(['route' => 'bookings.store', 'files' => true]) }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Pemesanan</h3>
        </div>
        <div class="card-body">
            @if(!empty($errors->all()))
            <div class="alert alert-danger">
                {{ Html::ul($errors->all())}}
            </div>
            @endif
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('nama_ruangan', 'nama_ruangan') }}
                        {{ Form::select('lantai', ['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4'], null,
                            ['class'=>'form-control']) }}   
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('Tanggal', 'Tanggal') }}
                        {{ Form::text('Tanggal', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Tanggal Peminjaman']) }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('Waktu_mulai', 'Waktu Mulai') }}
                        {{ Form::text('Waktu_mulai', '', ['class'=>'form-control', 'placeholder'=>'Masukkan waktu mulai']) }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('Waktu_selesai', 'Waktu selesai') }}
                        {{ Form::text('Waktu_selesai', '', ['class'=>'form-control', 'placeholder'=>'Masukkan waktu selesai']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('Kepentingan', 'Kepentingan') }}
                        {{ Form::textarea('kepentingan', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Kepentingan']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ URL::to('users') }}" class="btn btn-outline-info">Kembali</a>
>>>>>>> e0780970e7aa881b5f99b5510d2a1440ebdedce8
            {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
        </div>
    </div>
    <!-- </form> -->
    {{ Form::close() }}
@endsection