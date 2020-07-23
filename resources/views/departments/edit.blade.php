@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-12">
        {{ Form::model($department,['route'=>['departments.update',$department['id']], 'method'=>'PUT']) }}
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Ubah Data Departemen</h3>
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
                            {{ Form::label('nama', 'Nama') }}
                            {{ Form::text('nama', $department['nama'], ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Departemen']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            {{ Form::label('kepala_id', 'ID Kepala Departemen') }}
                            {{ Form::text('kepala_id', $department['kepala_id'], ['class'=>'form-control', 'placeholder'=>'Masukkan Harga Departemen']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <a href="{{ URL::to('departments') }}" class="btn btn-outline-info">Back</a>
                {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
            </div>
        </div>
        <!-- </form> -->
        {{ Form::close() }}
    </div>
</div>
@endsection