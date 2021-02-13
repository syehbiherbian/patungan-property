@extends('admin.layout')
@section('content')
<div class="col-md-12">
    <!-- jquery validation -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tambah Data Penjualan</h3>
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
      <form id="quickForm" action="{{ route('admin.penjualan.post') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Nama Konsumen</label>
                <select name="nama_konsumen" class="form-control select2" style="width: 100%;">
                  <option value="">Pilih Konsumen</option>
                  @foreach ($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option> 
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Nama Kavling</label>
                <select name="kavling" class="form-control select2" id="kavling" style="width: 100%;" onchange="getHarga();">
                  <option value="">Pilih Kavling</option>
                  @foreach ($kavling as $item)
                    <option value="{{ $item->id }}">{{ $item->kavling_name }}</option> 
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Harga Kavling</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="text" name="harga" class="form-control disabled" id="harga" value="" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="">Tenor</label>
                <input type="number" name="tenor" class="form-control" id="tenor" placeholder="Masukan Tenor dalam jumlah bulan" value="" onkeyup="getAngsuran();">
                @error('harga')
                    <span id="" class="error invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
              <label for="">Jumlah Angsuran</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">Rp</span>
                </div>              
                <input type="number" name="angsuran" class="form-control" id="angsuran" placeholder="Jumlah Angsuran yang harus dibayar" value="" >
              </div>
              @error('harga')
                  <span id="" class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
            <div class="form-group">
                  <label>Date:</label>
                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                        <input type="text" id="datepicker" name="date" class="form-control">
                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
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
@section('js')
    <script src="{{ asset('assets/admin/plugins/jquery-mask/jquery.mask.min.js') }}"></script>

    <script>
            $('.select2').select2()
            $( function() {
              $( "#datepicker" ).datepicker({
                dateonly:true,
                dateFormat: 'yy-mm-dd'
              });
            } );

            function getHarga(){
              const data = $('#kavling').val();

              $.ajax({
                  type: "GET",
                  url: "{{ route('getHarga') }}",
                  data: {
                    "id": data
                  },
                  success: function(msg) {
                    $('#harga').val(msg.harga)
                    // $( '#harga' ).mask('000.000.000', {reverse: true});

                  }
              });
            }

            function getAngsuran(){
              const harga = $('#harga').val();
              const tenor = $('#tenor').val();

              const angsur = parseInt(harga) / parseInt(tenor);
              const hasil = parseInt(angsur, 10)
              $('#angsuran').val(hasil);
              $( '#angsuran' ).mask('000.000.000', {reverse: true});

            }


    </script>
@endsection