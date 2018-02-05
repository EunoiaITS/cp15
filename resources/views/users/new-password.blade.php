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
                                <h3>Bumihas Sdn Bhd</h3>
                            </div>
                            <div class="alert-message">
                                <h3>Please <br> Enter Your <br> New Password </h3>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="sign-in-form">
                                <h3>Reset Password</h3>
                                <p>Simply Enter Your Password to Reset Your Password.</p>
                                @if(session()->has('success-message'))
                                    <p class="alert alert-success">
                                        {{ session()->get('success-message') }}
                                    </p>
                                @endif
                                @if(session()->has('error-message'))
                                    <p class="alert alert-success">
                                        {{ session()->get('error-message') }}
                                    </p>
                                @endif
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <p class="alert alert-danger">
                                            {{ $error }}
                                        </p>
                                    @endforeach
                                @endif
                                <form method="post" action="{{ url('/new-password/{token}') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control" placeholder="New Password" required="required" value="">
                                    </div>
                                    <div class="form-group">
                                        <input name="repass" type="password" class="form-control" placeholder="Confirm Password" required="required" value="">
                                    </div>
                                    <input type="text" name="email" value="{{ $email }}" hidden>
                                    <div class="login-button clearfix">
                                        <button type="submit" class="btn btn-info btn-login">Submit</button>
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
