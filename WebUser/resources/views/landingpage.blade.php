@extends('layouts.app')
@section('content')
<!-- Masthead-->
@include('inc.navbar')
<div id="carouselExampleCaptions" class="carousel slide carousel-fade" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active" data-interval="400">
        <img src="assets/img/c1.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h1 class="mx-auto my-0 text-uppercase" style="font-size:7vw">DISKOMINFO<br> JAWA TIMUR</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">Peminjaman Ruangan</h2>
            <a class="btn btn-primary js-scroll-trigger" href="{{ URL::to('login')}}">Masuk</a>
        </div>
      </div>
      <div class="carousel-item" data-interval="400">
        <img src="assets/img/c2.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h1 class="mx-auto my-0 text-uppercase" style="font-size:7vw">DISKOMINFO<br>JAWA TIMUR</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">Peminjaman Ruangan</h2>
            <a class="btn btn-primary js-scroll-trigger" href="{{ URL::to('login')}}">Masuk</a>
        </div>
      </div>
      <div class="carousel-item" data-interval="400">
        <img src="assets/img/c3.jpg" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
            <h1 class="mx-auto my-0 text-uppercase" style="font-size:7vw">DISKOMINFO<br> JAWA TIMUR</h1>
            <h2 class="text-white-50 mx-auto mt-2 mb-5">Peminjaman Ruangan</h2>
            <a class="btn btn-primary js-scroll-trigger" href="{{ URL::to('login')}}">Masuk</a>
        </div>
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
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
