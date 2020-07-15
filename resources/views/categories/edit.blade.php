@extends('layouts.master')

@section('top')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Category</h1><br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
    @foreach ($category as $ctg)
    <form action="{{action('CategoryController@update', $ctg->id_kategori)}}" method="POST" class="needs-validation" enctype="multipart/form-data">
        @method('PATCH')
        {{ csrf_field() }}
		    <input type="hidden" name="id" value="{{ $ctg->id_kategori }}">
        <input type="hidden" placeholder="nama" name="old_name" value="{{ $ctg->nama_kategori }}">
        <div class="box-body">
            <div class="form-group">
                <label >Category Name</label>
                <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" value="{{ $ctg->nama_kategori }}" autofocus required>
                <span class="help-block with-errors"></span>
                @error('nama_kategori')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
          <div class="form-line">
              <label for="file">UBAH GAMBAR</label>
                <div class="fallback">
                        <img src="{{ asset($ctg->cover) }}" class="mask waves-effect waves-light rgba-white-slight" height="100px" width="auto" alt="tidak ada gambar">
                        <input name="cover" type="file" multiple value="{{ $ctg->cover }}" />
                </div>
          </div>
        </div>
        <div class="form-group">
             <div class="form-line">
                  <label for="file">UBAH DOKUMEN</label>
                         <div class="fallback">
                          <input name="doc_pdf" type="file" multiple value="{{ $ctg->doc_pdf }}" />
                         </div>
              </div>
          </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Edit Data">
        <a href="/categories" class="btn btn-outline-primary">Kembali</a>
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