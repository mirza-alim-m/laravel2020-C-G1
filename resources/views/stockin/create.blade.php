@extends('layouts.master')

@section('top')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Stock In</h1><br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <form action="{{route('stockin.store')}}" method="post" novalidate>
		{{ csrf_field() }}
        <input type="hidden" id="id" name="id">
        <div class="box-body">
          <div class="form-group">
              <label >Barang</label>
              <select name="product_id" class="form-control @error('product_id') is-invalid @enderror" required>
                  <option value="" disabled selected>Select a Product</option>
                  @foreach($products as $brg)
                  <option value="{{ $brg->id_barang }}">{{ $brg->nama_barang }}</option>
                  @endforeach
              </select>
              <span class="help-block with-errors"></span>
                @error('product_id')
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
        <input type="submit" class="btn btn-primary" value="Tambah Data">
        <a href="/stockin" class="btn btn-outline-primary">Kembali</a>
	    </form>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->
@endsection