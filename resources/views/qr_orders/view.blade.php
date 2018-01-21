@extends('layout')
@section('content')
    <!-- content area-->
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
                                    <th>Category</th>
                                    <th>Details</th>
                                    <th>Edit/Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($qrs as $qr)
                                <tr>
                                    <td id="pr_id{{ $qr->id }}">{{ $qr->pr_id }}</td>
                                    <td id="pr_type{{ $qr->id }}">{{ $qr->pr_type }}</td>
                                    <td id="category{{ $qr->id }}">{{ $qr->category }}</td>
                                    @foreach($qr->items as $item)
                                        <span class="hidden item-id{{ $qr->id }}">{{ $item->id }}</span>
                                        <span id="item-name{{ $item->id }}" class="hidden">{{ $item->item_name }}</span>
                                        <span id="item-no{{ $item->id }}" class="hidden">{{ $item->item_no }}</span>
                                        <span id="category{{ $item->id }}" class="hidden">{{ $item->quantity }}</span>
                                    @endforeach
                                    <td><button rel="{{ $qr->id }}" id="view{{ $qr->id }}" class="btn btn-info btn-view-table open-popup-comp view-details">View</button></td>
                                    <td><button rel="{{ $qr->id }}" id="edit{{ $qr->id }}" class="btn btn-info btn-view-table open-popup popup-left edit-qr">Edit</button>
                                        <button rel="{{ $qr->id }}" id="delete{{ $qr->id }}" class="btn btn-info btn-view-table open-popup-delete delete-qr">Delete</button></td>
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

    <!--=============
            View Qr Order Popup:manager
            ==================-->
    <div class="popup-wrapper-compa">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <div class="search-destination">
                        <h2 class="search-title">View QR Order</h2>
                    </div>
                    <!-- header got seach area -->
                    <div class="popup-got-search">
                        <div class="form-group clearfix">
                            <p class="label-d">PR ID <span class="fright">:</span></p>
                            <p class="pr-text">12345</p>
                        </div>
                        <div class="form-group clearfix">
                            <p class="label-d">PR Type <span class="fright">:</span></p>
                            <p class="pr-text">ABC</p>
                        </div>
                        <div class="form-group clearfix">
                            <p class="label-d">Category <span class="fright">:</span></p>
                            <p class="pr-text">Xyz</p>
                        </div>
                        <div class="col-sm-10 table-responsive" style="margin-top: 20px;">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Items Name</th>
                                    <th>Item Code</th>
                                    <th>Quantity</th>
                                </tr>
                                </thead>
                                <tbody id="add-item-table-item">
                                <tr>
                                    <td>01</td>
                                    <td>12345</td>
                                    <td>abc</td>
                                    <td>Xyz</td>
                                </tr>
                                <tr>
                                    <td>02</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!--// end header got search area -->
                </div>
            </div>
        </div>
    </div><!-- Popup -->

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
                            <div id="add-item-table" class="col-sm-10 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Items Name</th>
                                        <th>Items Code</th>
                                        <th>Quantity</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody id="add-item-table-item">
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control from-qr" id="pr-item-name-edit" name="prItem"></td>
                                        <td><input type="text" class="form-control from-qr" id="pr-item-code-edit" name="prItemcode"></td>
                                        <td><input type="text" class="form-control from-qr" id="pr-quantity-edit" name="prQuantity"></td>
                                        <td><button class="btn btn-info btn-view-table"><i class="fa fa-times"></i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button id="add-item-create" class="btn btn-info btn-price btn-popup-add">Add Item</button>

                            <div class="col-sm-12">
                                <div class="btn-button-group btn-button-group-opitonal clearfix">
                                    <button class="btn btn-info btn-price">Save</button>
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
                            <button class="btn btn-info btn-price">Delete</button>
                            <button class="btn btn-info btn-popup close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Popup -->
@endsection