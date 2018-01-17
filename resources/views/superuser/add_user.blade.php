
@extends('layout')
@section('content')
<!-- content area-->

<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <div class="col-sm-10 padding-left-0">
                    <div class="create-qr clearfix">
                        <h3 class="text-uppercase color-bbc">Create Users</h3>
                        @if(session()->has('success-message'))
                            <p class="alert alert-success">
                                {{ session()->get('success-message') }}
                            </p>
                        @endif
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger">
                                    {{ $error }}
                                </p>
                            @endforeach
                        @endif
                        <form action="{{url('superuser')}}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group clearfix">
                                <label for="supplier-name" class="label-d">Name <span class="fright">:</span></label>
                                <input name="name" type="text" class="form-control from-qr" id="supplier-name" value="{{ old('name') }}" required="">
                                @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('name') }}</p>@endif
                            </div>
                            <div class="form-group clearfix">
                                <label for="catagory-catagory" class="label-d">Role <span class="fright">:</span></label>
                                <select name="role" class="form-control from-qr" id="catagory-catagory">
                                    @foreach($roles as $role)
                                    <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-email" class="label-d">Email Address <span class="fright">:</span></label>
                                <input name="email" type="email" class="form-control from-qr" id="pr-email" value="{{ old('email') }}" required="">
                                @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('email') }}</p>@endif
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-contact" class="label-d">Password <span class="fright">:</span></label>
                                <input name="password" type="password"  class="form-control from-qr" id="pr-contact">
                                @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('password') }}</p>@endif
                            </div>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-info btn-price" style="float: right;">Add User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection
