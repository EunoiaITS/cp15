@extends('layout')
@section('content')
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-sm-offset-0">
                <h3 class="text-uppercase color-bbc">Supplier Quotation</h3>
                <div class="col-sm-11 padding-left-0">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>PR ID</th>
                                <th>PR Type</th>
                                <th>Issue Date</th>
                                <th>End Date</th>
                                <th>Items Name</th>
                                <th>Item Code</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Suplier Name</th>
                                <th>Comment</th>
                                <th>File</th>
                                <th>Selection</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($supplier_quotation as $sup_quo)
                                @foreach($sup_quo->qr_item as $qr_item)
                                    @foreach($qr_item->qr as $qr)
                                        @foreach($qr->inv as $value)
                            <tr>
                                <td>01</td>
                                <td>{{$qr->pr_id}}</td>
                                <td>{{$qr->pr_type}}</td>
                                <td>{{$value->start_date}}</td>
                                <td>{{$value->end_date}}</td>
                                <td>{{$qr_item->item_name}}</td>
                                <td>{{$qr_item->item_no}}</td>
                                <td>{{$qr_item->quantity}}</td>
                                <td>{{$sup_quo->unit_price}}</td>
                                <td></td>
                                <td>{{$sup_quo->comment}}</td>
                                <td><a href="#">View</a></td>
                                <td>
                                    <label><input type="checkbox" value=""></label>
                                </td>
                            </tr>
                                        @endforeach
                                    @endforeach
                                @endforeach
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="btn-button-group clearfix">
                        <button class="btn btn-info btn-price open-popup-comp">Price Comparison</button>
                        <button class="btn btn-info btn-price approve">Approve</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<!--
price comparison popup
========================-->
<div class="popup-wrapper-compa">
    <div class="popup-base">
        <div class="search-popup">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <div class="search-destination">
                    <h2 class="search-title pie-search">Price Comparison</h2>
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search popup-pie clearfix">
                    <!-- Pie chart -->
                    <div id="canvas-holder" class="canvas-holder-2">
                        <p class="text-center">Item 1</p>
                        <canvas id="chart-area"/>
                    </div>
                    <div id="canvas-holder">
                        <p class="text-center">Item 2</p>
                        <canvas id="chart-area2" />
                    </div>
                    <div class="clearfix">
                        <!-- Pie chart -->
                        <div id="canvas-holder">
                            <p class="text-center">Item 3</p>
                            <canvas id="chart-area3"/>
                        </div>
                        <div id="canvas-holder" class="canvas-holder-1">
                            <p class="text-center">Item 4</p>
                            <canvas id="chart-area4" />
                        </div>
                    </div>
                </div><!--// end header got search area -->
                <button class="btn btn-info btn-popup close">Close</button>
            </div>
        </div>
    </div>
</div><!-- Popup -->
@endsection