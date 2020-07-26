@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{ $booking_count }}</h3>
            <p>Peminjaman</p>
          </div>
          <div class="icon">
            <i class="fas fa-book"></i>
          </div>
        <a href="{{ URL::to('bookings') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $department_count }}</h3>
            <p>Bidang</p>
          </div>
          <div class="icon">
            <i class="fas fas fa-home"></i>
          </div>
        <a href="{{ URL::to('departments') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $room_count }}</h3>
            <p>Ruangan</p>
          </div>
          <div class="icon">
            <i class="fas fas fa-window-maximize"></i>
          </div>
        <a href="{{ URL::to('rooms') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $position_in_department_count }}</h3>
            <p>Jabatan</p>
          </div>
          <div class="icon">
            <i class="fas fa-university"></i>
          </div>
        <a href="{{ URL::to('position_in_departments') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{ $user_count }}</h3>
            <p>Pegawai</p>
          </div>
          <div class="icon">
            <i class="fas fa-users"></i>
          </div>
        <a href="{{ URL::to('users') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    
</div> 
@endsection