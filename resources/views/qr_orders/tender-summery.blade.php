@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">Tender Summary</h3>
                    <div class="col-sm-11 padding-left-0">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>PR ID</th>
                                    <th>PR Type</th>
                                    <th>QR ID</th>
                                    <th>Items Name</th>
                                    <th>Item Code</th>
                                    <th>Quantity<th>
                                    @if(Auth::user()->role == 'director' || Auth::user()->role == 'manager' || Auth::user()->role == 'executive')
                                        <th>Unit Price</th>
                                    @endif
                                    <th>Supplier Name</th>
                                    @if(Auth::user()->role == 'director')
                                        <th>Download</th>
                                        @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($qrs as $qr)
                                    <tr>
                                        <td>@foreach($qr->qr_details as $q){{$q->pr_id}}@endforeach</td>
                                        <td>@foreach($qr->qr_details as $q){{$q->pr_type}}@endforeach</td>
                                        <td>@if($qr->supplier_details->qr_id != null){{$qr->supplier_details->qr_id}}@endif</td>
                                        <td>@foreach($qr->items as $item){{ $item->item_name }}@endforeach</td>
                                        <td>@foreach($qr->items as $item){{ $item->item_no }}@endforeach</td>
                                        <td>@foreach($qr->items as $item){{ $item->quantity }}@endforeach</td>
                                        <td></td>
                                        @if(Auth::user()->role == 'director')
                                        <td>{{ $qr->unit_price }}</td>
                                            @elseif(Auth::user()->role == 'manager' || Auth::user()->role == 'executive')
                                            <td>@if(Auth::user()->role == $qr->show_price || Auth::user()->role == $qr->show_price_e){{ $qr->unit_price }}@endif</td>
                                        @endif
                                        <td>{{ $qr->supplier->name }}</td>
                                        @if(Auth::user()->role == 'director')
                                            <td><a href="#"><i class="fa fa-download"></i></a></td>
                                        @endif
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                     <!-- pagination -->
                        <div class="col-sm-11">
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
        <div class="popup-tender-summary">
            <div class="popup-base">
                <div class="search-popup">
                    <i class="close fa fa-remove"></i>
                    <div class="row">
                        <div class="search-destination">
                            <h2 class="pr-title"><span class="pr-id">PR ID:</span><span class="prtext">PR18001981</span></h2>
                        </div>
                        <!-- header got seach area -->
                        <div class="popup-got-search popup-pie clearfix">
                           <div class="table table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>QR ID</th>
                                            <th>Item Code</th>
                                            <th>Items Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Supplier Name</th>
                                            <th>File</th>
                                        </tr>
                                    </thead>                  
                                     <tbody>
                                        <tr>
                                            <td>1 </td>
                                            <td>QR000000001</td>
                                            <td>540364</td>
                                            <td>DRIVE SOCKET SET 3/8 INCH (35PICS)</td>
                                            <td>2</td>
                                            <td>98</td>
                                            <td>BCD</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                         <tr>
                                           <td>2 </td>
                                            <td>QR000000001</td>
                                            <td>540366</td>
                                            <td>SCREWDRIVER (-) 10 X 200MM</td>
                                            <td>3</td>
                                            <td>78</td>
                                            <td>BCD</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                           <td>3</td>
                                            <td>QR000000001</td>
                                            <td>540367</td>
                                            <td>DRIVE SOCKET SET 3/8 INCH (35PICS)</td>
                                            <td>2</td>
                                            <td>78</td>
                                            <td>BCD</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>4 </td>
                                            <td>QR000000001</td>
                                            <td>540368</td>
                                            <td>DRIVE SOCKET SET 3/8 INCH (35PICS)</td>
                                            <td>2</td>
                                            <td>45</td>
                                            <td>BCD</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                         <tr>
                                            <td>5 </td>
                                            <td>QR000000001</td>
                                            <td>797878</td>
                                            <td>AXLE CONE</td>
                                            <td>4</td>
                                            <td>432</td>
                                            <td>BCD</td>
                                            <td></td>
                                        </tr>
                                         <tr>
                                            <td>6</td>
                                            <td>QR000000002</td>
                                            <td>540365</td>
                                            <td>SCREWDRIVER (+) 3 X 150MM</td>
                                            <td>3</td>
                                            <td>22</td>
                                            <td>CDE</td>
                                            <td></td>
                                        </tr>
                                         <tr>
                                            <td>7</td>
                                            <td>QR000000002</td>
                                            <td>480020</td>
                                            <td>TYPE LEVER 760MM</td>
                                            <td>2</td>
                                            <td>66</td>
                                            <td>CDE</td>
                                            <td><a href="#">View</a></td>
                                        </tr>
                                        <tr>
                                           <td>8</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                           <td>9</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
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
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!--// end header got search area -->
                    </div>
                </div>
            </div>
        </div><!-- Popup -->
        
    @endsection
