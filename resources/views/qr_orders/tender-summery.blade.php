@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">Tender Summary</h3>
                    <div class="col-sm-10 padding-left-0">
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
                                    <th>Supplier Name</th>
                                    @if(Auth::user()->role == 'director')
                                        <th>Download</th>
                                        @endif
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($qrs as $qr)
                                    @foreach($qr->items as $item)
                                        <tr>
                                            <td>{{ $qr->pr_id }}</td>
                                            <td>{{ $qr->pr_type }}</td>
                                            <td>{{ $qr->category }}</td>
                                            <td>{{ $item->item_name }}</td>
                                            <td>{{ $item->item_no }}</td>
                                            <td>{{ $item->quantity }}</td>
                                            <td></td>
                                            <td>N/A</td>
                                            @if(Auth::user()->role == 'director')
                                                <td><a href="#"><i class="fa fa-download"></i></a></td>
                                            @endif
                                        </tr>
                                        @endforeach
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