@extends('layout')
@section('content')
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <form method="post" action="{{ url('suppliers/invite-suppliers/') }}">
                {{csrf_field()}}
            <div class="col-sm-11 col-sm-offset-1">
                <h3 class="text-uppercase color-bbc">Invite Suppliers</h3>
                @if(session()->has('error'))
                    <p class="alert alert-success">
                        {{ session()->get('error') }}
                    </p>
                @endif
                @if(session()->has('success-message'))
                    <p class="alert alert-success">
                        {{ session()->get('success-message') }}
                    </p>
                @endif
                @if($errors->any())
                    @foreach($errors->all() as $error)
                        <p class="alert alert-danger">
                            {{ $error }}
                        </p>
                    @endforeach
                @endif

                <div class="col-sm-10 padding-left-0">
                    <div class="table table-responsive">

                        <table class="table">
                            <thead>
                            <tr>
                                <th>PR ID</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Selection</th>
                                <th>Select Supplier</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($invite as $inv)
                            <tr>
                                <td><input type="text" name="qr_id" value="{{ $inv->pr_id }}" readonly></td>
                                <td><input type="text" name="start_date" class="form-control from-qr datepicker-f"></td>
                                <td><input type="text" name="end_date" class="form-control from-qr datepicker-f"></td>
                                <td><label><input rel="#supplier-id" name="suppliers" type="checkbox" value=""></label></td>
                                <td><button name="main" class="btn btn-info btn-view-table open-popup">Supplier</button></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="btn-button-group clearfix">
                        <button class="btn btn-info btn-price">Send to Supplier</button>
                    </div>
                </div>
            </div>
            </form>
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
                    <h2 class="search-title">Select Suppliers</h2>
                </div>
                <!-- header got search area -->
                <div class="popup-got-search">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>List Of Suppliers</th>
                                <th>Select</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $sup)
                            <tr>
                                <td>{{ $sup->name }}</td>
                                <td><label><span class="hidden" id="supplier-id"></span><input rel="" id="supplier-id" type="checkbox" name="suppliers[]" value="{{$sup->id}}"></label></td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <button name="modal" class="btn btn-info btn-popup close">Confirm</button>
                </div><!--// end header got search area -->
            </div>
        </div>
    </div>
</div><!-- Popup -->
@endsection