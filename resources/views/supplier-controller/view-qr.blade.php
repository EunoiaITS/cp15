@extends('layout')
@section('content')
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <h3 class="text-uppercase color-bbc">QR Order</h3>
                <div class="col-sm-11 padding-left-0">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>PR ID</th>
                                <th>Item Code</th>
                                <th>Quantity</th>
                                <th>Unit Price</th>
                                <th>Comments</th>
                                <th>Upload Files</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>25864868 </td>
                                <td>345</td>
                                <td></td>
                                <td> <input type="text" class="form-control from-btn-supplier from-qr"> </td>
                                <td><input type="text" class="form-control from-qr from-supplier"> </td>
                                <td>
                                    <div class="file btn btn-sm btn-primary btn-supplier">
                                        <div class="upload-icon"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div><span>Upload</span>
                                        <input type="file" class="input-upload" name="file">
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>25864868 </td>
                                <td>345</td>
                                <td></td>
                                <td> <input type="text" class="form-control from-qr from-btn-supplier"> </td>
                                <td><input type="text" class="form-control from-qr from-supplier"> </td>
                                <td>
                                    <div class="file btn btn-sm btn-primary btn-supplier">
                                        <div class="upload-icon"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div><span>Upload</span>
                                        <input type="file" class="input-upload" name="file">
                                    </div>
                                </td>
                            </tr>
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