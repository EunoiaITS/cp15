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
                            @foreach($qrs as $qr)
                            <tr>
                                <td>{{ $qr->pr_id }}</td>
                                <td><input type="text" name="start_date{{ $qr->id }}" class="form-control from-qr datepicker-f" @if($qr->invite != null){{ 'value="'.$qr->invite->start_date.'" readonly' }}@endif></td>
                                <td><input type="text" name="end_date{{ $qr->id }}" class="form-control from-qr datepicker-f" @if($qr->invite != null){{ 'value="'.$qr->invite->end_date.'" readonly' }}@endif></td>
                                <td><label><input name="suppliers{{ $qr->id }}" type="checkbox" value="{{ $qr->id }}"></label></td>
                                <td><button rel="{{ $qr->id }}" type="button" class="btn btn-info btn-view-table open-popup select-suppliers">Supplier</button></td>
                                <input type="hidden" id="selected-suppliers{{ $qr->id }}" name="selected-suppliers{{ $qr->id }}" value="">
                            </tr>
                            @if($qr->invite != null)<input type="hidden" name="action{{ $qr->id }}" value="edit">@endif
                            <span id="sup{{ $qr->id }}" class="hidden">@if($qr->invite != null){{ $qr->invite->suppliers }}@endif</span>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-sm-10">
                    <div class="btn-button-group clearfix">
                        <button type="submit" class="btn btn-info btn-price">Send to Supplier</button>
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
                            <tbody id="supplier-list">
                            </tbody>
                            @foreach($suppliers as $sup)
                                <span id="sup-id-{{ $sup->id }}" class="hidden">{{ $sup->id }}</span>
                                <span id="sup-name-{{ $sup->id }}" class="hidden">{{ $sup->name }}</span>
                            @endforeach
                        </table>
                    </div>
                    <button id="confirm-select" name="modal" class="btn btn-info btn-popup close">Confirm</button>
                </div><!--// end header got search area -->
            </div>
        </div>
    </div>
</div><!-- Popup -->
@endsection