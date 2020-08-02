@extends('lte/adminlte')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Pegawai</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 cropcenter">
                            <img class="rounded" src="{{ asset('storage/'.$user['foto']) }}"
                                height="200" width="100%"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">NIP</label>
                                <input id="name" type="text" value="{{ $user['nip'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-6">    
                            <div class="form-group">
                                <label for="price">Nama</label>
                                <input id="price" type="text" value="{{ $user['nama'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="status">Jenis Kelamin</label>
                                <input id="status" type="text" value="{{ $user['jenis_kelamin'] }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Username</label>
                                <input id="description" type="text" value="{{ $user['username'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="description">Departemen</label>
                                <input id="description" type="text" value="{{ $user['department_id'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="jabatan">Jabatan</label>
                                <input id="jabatan" type="text" value="{{ $user['jabatan_id'] }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ URL::to('users') }}" class="btn btn-outline-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection