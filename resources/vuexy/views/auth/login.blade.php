@extends('layouts.auth')

@section('content')
  <div class="auth-wrapper auth-v2">
    <div class="auth-inner row m-0">
        <!-- Brand logo--><a class="brand-logo" href="javascript:void(0);">
            <img style="text-align:center; width: 73%" src="{{asset('dist/img/logo-auth.jpg')}}">
        </a>
        <!-- /Brand logo-->
        <!-- Left Text-->
        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{asset(env('APP_THEME','default').'/app-assets/images/pages/login-v2-dark.svg')}}" alt="Login V2" /></div>
        </div>
        <!-- /Left Text-->
        <!-- Login-->
        <div class="d-flex col-lg-4 auth-bg px-2 p-lg-5">
            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 pt-5 mx-auto">
                <h4 class="card-title mb-1">Welcome to Sprica! 👋</h4>
                <p class="card-text mb-2">Please sign-in to your account</p>
                <form class="auth-login-form mt-2" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="login-username">Username</label>
                        <input class="form-control" id="login-username" type="text" name="username" aria-describedby="login-username" autofocus="" tabindex="1" />
                        @error('username')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="login-password">Password</label></a>
                        </div>
                        <div class="input-group input-group-merge form-password-toggle">
                            <input class="form-control form-control-merge" id="login-password" type="password" name="password" placeholder="············" aria-describedby="login-password" tabindex="2" />
                            <div class="input-group-append"><span class="input-group-text cursor-pointer"><i data-feather="eye"></i></span></div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input" name="remember_me" id="remember-me" type="checkbox" tabindex="3" />
                            <label class="custom-control-label" for="remember-me"> Remember Me</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block" tabindex="4">Sign in</button>
                </form>

            </div>
        </div>
        <!-- /Login-->
    </div>
</div>
@endsection