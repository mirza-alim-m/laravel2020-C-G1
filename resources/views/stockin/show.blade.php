@extends('layouts.master')

@section('top')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Stock In</h1><br>
    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert"><b>{{ $message }}</b></div>
    @elseif($message = Session::get('error'))
    <div class="alert alert-danger" role="alert"><b>{{ $message }}</b></div>
    @endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
    <a href="{{ route('stockin.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-fw fa-chevron-left"></i> Back</a> 
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table  id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
        <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Kategori</th>
            <th>Qty</th>
            <th width="20%">Cover</th>
            <th>PDF</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tfoot class="thead-light">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Kategori</th>
            <th>Qty</th>
            <th width="20%">Cover</th>
            <th>PDF</th>
            <th>Created At</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($stockin as $stc)
            <tr>
                <td>{{ $stc->id_stockin }}</td>
                <td>{{ $stc->product->nama_barang }}</td>
                <td>{{ $stc->product->category->nama_kategori }}</td>
                <td>{{ $stc->qty }}</td>
                <td>{{$stc->product->cover}}</td>
                <td>{{$stc->product->doc_pdf}}</td>
                <td>{{ $stc->created_at->format('d-m-Y H:i') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->


@endsection