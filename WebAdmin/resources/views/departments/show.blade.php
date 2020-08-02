@extends('lte/adminlte')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Departemen</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input id="name" type="text" value="{{ $department['nama']}}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="user_nama">ID Kepala Departemen</label>
                                <input id="user_nama" type="text" value="{{ $department['kepala_id'] }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ URL::to('departments') }}" class="btn btn-outline-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection