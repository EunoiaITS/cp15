@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">Supplier Quotation</h3>
                    <div class="col-sm-10 padding-left-0">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>PR ID</th>
                                    <th>PR Type</th>
                                    <th>Items Name</th>
                                    <th>Item Code</th>
                                    <th>Quantity<th>
                                    @if(Auth::user()->role == 'manager' || Auth::user()->role == 'executive')<th>Unit Price</th>@endif
                                    <th>Supplier Name</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($quotations as $q)
                                    <tr>
                                        <td>@foreach($q->qr_details as $qr){{ $qr->pr_id }}@endforeach</td>
                                        <td>@foreach($q->qr_details as $qr){{ $qr->pr_type }}@endforeach</td>
                                        <td>@foreach($q->item_details as $qr){{ $qr->item_name }}@endforeach</td>
                                        <td>@foreach($q->item_details as $qr){{ $qr->item_no }}@endforeach</td>
                                        <td>@foreach($q->item_details as $qr){{ $qr->quantity }}@endforeach</td>
                                        <td></td>
                                        @if(Auth::user()->role == 'manager' || Auth::user()->role == 'executive')<td>@if(Auth::user()->role == $q->show_price || Auth::user()->role == $q->show_price_e){{ $q->unit_price }}@endif</td>@endif
                                        <td>{{ $q->supplier_details->name }}</td>
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