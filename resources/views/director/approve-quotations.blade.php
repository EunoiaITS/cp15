@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-sm-offset-0">
                    <h3 class="text-uppercase color-bbc">Supplier Quotation</h3>
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
                                <?php $i= 1; ?>
                                @foreach($quotations as $q)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td class="prId" id=""><a class="pr-modal" rel="{{$i}}" data-toggle="modal" data-target="#myModal{{$i}}">{{ $q->qr_details->pr_id }}</a></td>
                                        <td>{{ $q->qr_details->pr_type }}</td>
                                        <td>{{ $q->qr_dates->start_date }}</td>
                                        <td>{{ $q->qr_dates->end_date }}</td>
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
                                <ul class="pagination">
                                    <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-left"></i></a></li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item"><a class="page-link" href="#"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
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
    <?php $j=1;?>
    @foreach($quotations as $q)
        <?php $j++?>
    <div id="myModal{{$j}}" class="popup-prid-comparison">
        <form action="{{ url('/approve-quotations') }}" method="post">
            {{csrf_field()}}
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove" data-dismiss="modal"></i>
                <div class="row">
                    <div class="search-destination">
                        <h2 class="pr-title"><span class="pr-id">PR ID: {{ $q->qr_details->pr_id }}</span><span class="prtext"></span></h2>
                    </div>
                    <!-- header got seach area -->
                    <div class="popup-got-search popup-pie clearfix">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Item Code</th>
                                    <th>Item Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Supplier Name</th>
                                    <th>Comment</th>
                                    <th>File</th>
                                    <th>Seclection</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php $c = 0;?>
                                @foreach($q->sup_quo as $qr)
                                    @if(isset($qr->ex) && ($qr->exists == 'yes'))
                                        <?php $c++;?>
                                <tr>
                                    <td>{{ $c }}</td>
                                    <td>{{ $qr->item_no }}</td>
                                    <td id="item-name-{{ $qr->id }}">{{ $qr->item_name }}</td>
                                    <td>{{ $qr->quantity }}</td>
                                    <td id="unit-price-{{ $qr->id }}">{{ $qr->unit_price }}</td>
                                    <td id="supplier-name-{{ $qr->id }}">{{ $qr->sup_details->name }}</td>
                                    <td>{{ $qr->comment }}</td>
                                    <td><a href="@if($qr->file != null){{ URL::asset('/public/uploads/'.$qr->file) }}@endif" target="_blank">View</a></td>
                                    <td>
                                        <label>
                                            <input type="checkbox" rel="{{ $qr->id }}" class="select-items{{$j}}" name="state{{ $qr->id }}">
                                        </label>
                                    </td>
                                </tr>
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