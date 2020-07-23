@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-12">
        {{ Form::model($user,['route'=>['users.update',$user['id']], 'files'=>true,'method'=>'PUT']) }}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Data Ruangan</h3>
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
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('nama', 'Nama') }}
                            {{ Form::text('nama', $user['nama'], ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Ruangan']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('kapasitas', 'Kapasitas Ruangan') }}
                            {{ Form::text('kapasitas', $user['kapasitas'], ['class'=>'form-control', 'placeholder'=>'Masukkan Harga Ruangan']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('lantai', 'Lantai') }}
                            <select name="lantai" class="form-control">
                                <option value="1" {{ $user['lantai']=='1'?'selected':'' }}>1</option>
                                <option value="2" {{ $user['lantai']=='2'?'selected':'' }}>2</option>
                                <option value="3" {{ $user['lantai']=='3'?'selected':'' }}>3</option>
                                <option value="4" {{ $user['lantai']=='4'?'selected':'' }}>4</option>
                            </select>        
                        </div>
                        <div class="form-group">
                            {{ Form::hidden('foto',$user['foto'])}}
                            {{ Form::label('foto', 'Foto') }}
                            {{ Form::file('foto', ['class'=>'form-control']) }}        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ Form::label('fasilitas', 'Deskripsi Fasiltas') }}
                        {{ Form::textarea('fasilitas', $user['fasilitas'], ['class'=>'form-control', 'placeholder'=>'Enter description', 'rows'=>5]) }}
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