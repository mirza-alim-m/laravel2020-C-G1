@extends('layouts.master')

@section('top')
    <!-- CKEDITOR -->
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Product</h1><br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <form action="{{route('product.store')}}" method="post" novalidate enctype="multipart/form-data">
		{{ csrf_field() }}
        <input type="hidden" id="id" name="id">
        <div class="box-body">
            <div class="form-group">
                <label>Product Name</label>
                <input type="text" class="form-control @error('product_name') is-invalid @enderror" id="product_name" name="product_name"  autofocus required>
                <span class="help-block with-errors"></span>
                @error('product_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="box-body">
          <div class="form-group">
              <label >Category</label>
              <select name="id_category" class="form-control @error('id_category') is-invalid @enderror" required>
                  <option value="" disabled selected>Select a Category</option>
                  @foreach($categories as $ctg)
                  <option value="{{ $ctg->id_kategori }}">{{ $ctg->nama_kategori }}</option>
                  @endforeach
              </select>
              <span class="help-block with-errors"></span>
                @error('id_category')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
          </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label >Harga</label>
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price"  autofocus required>
                <span class="help-block with-errors"></span>
                @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label >Spesifikasi</label>
                <textarea type="text" class="form-control @error('spesifikasi') is-invalid @enderror" id="editor" name="spesifikasi" required></textarea>
                <span class="help-block with-errors"></span>
                @error('spesifikasi')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label >Qty</label>
                <input type="text" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty"  autofocus required>
                <span class="help-block with-errors"></span>
                @error('qty')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label >Image</label>
                <input type="file" class="form-control  @error('img') is-invalid @enderror" id="img" name="img" autofocus required>
                <span class="help-block with-errors"></span>
                @error('img')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="box-body">
            <div class="form-group">
                <label >Documet File</label><br>
                <input type="file" class="form-control @error('document') is-invalid @enderror" id="document" name="document" autofocus required>
                <span class="help-block with-errors"></span>
                @error('document')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Tambah Data">
        <a href="/product" class="btn btn-outline-primary">Kembali</a>
	</form>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->


@endsection