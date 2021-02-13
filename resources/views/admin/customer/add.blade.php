@extends('admin.layout')
@section('content')
<div class="col-md-12">
    <!-- jquery validation -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tambah Customer</h3>
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
      <form id="quickForm" action="{{ route('admin.customer.post') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Lengkap</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="" placeholder="Masukan Nama Lengkap" value="{{ old('name') }}">
                @error('name')
                    <span id="" class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="email" name="email" class="form-control" id="" placeholder="Masukan email" value="{{ old('email') }}">
                @error('email')
                    <span id="" class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group">
                <label for="">No Handphone</label>
                <input type="text" name="phone" class="form-control" id="" placeholder="Masukan No Handphone" value="{{ old('phone') }}">
                @error('phone')
                    <span id="" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat" class="form-control" id="" cols="30" rows="10">{{ old('name') }}</textarea>
                @error('alamat')
                    <span id="" class="error invalid-feedback">{{ $message }}</span>
                @enderror
              </div>
            <div class="form-group">
                <label for="">Password</label>
                <input type="password" name="password" class="form-control" id="" placeholder="Masukan Password untuk Customer Login">
                @error('password')
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