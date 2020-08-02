@extends('lte.adminlte')
@section('content')   
    {{ Form::open(['route' => 'departments.store']) }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Departemen</h3>
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
                        {{ Form::label('nama', 'Nama Departemen') }}
                        {{ Form::text('nama', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Departemen']) }}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        {{ Form::label('kepala_id', 'ID Kepala Departemen') }}
                        {{ Form::text('kepala_id', '', ['class'=>'form-control', 'placeholder'=>'Masukkan ID Kepala Departemen']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ URL::to('departments') }}" class="btn btn-outline-info">Kembali</a>
            {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
        </div>
    </div>
    <!-- </form> -->
    {{ Form::close() }}
@endsection