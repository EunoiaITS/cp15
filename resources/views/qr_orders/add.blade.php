@extends('layout')
@section('content')
<!-- content area-->
@if($errors->any())
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{$error}}</p>
        @endforeach
    @endif
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <div class="col-sm-10 padding-left-0">
                    <div class="create-qr">
                        <h3 class="text-uppercase color-bbc">Create QR Order</h3>
                        <form action="{{ url('/qr-orders/addQROrder') }}" method="post">
                                {{ csrf_field() }}
                            <div class="form-group clearfix">
                                <label for="pr-id" class="label-d">PR ID <span class="fright">:</span></label>
                                <input type="text" name="pr_id" class="form-control from-qr" id="pr-id">
                                @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('pr_id') }}</p>@endif
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-type" class="label-d">PR Type <span class="fright">:</span></label>
                                <input type="text" name="pr_type" class="form-control from-qr" id="pr-type">
                                @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('pr_type') }}</p>@endif
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-catagory" class="label-d">Category <span class="fright">:</span></label>
                                <input type="text" name="category" class="form-control from-qr" id="pr-catagory">
                                @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('category') }}</p>@endif
                            </div>
                            <div id="add-item-table" class="clearfix">
                                <div class="form-group clearfix">
                                    <label for="pr-name" class="label-d">Items Name <span class="fright">:</span></label>
                                    <input type="text"  name="item_name" class="form-control from-qr" id="pr-name1">
                                    @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('item_name') }}</p>@endif
                                </div>
                                <div class="form-group clearfix">
                                    <label for="pr-code" class="label-d">Item Code <span class="fright">:</span></label>
                                    <input type="text" name="item_no" class="form-control from-qr" id="pr-code1">
                                    @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('item_no') }}</p>@endif
                                </div>
                                <div class="form-group clearfix" style="position: relative;">
                                    <label for="pr-quantity" class="label-d">Quantity <span class="fright">:</span></label>
                                    <input type="text" name="quantity" class="form-control from-qr" id="pr-quantity1">
                                    @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('quantity') }}</p>@endif
                                </div>
                            </div>
                            <button id="add-item-create" class="btn btn-info btn-price add-item-qe">Add Item</button>

                            <div class="col-sm-12">
                                <div class="btn-button-group clearfix">
                                    <button class="btn btn-info btn-price">Create</button>
                                    <button class="btn btn-info btn-popup close">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @endsection