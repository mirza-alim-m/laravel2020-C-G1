@extends('layouts.master')

@section('top')
    <!-- CKEDITOR -->
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Buku</h1><br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
    @foreach ($databuku as $pdc)
    <form action="{{route('databuku.update', $pdc->id_buku)}}" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>
        @method('PATCH')
        {{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $pdc->id_buku }}">
        <input type="hidden" placeholder="nama" name="old_name" value="{{ $pdc->nama_barang }}">
        <div class="box-body">
            <div class="form-group">
                <label >Name</label>
                <input type="text" class="form-control" name="nama_barang" value="{{ $pdc->nama_barang }}" autofocus required>
                <span class="help-block with-errors"></span>
            </div>
        </div>
        <div class="box-body">
          <div class="form-group">
              <label >Category</label>
              <select name="id_kategori" class="form-control" required>
                  <option value="" disabled selected>Select a Category</option>
                  @foreach($categories as $ctg)
                  <option value="{{ $ctg->id_kategori }}">{{ $ctg->nama_kategori }}</option>
                  @endforeach
              </select>
              <span class="help-block with-errors"></span>
          </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label >Harga</label>
                <input type="text" class="form-control" id="harga" name="harga" value="{{ $pdc->harga }}" autofocus required>
                <span class="help-block with-errors"></span>
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label >Qty</label>
                <input type="text" class="form-control" id="qty" name="qty" value="{{ $pdc->qty }}"  autofocus required>
                <span class="help-block with-errors"></span>
            </div>
        </div>
      
        <div class="form-group">
          <div class="form-line">
              <label for="file">UBAH GAMBAR</label>
                <div class="fallback">
                        <img src="{{ asset($pdc->cover) }}" class="mask waves-effect waves-light rgba-white-slight" height="100px" width="auto" alt="tidak ada gambar">
                        <input name="cover" type="file" multiple value="{{ $pdc->cover }}" />
                </div>
          </div>
        </div>
        <div class="form-group">
             <div class="form-line">
                  <label for="file">UBAH DOKUMEN</label>
                         <div class="fallback">
                          <input name="doc_pdf" type="file" multiple value="{{ $pdc->doc_pdf }}" />
                         </div>
              </div>
          </div>
        <input type="submit" class="btn btn-primary" value="Edit Data">
        <a href="/databuku" class="btn btn-outline-primary">Kembali</a>
	</form>
    @endforeach
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<script>
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

@endsection