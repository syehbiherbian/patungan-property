@extends('admin.layout')
@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Customer</h3>
      <div class="text-right">
        <a href="{{ route('admin.customer.tambah') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Customer</a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Nama Customer</th>
            <th>Email</th>
            <th>Alamat</th>
            <th>No Handphone</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($user as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ $item->email }}</td>
          <td>{{ $item->customer->address }}</td>
          <td>{{ $item->customer->phone_number }}</td>
          <td><a href="" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a> <a href="" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a></td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
          <th>Nama Customer</th>
          <th>Email</th>
          <th>Alamat</th>
          <th>No Handphone</th>
          <th>Actions</th>
        </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
    
@endsection

@section('js')
<script>
    $(function () {
        $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
  </script>
@endsection

@if(session('message'))
    @section('js')
    <script>
      $('.toastrDefaultSuccess').click(function() {
        toastr.success('{{ session('message') }}')
      });
    </script>
    @endsection
@endif