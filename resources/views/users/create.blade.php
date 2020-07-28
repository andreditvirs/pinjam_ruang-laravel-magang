@extends('lte.adminlte')
@section('content')   
    {{ Form::open(['route' => 'users.store', 'files' => true]) }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah User</h3>
        </div>
        <div class="card-body">
            @if(!empty($errors->all()))
            <div class="alert alert-danger">
                {{ Html::ul($errors->all())}}
            </div>
            @endif
            
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('nip', 'NIP') }}
                        {{ Form::text('Nip', '', ['class'=>'form-control', 'placeholder'=>'Masukkan NIP']) }}         
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('nama', 'Nama Pegawai') }}
                        {{ Form::text('nama', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Pegawai']) }}
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        {{ Form::label('jenis_kelamin', 'Jenis Kelamin') }}
                        {{ Form::text('jenis_kelamin', '', ['class'=>'form-control', 'placeholder'=>'Jenis Kelamin']) }}
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('Departemen', 'Departemen') }}
                            {{ Form::text('Departemen', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Departemen']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('Jabatan', 'Jabatan') }}
                            {{ Form::text('Jabatan', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Jabatan']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('foto', 'Foto Pegawai') }}
                            {{ Form::file('foto', ['class'=>'form-control']) }}        
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
        <div class="card-footer">
            <a href="{{ URL::to('users') }}" class="btn btn-outline-info">Kembali</a>
            {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
        </div>
    </div>
    <!-- </form> -->
    {{ Form::close() }}
@endsection