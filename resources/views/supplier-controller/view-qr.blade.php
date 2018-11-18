@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">QR Order</h3>
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <p class="alert alert-danger">
                                {{ $error }}
                            </p>
                        @endforeach
                    @endif
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
                                    <th>PR ID</th>
                                    <th>Item Name</th>
                                    <th>Item Code</th>
                                    <th>Quantity</th>
                                    <th>File (BBC)</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Place Quotation</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($items as $item)
                                    @if(isset($item->check))
                                        @if($item->check == 'yes')
                                            <tr>
                                                <td>{{ $item->qr->pr_id }}</td>
                                                <td>{{ $item->item_name}}</td>
                                                <td>{{ $item->item_no}}</td>
                                                <td>{{ $item->quantity}}</td>
                                                <td>@if($item->item_file != '')<a href="{{ asset('public/uploads/items/'.$item->item_file) }}" target="_blank" download><button class="btn btn-primary btn-supplier input-upload"><i class="fa fa-download"></i></button></a>@endif</td>
                                                <td>@if(isset($item->details->start_date)){{ date('d/m/Y',strtotime($item->details->start_date)) }}@endif</td>
                                                <td>@if(isset($item->details->end_date)){{ date('d/m/Y',strtotime($item->details->end_date)) }}@endif</td>
                                                <td><button type="button" class="btn btn-primary btn-supplier input-upload" data-toggle="modal" data-target="#prmodal{{$item->id}}" rel="{{ $item->id }}">Add Quotation</button></td>
                                            </tr>
                                            @endif
                                        @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- pagination -->
                <div class="col-sm-10">
                    <div class="float-pagination">
                        <nav aria-label="Page navigation example">
                            {{ $items->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- place quatation -->
    @foreach($items as $item)
                <form id="submit-qr{{ $item->id }}" action="{{ url('/supplier-controller/submit-qr/') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div id="prmodal{{ $item->id }}" class="modal fade bs-example-modal-lg popup-prid-comparison" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                        <div class="popup-base">
                            <div class="search-popup">
                                <i class="close fa fa-remove close" data-dismiss="modal" aria-label="Close"></i>
                                <div class="row">
                                    <div class="search-destination">
                                        <h2 class="search-title">Place Quatation</h2>
                                    </div>
                                    <!-- header got seach area -->
                                    <div class="popup-got-search">
                                        <div class="table table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>Origin</th>
                                                    <th>Genuine</th>
                                                    <th>OEM</th>
                                                    <th>Brand</th>
                                                    <th>Deliver Date</th>
                                                    <th>Unit Price (including tax)(RM)</th>
                                                    <th>Comments</th>
                                                    <th>Upload File</th>
                                                </tr>
                                                </thead>
                                                <tbody id="add-item-table-item{{ $item->id }}">
                                                <tr>
                                                    <td><input type="text" name="origin0" class="form-control from-btn-supplier from-qr"><input type="hidden" name="item_id0" value="{{$item->id}}"></td>
                                                    <td><input type="text" name="genuine0" class="form-control from-btn-supplier from-qr"></td>
                                                    <td><input type="text" name="oem0" class="form-control from-btn-supplier from-qr"></td>
                                                    <td><input type="text" name="brand0" class="form-control from-btn-supplier from-qr"></td>
                                                    <td><input type="text" name="delivery_date0" class="form-control from-qr from-supplier datepicker-f"></td>
                                                    <td><input type="number" placeholder="0.0" name="unit_price0" class="form-control from-btn-supplier from-qr unit-price" data-toggle="tooltip" data-placement="bottom" title="Please insert numeric values only (Eg: 5 or 7.5)" required></td>
                                                    <td><input type="text" name="comment0" class="form-control from-qr from-supplier"><input id="total" type="hidden" name="count" value="0"></td>
                                                    <td>
                                                        <div class="file btn btn-sm btn-primary btn-supplier">
                                                            <div class="upload-icon"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div><span>Upload</span>
                                                            <input type="file" name="attachment0" class="input-upload">
                                                        </div>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="place-quatation-submit">
                                            <button type="button" class="btn btn-info btn-view-table edit-qr add-item-create" rel="{{ $item->id }}">Add Item</button>
                                            <button type="button" class="btn btn-info btn-view-table confirm" data-toggle="modal" data-target="#confirm{{ $item->id }}" rel="{{ $item->id }}">Submit</button>
                                            <button type="button" class="btn btn-info btn-view-table  edit-qr">Cancel</button>
                                        </div>
                                    </div><!--// end header got search area -->
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    @endforeach

    @foreach($items as $item)
    <!-- submit popup -->
    <div id="confirm{{ $item->id }}" class="modal fade bs-example-modal-lg popup-wrapper-delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <!-- header got seach area -->
                    <div class="popup-got-search">
                        <p>Are you sure you want to submit ?</p>
                    </div><!--// end header got search area -->
                        <div class="col-sm-12">
                            <div class="btn-button-group clearfix">
                                <button type="submit" class="btn btn-info btn-price" form="submit-qr{{ $item->id }}">Yes</button>
                                <button type="button" class="btn btn-info btn-popup close">No</button>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

@endsection
