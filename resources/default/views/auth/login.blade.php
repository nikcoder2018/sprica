@extends('layouts.admin.auth')

@section('content')
<div class="login-box">
    <div class="login-logo">
        <img style="text-align:center; width: 73%" src="{{asset('dist/img/logo.jpg')}}"> <br> 
        <a href=""><b>Intranet</b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
  
        <form class="form-signin" action="{{ route('login') }}" method="POST">
        @csrf
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group mb-3">
                <input type="text" name="username" class="form-control" placeholder="{{$placeholder['username']}}">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
                </div>
            </div>
            
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group mb-3">
                <input type="password" name="password" class="form-control" placeholder="{{$placeholder['password']}}">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            
            @error('status')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="row">
                <div class="col-8">
                </div>
                <!-- /.col -->
                <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">{{$btn_submit_title}}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
  
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection