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
    <form action="{{action('CategoryController@update', $ctg->id_kategori)}}" method="POST" class="needs-validation" novalidate>
        @method('PATCH')
        {{ csrf_field() }}
		    <input type="hidden" name="id" value="{{ $ctg->id_kategori }}">
        <input type="hidden" placeholder="nama" name="old_name" value="{{ $ctg->nama_kategori }}">
        <div class="box-body">
            <div class="form-group">
                <label >Category Name</label>
                <input type="text" class="form-control @error('category_name') is-invalid @enderror" name="category_name" value="{{ $ctg->nama_kategori }}" autofocus required>
                <span class="help-block with-errors"></span>
                @error('category_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
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
@endsection