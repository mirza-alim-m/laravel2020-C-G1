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
    @foreach ($product as $pdc)
    <form action="{{action('ProductController@update', $pdc->id_barang)}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
        @method('PATCH')
        {{ csrf_field() }}
		<input type="hidden" name="id" value="{{ $pdc->id_barang }}">
        <input type="hidden" placeholder="nama" name="old_name" value="{{ $pdc->nama_barang }}">
        <div class="box-body">
            <div class="form-group">
                <label >Name</label>
                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="product_name" value="{{ $pdc->nama_barang }}" autofocus required>
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
                      @foreach ($categories as $ctg)
                        <option value="{{$ctg->id_kategori}}"
                            @if ($pdc->id_kategori == $ctg->id_kategori)
                                selected
                            @endif
                            >{{$ctg->nama_kategori}}</option>
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
                <input type="text" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $pdc->harga }}" autofocus required>
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
                <textarea type="text" class="form-control @error('spesifikasi') is-invalid @enderror" id="editor" name="spesifikasi" required><?php echo "$pdc->spesifikasi";?></textarea>
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
                <input type="text" class="form-control @error('qty') is-invalid @enderror" id="qty" name="qty" value="{{ $pdc->qty }}"  autofocus required>
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
                <label >Image</label><br>
                    @if($pdc->img)
                      <img src="{{ asset('/storage/' . $pdc->img) }}" alt="{{ $pdc->nama_barang }}" height="250px" weight="250px">
                    @else
                      <img src="https://img.icons8.com/color/64/000000/image-file.png" alt=""><a>Image Not Found</a>
                    @endif<br><br>
                <input type="file" class="form-control @error('img') is-invalid @enderror" id="img" name="img" autofocus required>
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
                    @if($pdc->document)
                      <img src="https://img.icons8.com/ultraviolet/64/000000/pdf.png" alt="">
                      <a href="{{ asset('/storage/' . $pdc->document) }}" target="_blank">Download PDF</a>
                    @else
                      <img src="https://img.icons8.com/ultraviolet/64/000000/pdf.png" alt=""><a>Pdf Not Found</a>
                    @endif<br><br>
                <input type="file" class="form-control @error('document') is-invalid @enderror" id="document" name="document" autofocus required>
                <span class="help-block with-errors"></span>
                @error('document')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Edit Data">
        <a href="/product" class="btn btn-outline-primary">Kembali</a>
	</form>
    @endforeach
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

@endsection