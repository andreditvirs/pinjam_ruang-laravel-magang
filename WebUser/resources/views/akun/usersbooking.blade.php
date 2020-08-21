@extends('layouts.layoutform')

@section('content')
@php
    use App\Http\Controllers\GuzzleController;
    GuzzleController::getUserBooking(Cookie::get('access_token'));
@endphp
<div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
    <div class="container">
        <div class="row mt-5 mb-5">
            <span class="login100-form-title p-b-16">
                Peminjaman Saya
            </span>
        <a href="{{ URL::to('bookings/step/1') }}"><button class="btn btn-info btn-lg">Buat Peminjaman Baru</button></a>
        </div>
    </div>

    @if (session('alert'))
    <div class="alert alert-info m-b-24">
        {{ session('alert') }}
    </div>
    @endif
    
    <div class="row">
        <div class="col">
            @if(count(Cache::get('user_booking'.Cookie::get('access_token'))['user_booking']) != 0)
            <?php $i=0 ?>
            @foreach (Cache::get('user_booking'.Cookie::get('access_token'))['user_booking'] as $booking)
            <div class="card border-info mb-3">
                <div class="card-body">
                    
                <h5 class="card-title">Nama Ruangan : {{ $booking['nama']}}</h5>
                    <p class="card-text">Tanggal Pinjam :  {{ $booking['tanggal_pinjam']}}</p>
                    <p class="card-text">Waktu :  {{ $booking['waktu_mulai']}} s/d {{ $booking['waktu_selesai']}}</p>
                    <p class="card-text">Kepentingan : {{ $booking['keperluan']}} </p>
                    <div class="btn-group mt-2" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg-bukti{{$i+=1}}">Lihat Surat Izin</button>
                    <button class="btn btn-danger ml-1" onclick="document.getElementById('delete_user_booking').submit();">Batalkan Peminjaman</button> </a>
                    </div>
                </div>
                <div class="modal fade bd-example-modal-lg-bukti{{$i}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="row">
                                <div class="col-lg-12">
                                    <h1 class="text-center pt-3 pb-1">Bukti Peminjaman</h1>
                                    <hr>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-10 h-100 pb-5 pr-5 pl-5 cropfotoprofil">
                                            <img src="{{ Cookie::get('address_web_server').$booking["file"]}}" alt="Image">
                                        </div>
                                    </div>
                                    <div class="row justify-content-center pb-5">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form id="delete_user_booking" action="{{ route('delete_user_booking') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="r_id" value="{{ $booking['r_id'] }}">
                <input type="hidden" name="tanggal_pinjam" value="{{ $booking['tanggal_pinjam'] }}">
                <input type="hidden" name="waktu_mulai" value="{{ $booking['waktu_mulai'] }}">
                <input type="hidden" name="waktu_selesai" value="{{ $booking['waktu_selesai'] }}">
            </form>
            @endforeach
            @else
            <tr>
                <td align="center" colspan="8"><p class="text-info">Tidak ada peminjaman ruang dari Anda</p></td>
            </tr>
            @endif
        </div>
        <a href="{{ URL::to('home') }}"><button type="button" class="btn btn-outline-info btn-lg float-right">Kembali</button></a>
</div>
</div>
@endsection