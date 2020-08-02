@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-12">
        {{ Form::model($booking,['route'=>['bookings.update',$booking['id']], 'files'=>true,'method'=>'PUT']) }}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Data Peminjaman</h3>
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
                            {{ Form::text('r_id', $booking['r_id'], ['class'=>'form-control', 'placeholder'=>'Masukkan ID Ruangan']) }}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            {{ Form::label('u_id', 'ID Peminjam') }}
                            {{ Form::text('u_id', $booking['u_id'], ['class'=>'form-control', 'placeholder'=>'Masukkan ID Peminjam']) }}
                        </div>
                    </div>
                    <div class="col-md-4">                    
                        <div class="form-group">
                            {{ Form::label('tanggal_mulai', 'tanggal_mulai') }}
                            {{ Form::text('tanggal_mulai', $booking['tanggal_mulai'], ['class'=>'form-control', 'placeholder'=>'Masukkan Tanggal Mulai']) }}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            {{ Form::label('tanggal_selesai', 'tanggal_selesai') }}
                            {{ Form::text('tanggal_selesai', $booking['tanggal_selesai'], ['class'=>'form-control', 'placeholder'=>'Masukkan Tanggal Selesai']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">  
                        <div class="form-group">
                            {{ Form::label('keperluan', 'Keperluan') }}
                            {{ Form::textarea('keperluan', $booking['keperluan'], ['class'=>'form-control', 'placeholder'=>'Masukkan Keperluan']) }}
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