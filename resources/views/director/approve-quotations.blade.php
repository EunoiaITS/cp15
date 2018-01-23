@extends('layout')
@section('content')
    <!-- content area-->
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
                                    <th>Selection</th>
                                    <th>Details</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>01 </td>
                                    <td>2142</td>
                                    <td> Rado Passion </td>
                                    <td> 12/2/2017</td>
                                    <td>12/2/2017</td>
                                    <td>N/A</td>
                                    <td>451</td>
                                    <td>tt</td>
                                    <td>4561</td>
                                    <td>N/A</td>
                                    <td>
                                        <label><input type="checkbox" value=""></label>
                                    </td>
                                    <td><button class="btn btn-info btn-view-table open-popup">View</button></td>
                                </tr>
                                <tr>
                                    <td>02 </td>
                                    <td>2142</td>
                                    <td> Rado Passion </td>
                                    <td> 12/2/2017</td>
                                    <td>12/2/2017</td>
                                    <td>N/A</td>
                                    <td>451</td>
                                    <td>tt</td>
                                    <td>4561</td>
                                    <td>N/A</td>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""></label>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-info btn-view-table open-popup">View</button></td>
                                </tr>
                                <tr>
                                    <td>03 </td>
                                    <td>2142</td>
                                    <td> Rado Passion </td>
                                    <td> 12/2/2017</td>
                                    <td>12/2/2017</td>
                                    <td>N/A</td>
                                    <td>451</td>
                                    <td>tt</td>
                                    <td>4561</td>
                                    <td>N/A</td>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""></label>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-info btn-view-table open-popup">View</button></td>
                                </tr>
                                <tr>
                                    <td>04 </td>
                                    <td>2142</td>
                                    <td> Rado Passion </td>
                                    <td> 12/2/2017</td>
                                    <td>12/2/2017</td>
                                    <td>N/A</td>
                                    <td>451</td>
                                    <td>tt</td>
                                    <td>4561</td>
                                    <td>N/A</td>
                                    <td>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value=""></label>
                                        </div>
                                    </td>
                                    <td><button class="btn btn-info btn-view-table open-popup">View</button></td>
                                </tr>
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

    <!--=============
        Search popuppage
        ==================-->
    <div class="popup-wrapper-view">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <div class="search-destination">
                        <h2 class="search-title">View PR Details</h2>
                    </div>
                    <!-- header got seach area -->
                    <div class="popup-got-search">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>PR ID</th>
                                    <th>Item Code</th>
                                    <th>Quantity</th>
                                    <th>Supplier</th>
                                    <th>Unit Price</th>
                                    <th>Comment</th>
                                    <th>File</th>
                                    <th>Selection</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a href="#"><i class="fa fa-download"></i></a></td>
                                    <td>
                                        <label><input type="checkbox" value=""></label>
                                    </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><a href="#"><i class="fa fa-download"></i></a></td>
                                    <td>
                                        <label><input type="checkbox" value=""></label>
                                    </td>
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