@extends('layoutLogin')
@section('content')
<div class="wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-1 col-md-10 col-sm-12">
                <div class="login-form clearfix">
                    <div class="col-sm-5 login-logo">
                        <div class="logo-area text-uppercase">
                            <img src="img/logo.png" class="img-responsive" alt="">
                            <h3>Company Name</h3>
                        </div>
                        <div class="alert-message">
                            <h3>Please <br> Enter Your Username  <br> and Password.</h3>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="sign-in-form">
                            <h3>Create User</h3>
                            @if($errors->any())
                                @foreach($errors->all() as $error)
                                <p class="alert alert-danger">
                                    {{ $error }}
                                </p>
                                @endforeach
                            @endif
                            <p>Simply Enter Your Username and Password to Create User.</p>
                            <form action="{{url('superuser/create')}}" method="post">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <input type="text" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}">
                                    @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('email') }}</p>@endif
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control" placeholder="Password" value="{{ old('password') }}">
                                    @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('password') }}</p>@endif
                                </div>
                                <div class="login-button clearfix">
                                    <button type="submit" class="btn btn-info btn-login">Create</button>
                                    <button class="btn btn-info btn-cancel">Cancel</button>
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
