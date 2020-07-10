@extends('layouts.master')

@section('top')
@endsection
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Buku</h1><br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
    <a href="{{ route('databuku.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-fw fa-chevron-left"></i> Back</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table  class="table table-bordered" width="100%" cellspacing="0">
        <thead class="thead-light">
          <tr>
            <th>Name</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Qty</th>
            <th width="20%">Cover</th>
            <th>PDF</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($databuku as $brg =>$databuku)
            <tr>
                <td class="align-middle">{{ $databuku->nama_barang }}</td>
                <td class="align-middle">{{ $databuku->category->nama_kategori }}</td>
                
                <td class="align-middle">{{ $databuku->harga }}</td>
                <td class="align-middle">{{ $databuku->qty }}</td>
                <td>@if($databuku->cover != NULL)
                            <img src="{{ asset($databuku->cover) }}" alt="" width="48%;" height="3%" style="margin-top:20px; margin-left:40px">
                            @else
                                <h5 style="color:red">Tidak ada Gambar</h5>
                            @endif
                </td>
                <td>
                    @if($databuku->doc_pdf!= NULL)
                        <a href="{{ asset($databuku->doc_pdf) }}" class="btn bg-grey waves-effect m-r-20">Download Pdf</a>
                    @else
                        <h5 style="color:red">Tidak ada file PDF</h5>
                    @endif 
                </td>
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