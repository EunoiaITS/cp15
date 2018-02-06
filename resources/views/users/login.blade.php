@extends('layoutLogin')
@section('content')
    <body>
    <!--[if lte IE 9]>
    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
    <![endif]-->
    <!--login page -->
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="login-form clearfix">
                        <div class="col-sm-5 login-logo">
                            <div class="logo-area text-uppercase">
                                <img src="{{ URL::asset('assets/img/logo.png') }}" class="img-responsive" alt="">
                                <h3>BBC Plantation</h3>
                            </div>
                            <div class="alert-message">
                                <h3>Please <br> Enter Your <br> Email and <br> Password.</h3>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="sign-in-form">
                                <h3>Sign In</h3>
                                <p>Simply Enter Your Email and Password to login.</p>
                                @if(session()->has('error-message'))
                                    <p class="alert alert-danger">
                                        {{ session()->get('error-message') }}
                                    </p>
                                @endif
                                @if(session()->has('success-message'))
                                    <p class="alert alert-success">
                                        {{ session()->get('success-message') }}
                                    </p>
                                @endif
                                <form method="post" action="{{ url('login') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input name="email" type="text" class="form-control" placeholder="Email" required="required" value="{{ old('email') }}">
                                    </div>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" placeholder="Password" required="required">
                                    </div>
                                    <a href="{{ url('forget-password') }}">Forget Password ?</a>
                                    <div class="login-button clearfix">
                                        <button type="submit" class="btn btn-info btn-login">Login</button>
                                        <button type="button" class="btn btn-info btn-cancel">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
