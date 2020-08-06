@extends('layouts.app')
@section('content')
<!-- Masthead-->
@include('inc.navbar')
<header class="masthead">
    <div class="container d-flex h-100 align-items-center">
        <div class="mx-auto text-center">
            <h1 class="mx-auto my-0 text-uppercase">DISKOMINFO<br> JAWA TIMUR</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">Peminjaman Ruangan</h2>
            <a class="btn btn-primary js-scroll-trigger" href="{{ URL::to('login')}}">Masuk</a>
        </div>
    </div>
</header>
<!-- About-->
<section class="about-section text-center" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2 class="text-white mb-4">Peminjaman Ruangan</h2>
                <p class="text-white-50">
                    Dikelola oleh Dinas Komunikasi dan Informatika Jawa Timur.
                    <br>Sebagai Lembaga pemerintahan yang mempunyai tanggung jawab besar dan bergerak di dalam lingkungan Pemerintah Provinsi Jawa Timur, maka KOMINFO mempunyai tugas pokok dan fungsi yang besar dalam membangun Teknologi Informasi dan Komunikasi <br>( TIK ) di Provinsi Jawa Timur.
                </p>
            </div>
        </div>
        <img class="img-fluid" src="assets/img/ipadSplashscreen.png" alt="ipadSplashscreen" />
    </div>
</section>
@include('inc.contactsection')
@endsection