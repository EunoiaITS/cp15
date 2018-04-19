@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">View QR Order List</h3>
                    @if(session()->has('success-message'))
                        <p class="alert alert-success">
                            {{ session()->get('success-message') }}
                        </p>
                    @endif
                    @if(session()->has('error-message'))
                        <p class="alert alert-danger">
                            {{ session()->get('error-message') }}
                        </p>
                    @endif
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
                                    <td id="category{{ $qr->id }}">{{ $qr->cate->category }}</td>
                                    <?php $count = 0; ?>
                                    @foreach($qr->items as $item)
                                        <?php $count++; ?>
                                        <span id="item{{ $count.$qr->id }}" class="hidden item-id{{ $qr->id }}">{{ $item->id }}</span>
                                        <span id="item-name{{ $count.$qr->id }}" class="hidden">{{ $item->item_name }}</span>
                                        <span id="item-no{{ $count.$qr->id }}" class="hidden">{{ $item->item_no }}</span>
                                        <span id="quantity{{ $count.$qr->id }}" class="hidden">{{ $item->quantity }}</span>
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
                    <!-- pagination -->
                    <div class="col-sm-10">
                        <div class="float-pagination">
                            <nav aria-label="Page navigation example">
                                {{ $qrs->links() }}
                            </nav>
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
                            <p id="view-pr-id" class="pr-text">12345</p>
                        </div>
                        <div class="form-group clearfix">
                            <p class="label-d">PR Type <span class="fright">:</span></p>
                            <p id="view-pr-type" class="pr-text">ABC</p>
                        </div>
                        <div class="form-group clearfix">
                            <p class="label-d">Category <span class="fright">:</span></p>
                            <p id="view-category" class="pr-text">Xyz</p>
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
                                <tbody id="add-item-table-view">
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
    <div class="popup-wrapper-view popup-model-qr">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <div class="search-destination">
                        <h2 class="search-title">Edit QR Order</h2>
                    </div>
                    <!-- header got seach area -->
                    <div class="popup-got-search">
                        <form method="post" action="{{ url('/qr-orders/edit') }}">
                            {{ csrf_field() }}
                            <div class="form-group clearfix">
                                <label for="pr-id" class="label-d">PR ID <span class="fright">:</span></label>
                                <input name="pr_id" type="text" class="form-control from-qr" id="edit-pr-id">
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-type" class="label-d">PR Type <span class="fright">:</span></label>
                                <input name="pr_type" type="text" class="form-control from-qr" id="edit-pr-type">
                            </div>
                            <div class="form-group live-search live-search-popup">
                                <label for="edit-pr-category" class="label-d">Category <span class="fright">:</span></label>
                                <select data-live-search="true" name="category" type="text" class="selectpicker category" id="edit-pr-category">
                                    @foreach($cat as $c)
                                        <option value="{{$c->id}}">{{$c->category}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="qr_id" id="edit-qr-id" value="">
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
                                    <tbody id="add-item-table-edit">
                                    <tr>
                                        <td>1</td>
                                        <td><input type="text" class="form-control from-qr" id="pr-item-name-edit" name="prItem"></td>
                                        <td><input type="text" class="form-control from-qr" id="pr-item-code-edit" name="prItemcode"></td>
                                        <td><input type="text" class="form-control from-qr" id="pr-quantity-edit" name="prQuantity"></td>
                                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-times"></i></button></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id="add-item-create" class="btn btn-info btn-price btn-popup-add">Add Item</button>

                            <div id="deleted-items"></div>
                            <div class="col-sm-12">
                                <div class="btn-button-group btn-button-group-opitonal clearfix">
                                    <button class="btn btn-info btn-price">Save</button>
                                    <button type="button" class="btn btn-info btn-popup close">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div><!--// end header got search area -->
                </div>
            </div>
        </div>
    </div><!-- Popup -->

    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close-edit-button" data-dismiss="modal" aria-label="Close"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title">Delete QR Order Item</h4>
                </div>
                <div class="modal-body">
                    <div class="popup-got-search">
                        <p>Are you sure you want to delete this item ?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ url('/qr-orders/delete-item') }}">
                        {{ csrf_field() }}
                        <input type="hidden" id="delete_item_id" name="delete_item_id" value="">
                        <div class="btn-group-sm-list">
                            <button type="submit" class="btn btn-info btn-price">Yes</button>
                            <button type="button" class="btn btn-info btn-popup" data-dismiss="modal">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                        <form method="post" action="{{ url('/qr-orders/delete') }}">
                            {{ csrf_field() }}
                        <div class="btn-button-group clearfix">
                            <input type="hidden" id="delete_id" name="delete_id" value="">
                            <button type="submit" class="btn btn-info btn-price">Delete</button>
                            <button type="button" class="btn btn-info btn-popup close">Cancel</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Popup -->
@endsection
