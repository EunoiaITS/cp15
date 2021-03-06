@extends('layout')
@section('content')
<!-- content area-->
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <div class="col-sm-10 padding-left-0">
                    <div class="create-qr qr-overfollow">
                        <h3 class="text-uppercase color-bbc">Create QR Order</h3>
                        @include('includes.messages')
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <p class="alert alert-danger">
                                    {{ $error }}
                                </p>
                            @endforeach
                        @endif
                        <form action="{{ url('/qr-orders/add-qr-order') }}" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                            <div class="form-group clearfix">
                                <label for="pr-id" class="label-d">PR ID <span class="fright">:</span></label>
                                <input type="text" name="pr_id" class="form-control from-qr" id="pr-id" required>
                                @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('pr_id') }}</p>@endif
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-type" class="label-d">PR Type <span class="fright">:</span></label>
                                <input type="text" name="pr_type" class="form-control from-qr" id="pr-type" required>
                                @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('pr_type') }}</p>@endif
                            </div>
                            <div class="form-group live-search">
                                <label for="pr-catagory" class="label-d">Category <span class="fright">:</span></label>
                                <select data-live-search="true" name="category" class="selectpicker category" id="pr-catagory" required>
                                    @foreach($cat as $c)
                                        <option value="{{$c->id}}">{{$c->category}}</option>
                                    @endforeach
                                </select>
                                @if($errors->any())<p class="text-muted small text-danger">{{ $errors->first('category') }}</p>@endif
                            </div>
                            <input type="hidden" name="status" value="requested">
                            <div id="add-item-table" class="col-sm-10 table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Items Name</th>
                                        <th>Items Code</th>
                                        <th>Quantity</th>
                                        <th>Upload File</th>
                                        <th>Remove</th>
                                    </tr>
                                    </thead>
                                    <tbody id="add-item-table-item">
                                    <tr>
                                        <td>1</td>
                                        <td><input name="item_name1" type="text" class="form-control from-qr" id="pr-item-name" name="prItem" required></td>
                                        <td><input name="item_no1" type="text" class="form-control from-qr" id="pr-item-code" name="prItemcode" required></td>
                                        <td><input name="quantity1" type="text" class="form-control from-qr" id="pr-quantity" name="prQuantity" required></td>
                                        <td>
                                            <div class="file btn btn-sm btn-primary btn-supplier">
                                                <div class="upload-icon"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div><span>Upload</span>
                                                <input type="file" name="item_file1" class="input-upload" id="file1" onchange="uploadFile()">
                                            </div>
                                        </td>
                                        <td><button type="button" class="btn btn-primary"><i class="fa fa-times"></i></button></td>
                                        <input type="hidden" name="count" value="1">
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="button" id="add-item-create" class="btn btn-info btn-price add-item-qe">Add Item</button>

                            <div class="col-sm-12">
                                <div class="btn-button-group clearfix">
                                    <button type="submit" class="btn btn-info btn-price">Create</button>
                                    <button type="button" onclick="location.reload()" class="btn btn-info btn-popup close">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    @endsection