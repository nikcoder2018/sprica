@extends('layouts.admin.auth')

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">{{$admin_log_desc}}</p>
        <form class="form-signin" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input placeholder="{{$placeholder['username']}}" type="text" class="form-control vRequired" name="username" />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
            <div class="input-group mb-3">
                <input placeholder="{{$placeholder['password']}}" type="password" class="form-control vRequired" name="password" />
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('password')
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
@endsection