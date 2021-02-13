@extends('admin.layout')
@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title">Data Penjualan</h3>
      <div class="text-right">
        <a href="{{ route('admin.penjualan.tambah') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Tambah Data Penjualan</a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Nama Konsumen</th>
            <th>Nama Kavling</th>
            <th>Tenor</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($jual as $item)
        <tr>
          <td>{{ $item->name }}</td>
          <td>{{ $item->kavling_name  }}</td>
          <td>{{ $item->tenor }}</td>
          <td><a href="" class="btn btn-primary"><i class="fa fa-pencil"></i> Edit</a> <a href="" class="btn btn-danger"><i class="fas fa-trash"></i> Hapus</a></td>
        </tr>
        @endforeach
        </tbody>
        <tfoot>
          <tr>
            <th>Nama Konsumen</th>
            <th>Blok Kavling</th>
            <th>Tenor</th>
            <th>Action</th>
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

