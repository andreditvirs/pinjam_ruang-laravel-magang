@extends('layouts.layoutform')
@section('content')
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    <div class="row">
    
    <div class="col-lg-2 pt-1">
        <img class="img-fluid" src="{{ asset('assets/img/LOGO.png') }}">
    </div>
    <div class="col-lg-8">
        <h1 class="display-4">404</h1>
        <p class="lead">Halaman yang Anda cari tidak dapat ditemukan</p>
        <hr class="my-4">
        <p>Silahkan kembali ke halaman utama untuk menelusuri halaman lain</p>
        <p class="lead pt-2">
        <a class="btn btn-primary btn-lg" href="{{ URL::to('/') }}" role="button">Kembali ke halaman utama</a>
        </p>
    </div>
    </div>
</div>
@endsection