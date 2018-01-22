@extends('layout')
@section('content')
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <h3 class="text-uppercase color-bbc">Change Password</h3>
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">
                            {{ $error }}
                        </p>
                    @endforeach
                @endif
                @if(session()->has('success-message'))
                    <p class="alert alert-success">
                        {{ session()->get('success-message') }}
                    </p>
                @endif
                <div class="col-sm-10 padding-left-0">
                    <div class="create-qr">
                        <form action="{{ url('/change-password') }}" method="post">
                            {{csrf_field()}}
                            <div class="form-group clearfix">
                                <label for="old-pass" class="label-d">Old Password<span class="fright">:</span></label>
                                <input type="password" class="form-control from-qr" name="old_pass" id="old-pass" required="required">
                            </div>
                            <div class="form-group clearfix">
                                <label for="new-pass" class="label-d">New Password<span class="fright">:</span></label>
                                <input type="password" class="form-control from-qr" name="new_pass" id="new-pass" required="required">
                            </div>
                            <div class="form-group clearfix">
                                <label for="retype-pass" class="label-d">Re-type Password <span class="fright">:</span></label>
                                <input type="password" class="form-control from-qr" name="retype_pass" id="retype-pass" required="required">
                            </div>
                            <div class="btn-button-group clearfix">
                                <button class="btn btn-info btn-price">Submit</button>
                                <button class="btn btn-info">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    @endsection