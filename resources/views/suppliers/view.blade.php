@extends('layout')
@section('content')
<!-- content area-->
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <h3 class="text-uppercase color-bbc">View Supplier List</h3>
                <div class="col-sm-10 padding-left-0">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Supplier Name</th>
                                <th>Category</th>
                                <th>Email Address</th>
                                <th>Contact</th>
                                <th>Edit/Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($result as $res)
                            <tr>
                                <td>{{$res->name}}</td>
                                <td>@foreach($res->info as $in){{ $in->category }}@endforeach</td>
                                <td>{{$res->email}}</td>
                                <td>@foreach($res->info as $in){{ $in->contact }}@endforeach</td>
                                <td><button class="btn btn-info btn-view-table open-popup popup-left">Edit</button>
                                    <button class="btn btn-info btn-view-table open-popup-delete">Delete</button></td>
                            </tr>
                            @endforeach
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
                    <h2 class="search-title">Edit Supplier</h2>
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search">
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
                            <input type="text" class="form-control from-qr" id="pr-contact">
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
                    <h2 class="search-title">Delete Supplier</h2>
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search">
                    <p>Confirm to delete the Supplier from the view Supplier list ?</p>
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