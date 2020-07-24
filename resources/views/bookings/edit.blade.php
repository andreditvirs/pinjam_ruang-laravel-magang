@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-12">
        {{ Form::model($room,['route'=>['rooms.update',$room['id']], 'files'=>true,'method'=>'PUT']) }}
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
                        <img class="rounded" src="{{ asset('storage/'.$room['foto'])}}" width="100%" height="200">
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('nama', 'Nama') }}
                            {{ Form::text('nama', $room['nama'], ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Ruangan']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('kapasitas', 'Kapasitas Ruangan') }}
                            {{ Form::text('kapasitas', $room['kapasitas'], ['class'=>'form-control', 'placeholder'=>'Masukkan Harga Ruangan']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('lantai', 'Lantai') }}
                            <select name="lantai" class="form-control">
                                <option value="1" {{ $room['lantai']=='1'?'selected':'' }}>1</option>
                                <option value="2" {{ $room['lantai']=='2'?'selected':'' }}>2</option>
                                <option value="3" {{ $room['lantai']=='3'?'selected':'' }}>3</option>
                                <option value="4" {{ $room['lantai']=='4'?'selected':'' }}>4</option>
                            </select>        
                        </div>
                        <div class="form-group">
                            {{ Form::hidden('foto',$room['foto'])}}
                            {{ Form::label('foto', 'Foto') }}
                            {{ Form::file('foto', ['class'=>'form-control']) }}        
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        {{ Form::label('fasilitas', 'Deskripsi Fasiltas') }}
                        {{ Form::textarea('fasilitas', $room['fasilitas'], ['class'=>'form-control', 'placeholder'=>'Enter description', 'rows'=>5]) }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ URL::to('rooms') }}" class="btn btn-outline-info">Back</a>
                {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
            </div>
        </div>
        <!-- </form> -->
        {{ Form::close() }}
    </div>
</div>
@endsection