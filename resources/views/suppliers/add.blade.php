@extends('layout')
@section('content')
<!-- content area-->
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <div class="col-sm-10 padding-left-0">
                    <div class="create-qr clearfix">
                        <h3 class="text-uppercase color-bbc">Create Supplier List</h3>
                        @if(session()->has('error'))
                            <p class="alert alert-success">
                                {{ session()->get('error') }}
                            </p>
                        @endif
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

                        <form action="{{ url('suppliers/add-supplier') }}" method="post">
                                    {{ csrf_field() }}
                            <div class="form-group clearfix">
                                <label for="supplier-name" class="label-d">Supplier Name <span class="fright">:</span></label>
                                <input type="text" name="name" class="form-control from-qr" id="supplier-name">
                            </div>
                            <div class="form-group clearfix">
                                <label for="catagory-catagory" class="label-d">Category <span class="fright">:</span></label>
                                <input type="text" name="category" class="form-control from-qr category" id="catagory-catagory">
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-email" class="label-d">Email Address <span class="fright">:</span></label>
                                <input type="text" name="email" class="form-control from-qr" id="pr-email">
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-password" class="label-d">Password <span class="fright">:</span></label>
                                <input type="password" name="password" class="form-control from-qr" id="pr-password">
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-contact" class="label-d">Contact <span class="fright">:</span></label>
                                <input type="text" name="contact" class="form-control from-qr" id="pr-contact">
                            </div>
                            <input type="hidden" name="role" value="suppliers">
                            <input type="hidden" name="user_id" value="">
                            <div class="col-sm-9">
                                <button class="btn btn-info btn-price" style="float: right;">Add Supplier</button>
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