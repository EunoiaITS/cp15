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
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>01 </td>
                                    <td class="prid-popup-button">PR2142</td>
                                    <td> Rado Passion </td>
                                    <td> 12/2/2017</td>
                                    <td>12/2/2017</td>
                                </tr>
                                <tr>
                                    <td>02 </td>
                                    <td class="prid-popup-button">PR2142</td>
                                    <td> Rado Passion </td>
                                    <td> 12/2/2017</td>
                                    <td>12/2/2017</td>
                                </tr>
                                <tr>
                                    <td>03 </td>
                                    <td class="prid-popup-button">PR2142</td>
                                    <td> Rado Passion </td>
                                    <td> 12/2/2017</td>
                                    <td>12/2/2017</td>
                                </tr>
                                <tr>
                                    <td>04 </td>
                                    <td class="prid-popup-button">PR2142</td>
                                    <td> Rado Passion </td>
                                    <td> 12/2/2017</td>
                                    <td>12/2/2017</td>
                                </tr>
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
    <div class="popup-prid-comparison">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <div class="search-destination">
                        <h2 class="pr-title"><span class="pr-id">PR ID:</span><span class="prtext">PR1234</span></h2>
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
                                <tr>
                                    <td>1 </td>
                                    <td>722068</td>
                                    <td>Bearing 84284106</td>
                                    <td>4</td>
                                    <td>300</td>
                                    <td>ABC</td>
                                    <td></td>
                                    <td><a href="#">View</a></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                <tr>
                                    <td>2 </td>
                                    <td>722068</td>
                                    <td>Bearing 84284106</td>
                                    <td>4</td>
                                    <td>300</td>
                                    <td>DEF</td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                <tr>
                                    <td>3 </td>
                                    <td>722068</td>
                                    <td>Bearing 84284106</td>
                                    <td>4</td>
                                    <td>100</td>
                                    <td>XYZ</td>
                                    <td></td>
                                    <td><a href="#">View</a></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>722068</td>
                                    <td>84284106 NUT</td>
                                    <td>2</td>
                                    <td>1000</td>
                                    <td>ABC</td>
                                    <td></td>
                                    <td><a href="#">View</a></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>722068</td>
                                    <td>84284106 NUT</td>
                                    <td>2</td>
                                    <td>1000</td>
                                    <td>DEF</td>
                                    <td></td>
                                    <td><a href="#">View</a></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>722068</td>
                                    <td>84284106 NUT</td>
                                    <td>2</td>
                                    <td>200</td>
                                    <td>XYZ</td>
                                    <td></td>
                                    <td><a href="#">View</a></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>7228441</td>
                                    <td>SEAL 5133799</td>
                                    <td>2</td>
                                    <td>800</td>
                                    <td>ABC</td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>7228441</td>
                                    <td>SEAL 5133799 (62X42X17)</td>
                                    <td>2</td>
                                    <td>450</td>
                                    <td>DEF</td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>7228441</td>
                                    <td>SEAL 5133799 (62X42X17)</td>
                                    <td>2</td>
                                    <td>450</td>
                                    <td>XYZ</td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td><input type="checkbox" name="checkboxicon"></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><!--// end header got search area -->
                    <div class="btn-button-group clearfix">
                        <button class="btn btn-info btn-price open-popup-comparison">Price Comparison</button>
                        <button class="btn btn-info btn-price close approve">Approve</button>
                    </div>
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
                <i class="close-comp fa fa-remove"></i>
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
                    <button class="btn btn-info btn-popup close-comp">Close</button>
                </div>
            </div>
        </div>
    </div><!-- Popup -->
@endsection