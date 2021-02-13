@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <!-- /.col -->
        <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Activity</a></li>
                  <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div class="active tab-pane" id="activity">
                    <!-- Post -->
                    <div class="post">
                      <h1 class="text-center">KARTU ANGSURAN <br>
                        {{ strtoupper($transaksi->kavling_name) }}
                      </h1>
                      <hr>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Nama Konsumen</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label">: {{ ucwords($transaksi->name) }}</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Alamat</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label">: {{ ucwords($user->address) }}</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Blok Kavling</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label">: {{ ucwords($transaksi->blok_kavling) }}</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">No Handphone</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label">: {{ ucwords($user->phone_number) }}</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Harga Beli</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label">: {{ "Rp " . number_format($transaksi->harga,2,',','.') }}</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Tenor</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label">: {{ $transaksi->tenor }} Bulan</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Angsuran Perbulan</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label">: {{ "Rp " . number_format($transaksi->jumlah_angsuran,2,',','.') }}</label>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-6 col-form-label">Tanggal Penagihan</label>
                        <div class="col-sm-6">
                            <label for="inputName" class="col-sm-6 col-form-label">: {{ date('d', strtotime($transaksi->tanggal_penagihan)) }}</label>
                        </div>
                      </div>
                      <table id="example1" class="table table-bordered table-striped">
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
                    <form class="form-horizontal">
                      <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputName" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                          <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                          <input type="password" class="form-control" name="password" id="inputName2" placeholder="Name">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                          <textarea class="form-control" id="inputExperience" placeholder="Experience" name="alamat"></textarea>
                        </div>
                      </div>
                      <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                          <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
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
