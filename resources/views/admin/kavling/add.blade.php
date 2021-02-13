@extends('admin.layout')
@section('content')
<div class="col-md-12">
    <!-- jquery validation -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tambah Data Kavling</h3>
      </div>
      @if (count($errors) > 0)
      <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-ban"></i> Error!</h5>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
      </div>
    @endif
      <!-- /.card-header -->
      <!-- form start -->
      <form id="quickForm" action="{{ route('admin.kavling.post') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Kavling</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Masukan Nama Kavling" value="{{ old('name') }}">
                @error('name')
                    <span id="" class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group">
                <label for="">Blok Kavling</label>
                <input type="text" name="blok" class="form-control" id="" placeholder="Masukan Blok Kavling" value="{{ old('blok') }}">
                @error('blok')
                    <span id="" class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group">
                <label for="">Harga</label>
                <input type="number" name="harga" class="form-control" id="" placeholder="Masukan Harga" value="{{ old('harga') }}">
                @error('harga')
                    <span id="" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            </div>
        <!-- /.card-body -->
        <div class="card-footer text-right">
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
    <!-- /.card -->
    </div>
@endsection