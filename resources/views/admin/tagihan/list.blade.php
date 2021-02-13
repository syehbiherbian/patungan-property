@extends('admin.layout')
@section('content')


<div class="card">
    <div class="card-header">
      <h3 class="card-title">List Tagihan</h3>
      <div class="text-right">
        <a href="#" data-toggle="modal" data-target="#modal-lg" class="btn btn-primary"><i class="fas fa-plus"></i> Bayar Tagihan</a>
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Konsumen</th>
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
          <td>{{ $item->name }}</td>
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
            <th>Nama Konsumen</th>
            <th>Tanggal Pembayaran</th>
            <th>Pembayaran Ke-</th>
            <th>Jumlah Pembayaran</th>
            <th>Sisa Tenor</th>
          </tr>
        </tfoot>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->

  <div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Bayar Tagihan</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- form start -->
      <form id="quickForm" action="{{ route('admin.penjualan.post') }}" method="POST">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Nama Konsumen</label>
                <select name="nama_konsumen" id="konsumen" class="form-control select2" style="width: 100%;" onchange="getTransaksi();">
                  <option value="">Pilih Konsumen</option>
                  @foreach ($user as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option> 
                  @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="">Besar Iuran</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp</span>
                  </div>
                  <input type="text" name="iuran" class="form-control disabled" id="iuran" value="" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="">Pembayaran Ke</label>
                  <input type="text" name="pembayaran" class="form-control" id="pembayaran" value="" required>
                  <input type="hidden" name="transaksi_id" class="form-control" id="transaksi" value="">

            </div>
          </div>

      </form>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary" onclick="addTagihan();">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
@endsection

@section('js')
<script src="{{ asset('assets/admin/plugins/jquery-mask/jquery.mask.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script>
    $(function () {
        $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    
    });
    function getTransaksi(){
              const data = $('#konsumen').val();

              $.ajax({
                  type: "GET",
                  url: "{{ route('getTransaksi') }}",
                  data: {
                    "id": data
                  },
                  success: function(msg) {
                      console.log(msg)
                    $('#iuran').val(msg.jumlah_angsuran)
                    $('#transaksi').val(msg.id)
                    $( '#jumlah_angsuran' ).mask('000.000.000', {reverse: true});

                  }
              });
    }

    function addTagihan(){
        const users_id = $("#konsumen").val();
        const transaksi_id = $("#transaksi").val();
        const pembay = $("#pembayaran").val();

        $.ajax({
            type: "POST",
            url: "{{ route('admin.tagihan.post') }}",
            data: {
                "_token": "{{ csrf_token() }}",
                "users_id": users_id,
                "transaksi": transaksi_id,
                "pembayaran": pembay
            },
            success: function(msg) {
                Swal.fire(
                'Sukses',
                msg.message,
                'success'
                ).then(function(){ 
                location.reload();
                })
            }
        });

    }

  </script>
@endsection

