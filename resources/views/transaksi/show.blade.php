@extends('layouts.master')

@section('top')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Transaksi</h1><br>
    @if ($message = Session::get('success'))
    <div class="alert alert-success" role="alert"><b>{{ $message }}</b></div>
    @elseif($message = Session::get('error'))
    <div class="alert alert-danger" role="alert"><b>{{ $message }}</b></div>
    @endif

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
    <a href="{{ route('transaksi.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-fw fa-chevron-left"></i> Back</a> 
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table  id="dataTable" class="table table-bordered" width="100%" cellspacing="0">
        <thead class="thead-light">
          <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Nama Pembeli</th>
            <th>Qty</th>
            <th>Email</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tfoot class="thead-light">
          <tr>
            <th>ID</th>
            <th>Nama Barang</th>
            <th>Nama Pembeli</th>
            <th>Qty</th>
            <th>Email</th>
            <th>Created At</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($transaksi as $sto)
            <tr>
                <td>{{ $sto->id_transaksi }}</td>
                <td>{{ $sto->databuku->nama_barang }}</td>
                <td>{{ $sto->nama_pembeli }}</td>
                <td>{{ $sto->qty }}</td>
                <td>{{ $sto->email }}</td>
                <td>{{ $sto->created_at->format('d-m-Y H:i') }}</td>
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