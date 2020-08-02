@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-12">
        {{ Form::model($user,['route'=>['users.update',$user['id']], 'files'=>true,'method'=>'PUT']) }}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Data Pegawai</h3>
            </div>
            <div class="card-body">
                @if(!empty($errors->all()))
                <div class="alert alert-danger">
                    {{ Html::ul($errors->all())}}
                </div>
                @endif

                <div class="row">
                    <div class="col-md-12 cropcenter">
                        <img class="rounded" src="{{ asset('storage/'.$user['foto'])}}" width="100%" height="200">
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('nip', 'NIP') }}
                            {{ Form::text('nip', $user['nip'], ['class'=>'form-control', 'placeholder'=>'Masukkan NIP']) }}         
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('nama', 'Nama Pegawai') }}
                            {{ Form::text('nama', $user['nama'], ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Pegawai']) }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        {{ Form::label('jenis_kelamin', 'Jenis Kelamin') }}
                        <div class="radio">
                            <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="L"  {{ ($user['jenis_kelamin']=="L")? "checked" : "" }} >Laki - Laki</label>
                        </div>
                        <div class="radio">
                            <input type="radio" id="jenis_kelamin" name="jenis_kelamin" value="P" {{ ($user['jenis_kelamin']=="P")? "checked" : "" }} >Perempuan</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('Departemen', 'Departemen') }}
                                {{ Form::text('department_id', $user['department_id'], ['class'=>'form-control', 'placeholder'=>'Masukkan Departemen']) }}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('Jabatan', 'Jabatan') }}
                                {{ Form::text('jabatan_id', $user['jabatan_id'], ['class'=>'form-control', 'placeholder'=>'Masukkan Jabatan']) }}
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
                <a href="{{ URL::to('users') }}" class="btn btn-outline-info">Back</a>
                {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
            </div>
        </div>
        <!-- </form> -->
        {{ Form::close() }}
    </div>
</div>
@endsection