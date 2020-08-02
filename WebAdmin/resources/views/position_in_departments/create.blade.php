@extends('lte.adminlte')
@section('content')   
    {{ Form::open(['route' => 'position_in_departments.store', 'files' => true]) }}
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Jabatan</h3>
        </div>
        <div class="card-body">
            @if(!empty($errors->all()))
            <div class="alert alert-danger">
                {{ Html::ul($errors->all())}}
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        {{ Form::label('nama', 'Nama Jabatan') }}
                        {{ Form::text('nama', '', ['class'=>'form-control', 'placeholder'=>'Masukkan Nama Jabatan']) }}
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ URL::to('position_in_departments') }}" class="btn btn-outline-info">Kembali</a>
            {{ Form::submit('Proses', ['class' => 'btn btn-primary pull-right']) }}
        </div>
    </div>
    <!-- </form> -->
    {{ Form::close() }}
@endsection