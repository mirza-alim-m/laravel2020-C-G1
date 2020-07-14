@extends('layouts.master')

@section('top')
@endsection

@section('content')
@if(Session::has('success'))
    <div class="alert alert-success">
        <strong>Success: </strong>{{ Session::get('success') }}
        <button type="button" class="close" data-dismiss="alert">×</button> 
    </div>
@endif
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Update Profile
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('update-profile.update') }}" novalidate enctype="multipart/form-data">
                            @method('patch')
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ?? \Auth::user()->name }}" required>

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') ?? \Auth::user()->email }}" required>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }}</label>
                                <div class="col-md-6">
                                    <input id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" value="{{ Auth::user()->role->role }}" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                                <div class="col-md-6">  
                                    @if(Auth::user()->avatar)
                                        <img class="img-profile rounded-circle" src="{{ asset('/storage/' . Auth::user()->avatar) }}" alt="" height="150px" weight="150px"><br><br>
                                    @else
                                        <img class="img-profile rounded-circle" src="{{ asset('images/user.png') }}" height="150px" weight="150px"><br><br>
                                    @endif
                                    <!-- <img src="{{ asset('/storage/' . Auth::user()->avatar) }}" alt="" height="150px" weight="150px"><br><br> -->
                                    <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" autofocus required>
                                    @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Profile
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection