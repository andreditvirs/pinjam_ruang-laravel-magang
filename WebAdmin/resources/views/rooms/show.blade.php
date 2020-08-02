@extends('lte/adminlte')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Ruang</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 cropcenter">
                            <img class="rounded" src="{{ asset('storage/'.$room['foto']) }}"
                                height="200" width="100%"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">       
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input id="name" type="text" value="{{ $room['nama'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">Lantai</label>
                                <input id="price" type="text" value="{{ $room['lantai'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Kapasitas</label>
                                <input id="status" type="text" value="{{ $room['kapasitas'] }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="description">Fasilitas</label>
                                <input id="description" type="text" value="{{ $room['fasilitas'] }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ URL::to('rooms') }}" class="btn btn-outline-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection