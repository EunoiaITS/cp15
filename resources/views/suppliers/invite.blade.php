@extends('layout')
@section('content')
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <h3 class="text-uppercase color-bbc">Invite Suppliers</h3>
                <div class="col-sm-10 padding-left-0">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>PR ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Selection</th>
                                <th>Select Supplier</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> </td>
                                <td><input type="text" class="form-control from-qr datepicker-f"></td>
                                <td><input type="text" class="form-control from-qr datepicker-f"></td>
                                <td><label><input type="checkbox" value=""></label></td>
                                <td><button class="btn btn-info btn-view-table open-popup">Supplier</button></td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td><input type="text" class="form-control from-qr"></td>
                                <td><input type="text" class="form-control from-qr"></td>
                                <td><label><input type="checkbox" value=""></label></td>
                                <td><button class="btn btn-info btn-view-table open-popup">Supplier</button></td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td><input type="text" class="form-control from-qr"></td>
                                <td><input type="text" class="form-control from-qr"></td>
                                <td><label><input type="checkbox" value=""></label></td>
                                <td><button class="btn btn-info btn-view-table open-popup">Supplier</button></td>
                            </tr>
                            <tr>
                                <td> </td>
                                <td><input type="text" class="form-control from-qr"></td>
                                <td><input type="text" class="form-control from-qr"></td>
                                <td><label><input type="checkbox" value=""></label></td>
                                <td><button class="btn btn-info btn-view-table open-popup">Supplier</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="btn-button-group clearfix">
                        <button class="btn btn-info btn-price">Send to Supplier</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--=============
Search popuppage
==================-->
<div class="popup-wrapper-view">
    <div class="popup-base">
        <div class="search-popup">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <div class="search-destination">
                    <h2 class="search-title">Select Suppliers</h2>
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>List Of Suppliers</th>
                                <th>Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td></td>
                                <td><label><input type="checkbox" value=""></label></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td><label><input type="checkbox" value=""></label></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <button class="btn btn-info btn-popup close">Confirm</button>
                </div><!--// end header got search area -->
            </div>
        </div>
    </div>
</div><!-- Popup -->
@endsection