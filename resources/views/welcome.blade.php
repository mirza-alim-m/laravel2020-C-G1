
@extends('layouts.app')

@section('top')
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('template/js/sb-admin-2.min.js') }}"></script>
@endsection

@section('content')
    <body class="bg-gradient-primary">
        <div class="container" style="margin-top: 150px">
            <div class="text-center"  style="margin-bottom: 210px">
                <h1 class="text-white">{{ __('Toko Buku Online') }}</h1><br>
            </div>
        </div>
    </body>
    <!-- Footer -->
    <footer class="sticky-footer">
        <div class="container">
          <div class="copyright text-center">
        </div>
      </div>
    </footer>
    <!-- End of Footer -->
@endsection