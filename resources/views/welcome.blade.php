
@extends('layouts.app')

@section('top')
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
@endsection

@section('content')
    <body class="bg-gradient-primary">
        <div class="container" style="margin-top: 150px">
            <div class="text-center"  style="margin-bottom: 210px">
                <h1 class="text-white">{{ __('Selamat Datang di') }}<sup></sup></h1><br>
                <h2 class="text-white">{{ __('Sistem penjualan Buku Online') }}</h2>
            </div>
        </div>
    </body>
    <!-- Footer -->
    <footer class="sticky-footer">
        <div class="container">
          <div class="copyright text-center">
            <h6 class="m-0 font-weight-bold text-white">Tokobuku<sup>2020</sup> - penjualan Buku Online</h6>
            <?php $date = date('Y')?>
            <strong class="m-0 font-weight-bold text-white">Copyright &copy; {{$date}} 
            <a href="https://github.com/KhoirulAmirFajri" class="m-0 font-weight-bold text-light">TokoBuku</a>.</strong> 
            <a class="m-0 font-weight-bold text-white">All rights reserved.</a>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->
@endsection