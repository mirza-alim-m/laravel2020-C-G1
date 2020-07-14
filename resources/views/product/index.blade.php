@extends('layouts.master')

@section('top')
    <!-- {{-- Datatables --}} -->
    <script src="{{ asset('template/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Products</h1><br>
@if(Session::has('success'))
    <div class="alert alert-success">
        <strong>Success: </strong>{{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert">×</button> 
    </div>
@endif
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
    <a href="{{route('product.create')}}" class="btn btn-primary"><i class="fas fa-fw fa-plus"></i> Add Product</a><br>
  </div>
  <div class="card-body">
    <div class="table-responsive">
    <table class="table table-bordered data-table" width="100%" cellspacing="0">
          <thead class="thead-light">
          <tr>
          <th>No</th>
          <th>Name</th>
          <th>Kategori</th>
          <th>Harga</th>
          <th>Qty</th>
          <th><center>Action</center></th>
          </tr>
        </thead>
        <tfoot class="thead-light">
          <tr>
            <th>No</th>
            <th>Name</th>
            <th>Kategori</th>
            <th>Harga</th>
            <th>Qty</th>
            <th><center>Action</center></th>
          </tr>
        </tfoot>
        <tbody>
            <tr>
            <td></td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<script>
$(function() {
   const table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {url:"{{ route('product.index') }}"},
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'nama_barang', name: 'nama_barang'},
            {data: 'nama_kategori', name: 'nama_kategori'},
            {data: 'harga', name: 'harga' , render: $.fn.dataTable.render.number( ',', '.', 2, 'Rp. ' )},
            {data: 'qty', name: 'qty'},
            {data: 'action', name: 'action',orderable : false, searchable: false, sClass: 'text-center'}
           ]
          })
        })

        function deleteData(id_barang) {
        swal({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            showCancelButton: true,
            cancelButtonColor: '#d33',
        }).then((willDelete) => {
            $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            }
        });
            if (willDelete) {
                $('#data' + id_barang).submit();
            }
        })
    }
</script>    

@endsection