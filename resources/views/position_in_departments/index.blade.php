@extends('lte/adminlte')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Data Jabatan</h3>
                <div class="card-tools">
                 <a href="{{ URL::to('position_in_departments/create')}}" class="btn btn-tool">
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
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($position_in_departments as $position)
                            <tr>
                                <td class="text-center">{{ $position->id }}</td>
                                <td>{{ $position->nama }}</td>
                                <td class="text-center">
                                    <form method="POST" action="{{ URL::to('position_in_departments/'.$position->id) }}">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="_method" value="DELETE" />
                                        <div class="btn-group">
                                            <a class="btn btn-info" href="{{ URL::to('position_in_departments/'.$position->id) }}"><i class="fa fa-eye"></i></a>
                                            <a class="btn btn-success" href="{{ URL::to('position_in_departments/'.$position->id.'/edit') }}"><i class="fa fa-magic"></i></a>
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