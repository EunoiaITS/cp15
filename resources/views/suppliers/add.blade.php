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
                        <form action="#">
                            <div class="form-group clearfix">
                                <label for="supplier-name" class="label-d">Supplier Name <span class="fright">:</span></label>
                                <input type="text" class="form-control from-qr" id="supplier-name">
                            </div>
                            <div class="form-group clearfix">
                                <label for="catagory-catagory" class="label-d">Category <span class="fright">:</span></label>
                                <input type="text" class="form-control from-qr" id="catagory-catagory">
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-email" class="label-d">Email Address <span class="fright">:</span></label>
                                <input type="text" class="form-control from-qr" id="pr-email">
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-contact" class="label-d">Contact <span class="fright">:</span></label>
                                <input type="text"  class="form-control from-qr" id="pr-contact">
                            </div>
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