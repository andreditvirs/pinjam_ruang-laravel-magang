@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Departmen</h3>
                <div class="card-tools">
                 <a href="{{ URL::to('departments/create')}}" class="btn btn-tool">
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
                                <th>Nama Kepala Departmen</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($departments as $department)
                            <tr>
                                <td class="text-center">{{ $department->id }}</td>
                                <td>{{ $department->nama }}</td>
                                <td>{{ $department->user_nama }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ URL::to('departments/'.$department->id) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <div class="btn-group">
                                            <a class="btn btn-info" href="{{ URL::to('departments/'.$department->id) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-success" href="{{ URL::to('departments/'.$department->id.'/edit') }}"><i class="fa fa-magic"></i></a>
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
                <a class="btn btn-success" href="{{ route('departments.create') }}"> Tambah Ruangan</a>
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
        @foreach ($departments as $department)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $department->nama }}</td>
            <td>{{ $department->lantai }}</td>
            <td>
                <form action="{{ route('departments.destroy',$department->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('departments.show',$department->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('departments.edit',$department->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>      
@endsection --}}