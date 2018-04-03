@extends('layout')
@section('content')

    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-0">
                    <h3 class="text-uppercase color-bbc">Quotation Approval</h3>
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
                                </tr>
                                </thead>
                                <tbody>
                                <?php $count = 0; ?>
                                @foreach($allInvites as $invite)
                                    @if(isset($invite->invited) && $invite->invited == 'yes')
                                        <?php $count++; ?>
                                        <tr>
                                            <td>{{ $count }}</td>
                                            <td><a style="cursor: pointer" class="pr-modal" rel="{{ $count }}" data-toggle="modal" data-target="#myModal{{ $count }}">{{ $invite->qr_details->pr_id }}</a></td>
                                            <td>{{ $invite->qr_details->pr_type }}</td>
                                            <td>{{ date('d-M-Y', strtotime($invite->start_date)) }}</td>
                                            <td>{{ date('d-M-Y', strtotime($invite->end_date)) }}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- pagination -->
                    <div class="col-sm-10">
                        <div class="float-pagination">
                            <nav aria-label="Page navigation example">
                                {{ $allInvites->links() }}
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--
   PR ID popup content
   ========================-->
    <?php $j=0;?>
    @foreach($allInvites as $invite)
        <?php $j++?>
    <div id="myModal{{$j}}" class="popup-prid-comparison">
        <form action="{{ url('/approve-quotations') }}" method="post">
            {{csrf_field()}}
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove" data-dismiss="modal"></i>
                <div class="row">
                    <div class="search-destination">
                        <h2 class="pr-title"><span class="pr-id">PR ID: {{ $invite->qr_details->pr_id }}</span><span class="prtext"></span></h2>
                    </div>
                    <!-- header got seach area -->
                    <div class="popup-got-search popup-pie clearfix">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="text-align: center;">No</th>
                                    <th style="text-align: center;">Item Code</th>
                                    <th style="text-align: center;">Item Name</th>
                                    <th style="text-align: center;">Quantity</th>
                                    <th style="text-align: center;">Unit Price</th>
                                    <th style="text-align: center;">Supplier Name</th>
                                    <th style="text-align: center;">Comment</th>
                                    <th style="text-align: center;">File</th>
                                    <th style="text-align: center;">Price Compare</th>
                                    <th style="text-align: center;">To Approve</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $c = 0;?>
                                @foreach($invite->qr_items as $qr)
                                    @if(isset($qr->ex) && ($qr->exists == 'yes'))
                                        @if(isset($qr->supplierQuote))
                                            @foreach($qr->supplierQuote as $sq)
                                <?php $c++;?>
                                <tr>
                                    <td style="text-align: center;">{{ $c }}</td>
                                    <td style="text-align: center;">{{ $qr->item_no }}</td>
                                    <td style="text-align: center;" id="item-name-{{ $sq->id }}">{{ $qr->item_name }}</td>
                                    <td style="text-align: center;">{{ $qr->quantity }}</td>
                                    <td style="text-align: center;" id="unit-price-{{ $sq->id }}" class="up-htl">{{ $sq->unit_price }}</td>
                                    <td style="text-align: center;" id="supplier-name-{{ $sq->id }}">{{ $sq->sup_details->name }}</td>
                                    <td style="text-align: center;">{{ $sq->comment }}</td>
                                    <td style="text-align: center;"><a href="@if($sq->file != null){{ URL::asset('/public/uploads/'.$sq->file) }}@endif" target="_blank"><?php if($sq->file != null){echo "View";}?></a></td>
                                    <td style="text-align: center;">
                                        <label>
                                            <input type="checkbox" rel="{{ $sq->id }}" class="select-multiple {{$qr->item_no}} select-items{{$j}}" id="{{$qr->item_no}}{{$j}}" value="{{$qr->item_no}}">
                                        </label>
                                    </td>
                                    <td style="text-align: center;">
                                        <label>
                                            <input type="checkbox" rel="{{ $sq->id }}" class="select-items{{$j}}" name="state{{ $sq->id }}">
                                        </label>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
                                @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div><!--// end header got search area -->
                    <div class="btn-button-group clearfix">
                        <button type="button" class="btn btn-info btn-price open-popup-comp price-compare">Price Comparison</button>
                        <button type="submit" class="btn btn-info btn-price approve">Approve</button>
                    </div>
                </div>
            </div>
        </div>
      </form>
    </div><!-- Popup -->
    @endforeach
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
                <button class="btn btn-info btn-popup close-comp">Close</button>
            </div>
        </div>
    </div>
</div><!-- Popup -->
@endsection