@extends('lte/adminlte')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Peminjaman</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 cropcenter">
                            <img class="rounded" src="{{ asset('storage/'.$booking['foto']) }}"
                                height="200" width="100%"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">       
                            <div class="form-group">
                                <label for="name">ID Ruangan</label>
                                <input id="name" type="text" value="{{ $booking['r_id'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="price">ID Peminjam</label>
                                <input id="price" type="text" value="{{ $booking['u_id'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="status">Keperluan</label>
                                <input id="status" type="text" value="{{ $booking['keperluan'] }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Tanggal Mulai</label>
                                <input id="description" type="text" value="{{ $booking['tanggal_mulai'] }}" class="form-control" disabled />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="description">Tanggal Mulai</label>
                                <input id="description" type="text" value="{{ $booking['tanggal_mulai'] }}" class="form-control" disabled />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ URL::to('bookings') }}" class="btn btn-outline-info">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection