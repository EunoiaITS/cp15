@extends('layout')
@section('content')
<!-- content area-->
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <div class="col-sm-10 padding-left-0">
                    <div class="create-qr">
                        <h3 class="text-uppercase color-bbc">Create QR Order</h3>
                        <form action="{{ url('/') }}">
                            <div class="form-group clearfix">
                                <label for="pr-id" class="label-d">PR ID <span class="fright">:</span></label>
                                <input type="text" class="form-control from-qr" id="pr-id">
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-type" class="label-d">PR Type <span class="fright">:</span></label>
                                <input type="text" class="form-control from-qr" id="pr-type">
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-catagory" class="label-d">Category <span class="fright">:</span></label>
                                <input type="text" class="form-control from-qr" id="pr-catagory">
                            </div>
                            <div id="add-item-table" class="clearfix">
                                <div class="form-group clearfix">
                                    <label for="pr-name" class="label-d">Items Name <span class="fright">:</span></label>
                                    <input type="text"  name="itemName1" class="form-control from-qr" id="pr-name1">
                                </div>
                                <div class="form-group clearfix">
                                    <label for="pr-code" class="label-d">Item Code <span class="fright">:</span></label>
                                    <input type="text" name="itemNo1" class="form-control from-qr" id="pr-code1">
                                </div>
                                <div class="form-group clearfix" style="position: relative;">
                                    <label for="pr-quantity" class="label-d">Quantity <span class="fright">:</span></label>
                                    <input type="text" name="itemQuantity1" class="form-control from-qr" id="pr-quantity1">
                                </div>
                            </div>
                            <input type="hidden" name="count" value="1">
                            <button id="add-item-create" class="btn btn-info btn-price add-item-qe">Add Item</button>

                            <div class="col-sm-12">
                                <div class="btn-button-group clearfix">
                                    <button class="btn btn-info btn-price open-popup-comp">Create</button>
                                    <button class="btn btn-info btn-price approve">Cancel</button>
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