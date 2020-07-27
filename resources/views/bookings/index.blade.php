@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Peminjaman</h3>
                <div class="card-tools">
                 <a href="{{ URL::to('bookings/create')}}" class="btn btn-tool">
                     <i class="fa fa-plus"></i>
                     &nbsp; Tambah Data Baru
                 </a>
             </div>
         </div>
         <div class="card-body">
            @if (Session::has('message'))
            <div id="alert-msg" class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ Session::get('message') }}
            </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>ID</th>
                                <th>ID Ruangan</th>
                                <th>ID Peminjam</th>
                                <th>Keperluan</th>
                                <th>Tanggal Mulai</th>
                                <th>Tanggal Selesai</th>
                                <th>File Bukti Peminjaman</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($bookings->count() > 0)
                            @foreach($bookings as $booking)
                            <tr>
                                <td class="text-center">{{ $booking['id'] }}</td>
                                <td>{{ $booking['r_id'] }}</td>
                                <td>{{ $booking['u_id'] }}</td>
                                <td>{{ $booking['keperluan'] }}</td>
                                <td>{{ $booking['tanggal_mulai'] }}</td>
                                <td>{{ $booking['tanggal_selesai'] }}</td>
                                <td class="text-center"><img src="{{ asset('storage/'.$booking['foto']) }}" width="100"/></td>
                                <td class="text-center">
                                    <form method="POST" action="{{ URL::to('bookings/'.$booking['id']) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <div class="btn-group">
                                            <a class="btn btn-info" href="{{ URL::to('bookings/'.$booking['id']) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-success" href="{{ URL::to('bookings/'.$booking['id'].'/edit') }}"><i class="fa fa-magic"></i></a>
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td align="center" colspan="8">Tidak ada data</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</div> 
@endsection

{{-- @section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Daftar Peminjaman</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('bookings.create') }}"> Tambah Peminjaman</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        <?php $i=0 ?>
        @foreach ($bookings as $booking)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $booking->nama }}</td>
            <td>{{ $booking->lantai }}</td>
            <td>
                <form action="{{ route('bookings.destroy',$booking->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('bookings.show',$booking->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('bookings.edit',$booking->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>      
@endsection --}}