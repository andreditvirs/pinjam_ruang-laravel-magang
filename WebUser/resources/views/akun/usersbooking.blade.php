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
        <a href="{{ URL::to('bookings/create') }}"><button class="btn btn-info btn-lg">Buat Peminjaman Baru</button></a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            @if(count(Cache::get('user_booking')['user_booking']) != 0)
            @foreach (Cache::get('user_booking')['user_booking'] as $booking)
            <div class="card border-info mb-3">
                <div class="card-body">
                    
                <h5 class="card-title">Nama Ruangan : {{ $booking['nama']}}</h5>
                    <p class="card-text">Tanggal Mulai :  {{ $booking['tanggal_mulai']}}</p>
                    <p class="card-text">Tanggal Selesai :  {{ $booking['tanggal_selesai']}}</p>
                    <p class="card-text">Kepentingan : {{ $booking['keperluan']}} </p>
                    <div class="btn-group mt-2" role="group" aria-label="Basic example">
                        <a href="#" ><button class="btn btn-info">Unduh Surat Izin</button> </a>
                    <button class="btn btn-danger ml-1" onclick="document.getElementById('delete_user_booking').submit();">Batalkan Peminjaman</button> </a>
                    </div>
                </div>
            </div>
            <form id="delete_user_booking" action="{{ route('delete_user_booking') }}" method="POST" style="display: none;">
                @csrf
                <input type="hidden" name="r_id" value="{{ $booking['r_id'] }}">
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