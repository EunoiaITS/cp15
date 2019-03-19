@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">QR Order</h3>
                    <div class="col-sm-8 padding-left-0">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>PR ID</th>
                                    <th>PR Type</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($qrs as $qr)
                                    <tr>
                                        <td id="pr_id{{ $qr->id }}">{{ $qr->pr_id }}</td>
                                        <span id="pr_type{{ $qr->id }}" class="hidden">{{ $qr->pr_type }}</span>
                                        <td id="category{{ $qr->id }}">{{ $qr->category }}</td>
                                        <?php $count = 0; ?>
                                        @foreach($qr->items as $item)
                                            <?php $count++; ?>
                                            <span id="item{{ $count.$qr->id }}" class="hidden item-id{{ $qr->id }}">{{ $item->id }}</span>
                                            <span id="item-name{{ $count.$qr->id }}" class="hidden">{{ $item->item_name }}</span>
                                            <span id="item-no{{ $count.$qr->id }}" class="hidden">{{ $item->item_no }}</span>
                                            <span id="quantity{{ $count.$qr->id }}" class="hidden">{{ $item->quantity }}</span>
                                            <span id="item-file{{ $count.$qr->id }}" class="hidden">{{ $item->item_file }}</span>
                                        @endforeach
                                        <td><button rel="{{ $qr->id }}" id="view{{ $qr->id }}" class="btn btn-info btn-view-table open-popup view-details">View</button></td>
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
    <div class="popup-wrapper-view">
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
                                    <th>File (BBC)</th>
                                </tr>
                                </thead>
                                <tbody id="add-item-table-view">
                                </tbody>
                            </table>
                        </div>
                    </div><!--// end header got search area -->
                </div>
            </div>
        </div>
    </div><!-- Popup -->
    @endsection