@extends('layout')
@section('content')
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
                <div class="col-sm-12 padding-left-0">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>PR ID</th>
                                <th>Item Name</th>
                                <th>Item Code</th>
                                <th>Quantity</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Unit Price</th>
                                <th>Comments</th>
                                <th>Upload Files</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($qr_inv as $qinv)
                                @foreach($qinv->items as $qrt)
                                    @if(!in_array($qrt->id, $quoted_items))
                                    <form action="{{ url('/supplier-controller/submit-qr') }}" method="post" enctype="multipart/form-data">
                                        {{csrf_field()}}
                                        <tr>
                                            <td>@foreach($qinv->qr_table as $qpr){{ $qpr->pr_id }}@endforeach<input type="hidden" name="item_id" value="{{$qrt->id}}"></td>
                                            <td>{{ $qrt->item_name}}</td>
                                            <td>{{ $qrt->item_no}}</td>
                                            <td>{{ $qrt->quantity}}</td>
                                            <td>{{ $qinv->start_date }}</td>
                                            <td>{{ $qinv->end_date }}</td>
                                            <td><input type="text" name="unit_price" class="form-control from-btn-supplier from-qr" required></td>
                                            <td><input type="text" name="comment" class="form-control from-qr from-supplier"> </td>
                                            <td>
                                                <div class="file btn btn-sm btn-primary btn-supplier">
                                                    <div class="upload-icon"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div><span>Upload</span>
                                                    <input type="file" name="attachment" class="input-upload" name="file">
                                                </div>
                                            </td>
                                            <td><button type="submit" class="btn btn-primary btn-supplier input-upload">Submit</button></td>
                                        </tr>
                                    </form>
                                    @endif
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
</div>
@endsection
