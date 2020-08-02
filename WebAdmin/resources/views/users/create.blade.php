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
                        {{ Form::text('nip', '', ['class'=>'form-control', 'placeholder'=>'Masukkan NIP']) }}         
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('nama', 'Nama Pegawai') }}
                        {{ Form::text('nama', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Pegawai']) }}
                    </div>
                </div>
                <div class="col-md-2">
                    {{ Form::label('jenis_kelamin', 'Jenis Kelamin') }}
                    <div class="radio">
                        <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="L" >Laki - Laki</label>
                    </div>
                    <div class="radio">
                        <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="P">Perempuan</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('Departemen', 'Departemen') }}
                        {{ Form::text('department_id', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Departemen']) }}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('Jabatan', 'Jabatan') }}
                        {{ Form::text('jabatan_id', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Jabatan']) }}
                        {{-- {!! Form::text('search_text', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text')) !!} --}}
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        {{ Form::label('foto', 'Foto Pegawai') }}
                        {{ Form::file('foto', ['class'=>'form-control']) }}        
                    </div>
                </div>                    
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('username', 'Username') }}
                        {{ Form::text('username', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Username']) }}    
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('password', 'Password') }}
                        {{ Form::input('password', 'password', '',['class'=>'form-control', 'placeholder'=>'Masukkan Password']) }}
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('password_confirmation', 'Konfirmasi Password') }}
                        {{ Form::input('password', 'password_confirmation', '',['class'=>'form-control', 'placeholder'=>'Masukkan Ulang Password']) }}
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