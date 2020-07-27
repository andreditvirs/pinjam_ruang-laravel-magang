@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Ruangan</h3>
                <div class="card-tools">
                 <a href="{{ URL::to('rooms/create')}}" class="btn btn-tool">
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
                                <th>Nama</th>
                                <th>Lantai</th>
                                <th>Kapasitas</th>
                                <th>Fasilitas</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rooms as $room)
                            <tr>
                                <td class="text-center">{{ $room['id'] }}</td>
                                <td>{{ $room['nama'] }}</td>
                                <td>{{ $room['lantai'] }}</td>
                                <td>{{ $room['kapasitas'] }}</td>
                                <td>{{ $room['fasilitas'] }}</td>
                                <td class="text-center"><img src="{{ asset('storage/'.$room['foto']) }}" width="100"/></td>
                                <td class="text-center">
                                    <form method="POST" action="{{ URL::to('rooms/'.$room['id']) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <div class="btn-group">
                                            <a class="btn btn-info" href="{{ URL::to('rooms/'.$room['id']) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-success" href="{{ URL::to('rooms/'.$room['id'].'/edit') }}"><i class="fa fa-magic"></i></a>
                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
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
                <h2>Daftar Ruangan</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('rooms.create') }}"> Tambah Ruangan</a>
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
        @foreach ($rooms as $room)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $room->nama }}</td>
            <td>{{ $room->lantai }}</td>
            <td>
                <form action="{{ route('rooms.destroy',$room->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('rooms.show',$room->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('rooms.edit',$room->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>      
@endsection --}}