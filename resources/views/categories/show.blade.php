@extends('layouts.master')

@section('top')
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<!-- <p class="mb-4">DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the <a target="_blank" href="https://datatables.net">official DataTables documentation</a>.</p> -->

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-fw fa-chevron-left"></i> Back</a> 
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead class="thead-light">
          <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Products</th>
          </tr>
        </thead>
        <tfoot class="thead-light">
          <tr>
            <th>No</th>
            <th>Kategori</th>
            <th>Products</th>
          </tr>
        </tfoot>
        <tbody>
            @php
                $no = 1;
            @endphp
          @foreach ($category as $ctg)
            <tr>
                <td>{{$no++}}</td>
                <td>{{ $ctg->nama_kategori }}</td>
                <td>
                        @php
                            $n = 1;
                        @endphp
                    @foreach ($products as $pdc)
                    {{$n++}}. {{ $pdc->nama_barang }} <?php echo"</br>";?>
                    @endforeach
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