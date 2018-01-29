@extends('layout')
@section('content')
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <form action="{{ url('/approve-quotations') }}" method="post">
                {{csrf_field()}}
            <div class="col-sm-12 col-sm-offset-0">
                <h3 class="text-uppercase color-bbc">Supplier Quotation</h3>
                @if(session()->has('success-message'))
                    <p class="alert alert-success">
                        {{ session()->get('success-message') }}
                    </p>
                @endif
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
                            <?php $i= 1;?>
                            @foreach($quotations as $q)
                                <tr>
                                <td>{{$i++}}</td>
                                <td>@foreach($q->qr_details as $qr){{$qr->pr_id}}@endforeach</td>
                                <td>@foreach($q->qr_details as $qr){{$qr->pr_type}}@endforeach</td>
                                <td>@foreach($q->dates as $qr){{ $qr->start_date }}@endforeach</td>
                                <td>@foreach($q->dates as $qr){{ $qr->end_date }}@endforeach</td>
                                <td>@foreach($q->item_details as $qr){{ $qr->item_name }}@endforeach</td>
                                <td>@foreach($q->item_details as $qr){{ $qr->item_no }}@endforeach</td>
                                <td>@foreach($q->item_details as $qr){{ $qr->quantity }}@endforeach</td>
                                <td>{{ $q->unit_price }}</td>
                                <td>{{$q->supplier_details->name}}</td>
                                <td>{{ $q->comment }}</td>
                                <td><a href="@if($q->file != null){{ URL::asset('/uploads/'.$q->file) }}@endif" target="_blank">View</a></td>
                                <td>
                                    <label><input type="checkbox" rel="@foreach($q->item_details as $qr){{ $qr->item_name }}@endforeach" class="select-items" name="state{{ $q->id }}" value="approved" @if($q->status == 'approved'){{ 'checked' }}@endif></label>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="btn-button-group clearfix">
                        <button type="button" id="price-compare" class="btn btn-info btn-price open-popup-comp">Price Comparison</button>
                        <button type="submit" class="btn btn-info btn-price approve">Approve</button>
                    </div>
                </div>
            </div>
            </form>
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
                <div class="popup-got-search popup-pie clearfix" id="item-chart">
                    <!-- Pie chart -->
                    <div id="canvas-holder">
                        <p class="text-center">Item 1</p>
                        <canvas id="chart-area"/>
                    </div>
                    <div id="canvas-holder">
                        <p class="text-center">Item 2</p>
                        <canvas id="chart-area2" />
                    </div>
                    <!-- Pie chart -->
                    <div id="canvas-holder">
                        <p class="text-center">Item 3</p>
                        <canvas id="chart-area3"/>
                    </div>
                    <div id="canvas-holder">
                        <p class="text-center">Item 4</p>
                        <canvas id="chart-area4" />
                    </div>
                    <div class="clearfix">
                    </div>
                </div><!--// end header got search area -->
                <button class="btn btn-info btn-popup close">Close</button>
            </div>
        </div>
    </div>
</div><!-- Popup -->
@endsection