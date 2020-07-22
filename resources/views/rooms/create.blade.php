@extends('lte.adminlte')
@section('content')   
    {{ Form::open(['route' => 'rooms.store', 'files' => true]) }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Ruangan</h3>
        </div>
        <div class="card-body">
            @if(!empty($errors->all()))
            <div class="alert alert-danger">
                {{ Html::ul($errors->all())}}
            </div>
            @endif
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('nama', 'Nama Ruangan') }}
                        {{ Form::text('nama', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Ruangan']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('kapasitas', 'Kapasitas Ruangan') }}
                        {{ Form::text('kapasitas', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Kapasitas Ruangan']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    
                    <div class="form-group">
                        {{ Form::label('lantai', 'Lantai') }}
                        {{ Form::select('lantai', ['1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4'], null,
                            ['class'=>'form-control']) }}        
                    </div>
                    <div class="form-group">
                        {{ Form::label('foto', 'Gambar Ruangan') }}
                        {{ Form::file('foto', ['class'=>'form-control']) }}        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    {{ Form::label('fasilitas', 'Deskripsi Fasilitas') }}
                    {{ Form::textarea('fasilitas', '', ['class'=>'form-control', 'placeholder'=>'Enter description', 'rows'=>5]) }}
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ URL::to('rooms') }}" class="btn btn-outline-info">Kembali</a>
            {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
        </div>
    </div>
    <!-- </form> -->
    {{ Form::close() }}
@endsection