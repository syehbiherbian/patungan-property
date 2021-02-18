@extends('admin.layout')
@section('content')
<div class="col-md-12">
    <!-- jquery validation -->
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Tambah Blog Post</h3>
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
      <form id="quickForm" action="{{ route('admin.blog.post') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label>Judul Blog</label>
                <input type="text" name="judul" class="form-control" id="">
            </div>
            <div class="form-group">
                <label>Gambar Post</label>
                <input type="file" name="cover" class="form-control" id="">
            </div>
            <div class="form-group">
                <label for="">Isi Blog</label>
                <div class="input-group">
                    <textarea class="form-control" name="blog" id="blog">&lt;p&gt;Initial editor content.&lt;/p&gt;</textarea>
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
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>

    <script src="{{ asset('assets/admin/plugins/jquery-mask/jquery.mask.min.js') }}"></script>

    <script>
            CKEDITOR.replace('blog', {
                width: '100%'
            });
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