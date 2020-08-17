{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
@extends('satadmin::layout/layoutLog')

@section('content')

<style>
    body {
        font-family: "Lato", sans-serif;
    }



    .main-head{
        height: 150px;
        background: #FFF;
    
    }

    .sidenav {
        height: 100%;
        background-color: #3F233A;
        overflow-x: hidden;
        padding-top: 20px;
    }


    .main {
        padding: 0px 10px;
    }

    @media screen and (max-height: 450px) {
        .sidenav {padding-top: 15px;}
    }

    @media screen and (max-width: 450px) {
        .login-form{
            margin-top: 10%;
        }

        .register-form{
            margin-top: 10%;
        }
    }

    @media screen and (min-width: 768px){
        .main{
            margin-left: 40%; 
        }

        .sidenav{
            width: 40%;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
        }

        .login-form{
            margin-top: 80%;
        }

        .register-form{
            margin-top: 20%;
        }
    }


    .login-main-text{
        margin-top: 20%;
        padding: 60px;
        color: #fff;
        animation-name: fadeIn;
        animation-duration: 0.7s;
    }

    #loginFormHome{
        animation-name: fadeIn;
        animation-duration: 0.7s;
    }

    .login-main-text h2{
        font-weight: 300;
    }

    .btn-black{
        background-color: #000 !important;
        color: #fff;
    }

    .sidenav h1{
        font-size: 47px;
        font-family: "AlexBrush";
    }

    .loading{
        margin-top: 300px;
        animation-name: fadeIn;
        animation-fill-mode: both;
        animation-duration: 0.7s;
    }

</style>



<div class="sidenav">
    <div class="login-main-text">
       <h1 class="py-4">Satadmin</h1>
       <span class="pl-5"><i>Make it front-end easy for development ...</i></span>
    </div>
 </div>
 <div class="main">
    <div class="col-md-6 col-sm-12">
       <div class="login-form">
          {{-- {% if error %}
             <div class="alert alert-danger">{{ error.messageKey|trans(error.messageData, 'security') }}</div>
       {% endif %}
 
       {% if app.user %}
             <div class="mb-3">
                You are logged in as {{ app.user.username }}, <a href="{{ path('app_logout') }}">Logout</a>
             </div>
       {% endif %} --}}
 
          <form method="POST" id="loginFormHome" action="{{ route('admin.login.send') }}">

            @csrf
            
             <div class="form-group">
                <label>Email</label>
                <input type="email" value="" name="email" id="inputEmail" class="form-control" required autofocus>
             </div>
             <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="inputPassword" class="form-control" required>
             </div>
                {{-- <a href="" class="btn btn-success">Login</a> --}}
             <button type="submit" class="btn btn-secondary">Login</button>
          </form>
       </div>
    </div>
 </div>

 @endsection
