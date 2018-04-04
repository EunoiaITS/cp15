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
                </div>
            </div>
        </div>
    </div>
    @endsection
