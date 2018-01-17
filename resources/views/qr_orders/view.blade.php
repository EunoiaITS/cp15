@extends('layout')
@section('content')
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <h3 class="text-uppercase color-bbc">View QR Order List</h3>
                <div class="col-sm-10 padding-left-0">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>PR ID</th>
                                <th>PR Type</th>
                                <th>Catagory</th>
                                <th>Items Name</th>
                                <th>Item Code</th>
                                <th>Quantity</th>
                                <th>Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>ert</td>
                                <td>ert</td>
                                <td>ert</td>
                                <td>ert</td>
                                <td>ert</td>
                                <td>ert</td>
                                <td><button class="btn btn-info btn-view-table open-popup popup-left">Edit</button>
                                    <button class="btn btn-info btn-view-table open-popup-delete">Delete</button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><button class="btn btn-info btn-view-table open-popup popup-left">Edit</button>
                                    <button class="btn btn-info btn-view-table open-popup-delete">Delete</button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><button class="btn btn-info btn-view-table open-popup popup-left">Edit</button>
                                    <button class="btn btn-info btn-view-table open-popup-delete">Delete</button></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><button class="btn btn-info btn-view-table open-popup popup-left">Edit</button>
                                    <button class="btn btn-info btn-view-table open-popup-delete">Delete</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--=============
edit qr popup
==================-->
<div class="popup-wrapper-view">
    <div class="popup-base">
        <div class="search-popup">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <div class="search-destination">
                    <h2 class="search-title">Edit QR Order</h2>
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search">
                    <form action="#">
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
                        <div class="form-group clearfix">
                            <label for="pr-name" class="label-d">Items Name <span class="fright">:</span></label>
                            <input type="text" class="form-control from-qr" id="pr-name">
                        </div>
                        <div class="form-group clearfix">
                            <label for="pr-code" class="label-d">Item Code <span class="fright">:</span></label>
                            <input type="text" class="form-control from-qr" id="pr-code">
                        </div>
                        <div class="form-group clearfix" style="position: relative;">
                            <label for="pr-quantity" class="label-d">Quantity <span class="fright">:</span></label>
                            <input type="text" class="form-control from-qr" id="pr-quantity">
                        </div>

                        <div class="col-sm-12">
                            <div class="btn-button-group clearfix">
                                <button class="btn btn-info btn-price open-popup-comp">Save</button>
                                <button class="btn btn-info btn-popup close">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div><!--// end header got search area -->
            </div>
        </div>
    </div>
</div><!-- Popup -->

<!--
delete popup
========================-->
<div class="popup-wrapper-delete">
    <div class="popup-base">
        <div class="search-popup">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <div class="search-destination">
                    <h2 class="search-title">Delete QR Order</h2>
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search">
                    <p>Confirm to delete the QR from the view QR Order list ?</p>
                </div><!--// end header got search area -->
                <div class="col-sm-12">
                    <div class="btn-button-group clearfix">
                        <button class="btn btn-info btn-price open-popup-comp">Delete</button>
                        <button class="btn btn-info btn-popup close">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Popup -->
@endsection