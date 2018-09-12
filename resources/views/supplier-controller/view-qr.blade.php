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
                                @foreach($qr_inv as $qinv)
                                    @foreach($qinv->items as $qrt)
                                        @if(!in_array($qrt->id, $quoted_items))
                                <tr>
                                    <td>@foreach($qinv->qr_table as $qpr){{ $qpr->pr_id }}@endforeach</td>
                                    <td>{{ $qrt->item_name}}</td>
                                    <td>{{ $qrt->item_no}}</td>
                                    <td>{{ $qrt->quantity}}</td>
                                    <td><a href="{{ asset('public/uploads/items/'.$qrt->item_file) }}" target="_blank" download><button class="btn btn-primary btn-supplier input-upload"><i class="fa fa-download"></i></button></a></td>
                                    <td>{{ date('m/d/Y',strtotime($qinv->start_date)) }}</td>
                                    <td>{{ date('m/d/Y',strtotime($qinv->end_date)) }}</td>
                                    <td><button type="button" class="btn btn-primary btn-supplier input-upload" data-toggle="modal" data-target="#prmodal{{$qrt->id}}">Add Quotation</button></td>
                                </tr>
                                        @endif
                                    @endforeach
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
                            {{ $qr_inv->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>


    <!-- place quatation -->
    @foreach($qr_inv as $qinv)
        @foreach($qinv->items as $qrt)
            @if(!in_array($qrt->id, $quoted_items))
                <form id="submit-qr" action="{{ url('/supplier-controller/submit-qr') }}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
    <div id="prmodal{{ $qrt->id }}" class="modal fade bs-example-modal-lg popup-prid-comparison" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
                                    <th>Place of part origin</th>
                                    <th>Genuine</th>
                                    <th>OEM</th>
                                    <th>Brand</th>
                                    <th>Deliver Date</th>
                                    <th>Unit Price</th>
                                    <th>Comments</th>
                                    <th>Upload File</th>
                                </tr>
                                </thead>
                                <tbody id="add-item-table-item">
                                <tr>
                                    <td><input type="text" name="origin0" class="form-control from-btn-supplier from-qr"><input type="hidden" name="item_id" value="{{$qrt->id}}"></td>
                                    <td><input type="text" name="genuine0" class="form-control from-btn-supplier from-qr"></td>
                                    <td><input type="text" name="oem0" class="form-control from-btn-supplier from-qr"></td>
                                    <td><input type="text" name="brand0" class="form-control from-btn-supplier from-qr"></td>
                                    <td><input type="text" name="delivery_date0" class="form-control from-qr from-supplier datepicker-f"></td>
                                    <td><input type="text" name="unit_price0" class="form-control from-btn-supplier from-qr" required></td>
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
                            <button type="button" class="btn btn-info btn-view-table edit-qr" id="add-item-create">Add Item</button>
                            <button type="button" class="btn btn-info btn-view-table" data-toggle="modal" data-target="#confirm">Submit</button>
                            <button type="button" class="btn btn-info btn-view-table  edit-qr">Cancel</button>
                        </div>
                    </div><!--// end header got search area -->
                </div>
            </div>
        </div>
    </div>
                </form>
            @endif
        @endforeach
    @endforeach

    <!-- submit popup -->
    <div id="confirm" class="modal fade bs-example-modal-lg popup-wrapper-delete" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
                            <button type="submit" class="btn btn-info btn-price" id="submit">Yes</button>
                            <button type="button" class="btn btn-info btn-popup close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
