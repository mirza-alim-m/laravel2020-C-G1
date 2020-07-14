@extends('layouts.master')

@section('top')

@endsection

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Users</h1><br>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <!-- <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6> -->
    <a href="{{ route('user.index') }}" class="btn btn-sm btn-primary float-right"><i class="fas fa-fw fa-chevron-left"></i> Back</a> 
  </div>
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" width="100%" cellspacing="0">
        <thead class="thead-light">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th><center>Avatar</center></th>
            <th><center>Document</center></th>
          </tr>
        </thead>
        <tfoot class="thead-light">
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th><center>Avatar</center></th>
            <th><center>Document</center></th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($user as $usr)
            <tr>
                <td class="align-middle"> {{ $usr->name }}</td>
                <td class="align-middle"> {{ $usr->email }}</td>
                <td class="align-middle"> {{ $usr->role->role }}</td>
                <td class="align-middle">

                  <center>
                    @if($usr->avatar)
                      <img src="{{ asset('/storage/' . $usr->avatar) }}" alt="{{ $usr->name }}" height="250px" weight="250px">
                    @else
                      <img src="{{ asset('images/user.png') }}" alt="" height="64px" weight="64px"><br><a>Avatar Not Found</a>
                    @endif
                  </center>
                </td>
                <td class="align-middle">
                  <center>
                    @if($usr->document)
                      <img src="https://img.icons8.com/ultraviolet/64/000000/pdf.png" alt=""><br>
                      <a href="{{ asset('/storage/' . $usr->document) }}" target="_blank">Download PDF</a>
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