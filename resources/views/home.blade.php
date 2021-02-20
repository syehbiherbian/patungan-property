@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2 bg-danger text-white">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active text-white" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link text-white" href="#settings" data-toggle="tab">Settings</a></li>
                  <li class="nav-item"><a class="nav-link text-white d-md-none d-lg-none d-xl-none" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">Logout</a></li>
                     <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                    </form>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    @if(session('sukses'))
                      <div class="alert alert-success" role="alert">
                          Sukses Update Profile!
                      </div>
                    @endif
                    <!-- Post -->
                    <div class="post">
                      <h1 class="text-center">KARTU ANGSURAN <br>
                        {{ strtoupper($transaksi->kavling_name) }}
                      </h1>
                      <hr>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Nama Konsumen : {{ ucwords($transaksi->name) }}</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label"></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Alamat : {{ ucwords($user->address) }}</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label"></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Blok Kavling : {{ ucwords($transaksi->blok_kavling) }}</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label"></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">No Handphone : {{ ucwords($user->phone_number) }}</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label"></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Harga Beli : {{ "Rp " . number_format($transaksi->harga,2,',','.') }}</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label"></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Tenor : {{ $transaksi->tenor }} Bulan</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label"></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Angsuran Perbulan : {{ "Rp " . number_format($transaksi->jumlah_angsuran,2,',','.') }}</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label"></label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Tanggal Penagihan : {{ date('d', strtotime($transaksi->tanggal_penagihan)) }}</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label"></label>
                        </div>
                      </div>
                      <table id="example1" class="table table-bordered table-striped table-responsive">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Pembayaran Ke-</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Sisa Tenor</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $no =1; @endphp
                        @foreach ($tagihan as $item)
                        <tr>
                          <td>{{ $no++ }}</td>
                          <td>{{ date('d-m-Y', strtotime($item->tanggal_pembayaran)) }}</td>
                          <td>{{ $item->pembayaran_ke  }}</td>
                          <td>{{ "Rp " . number_format($item->jumlah_angsuran,2,',','.') }}</td>
                          <td>{{ $item->sisa_tenor }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                          <tr>
                            <th>No</th>
                            <th>Tanggal Pembayaran</th>
                            <th>Pembayaran Ke-</th>
                            <th>Jumlah Pembayaran</th>
                            <th>Sisa Tenor</th>
                          </tr>
                        </tfoot>
                      </table>
                    </div>
                    <!-- /.post -->
                  </div>

                  <div class="tab-pane" id="settings">
                    <form class="form-horizontal" method="POST" action="{{ route('edit') }}">
                      @csrf
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="text" name="name" class="form-control" id="inputName" placeholder="Name" value="{{ Auth::user()->name }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" name="email" class="form-control" id="inputEmail" placeholder="Email" value="{{ Auth::user()->email }}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">No.Handphone</label>
                        <div class="col-sm-10">
                          <input type="text" name="phone" class="form-control" id="inputEmail" placeholder="Email" value="{{ $user->phone_number}}">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" name="password" class="form-control" name="password" id="inputName2" placeholder="Password">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience" name="alamat">{{ $user->address}}</textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                          <button type="submit" class="btn btn-danger">Submit</button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
    </div>
</div>
@endsection
