@extends('layouts.master')

@section('top')
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Products</h1><br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
    <a href="{{ route('product.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-fw fa-chevron-left"></i> Back</a>
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table  class="table table-bordered" width="100%" cellspacing="0">
        <thead class="thead-light">
          <tr>
            <th>Name</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th><center>Spesifikasi</center></th>
            <th>Qty</th>
            <th><center>Image<center></th>
            <th><center>Document<center></th>
          </tr>
        </thead>
        <tfoot class="thead-light">
          <tr>
            <th>Name</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th><center>Spesifikasi</center></th>
            <th>Qty</th>
            <th><center>Image</center></th>
            <th><center>Document</center></th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($product as $brg)
            <tr>
                <td class="align-middle">{{ $brg->nama_barang }}</td>
                <td class="align-middle">{{ $brg->category->nama_kategori }}</td>
                <td class="align-middle">@currency($brg->harga)</td>
                <td class="align-middle"><?php echo "$brg->spesifikasi";?></td>
                <td class="align-middle">{{ $brg->qty }}</td>
                <td class="align-middle">
                  <center>
                    @if($brg->img)
                      <img src="{{ asset('/storage/' . $brg->img) }}" alt="{{ $brg->nama_barang }}" height="250px" weight="250px">
                    @else
                      <img src="https://img.icons8.com/color/64/000000/image-file.png" alt=""><br><a>Image Not Found</a>
                    @endif
                  </center>
                </td>
                <td class="align-middle">
                  <center>
                    @if($brg->document)
                      <img src="https://img.icons8.com/ultraviolet/64/000000/pdf.png" alt=""><br>
                      <a href="{{ asset('/storage/' . $brg->document) }}" target="_blank">Download PDF</a>
                    @else
                      <img src="https://img.icons8.com/ultraviolet/64/000000/pdf.png" alt=""><br><a>Pdf Not Found</a>
                    @endif
                  </center>
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