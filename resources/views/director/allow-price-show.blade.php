@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">Price View Approval</h3>
                    <div class="col-sm-10 padding-left-0">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>PR ID</th>
                                    <th>Manager</th>
                                    <th>Excutive</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td> </td>
                                    <td><label><input type="checkbox" value=""></label></td>
                                    <td><label><input type="checkbox" value=""></label></td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td><label><input type="checkbox" value=""></label></td>
                                    <td><label><input type="checkbox" value=""></label></td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td><label><input type="checkbox" value=""></label></td>
                                    <td><label><input type="checkbox" value=""></label></td>
                                </tr>
                                <tr>
                                    <td> </td>
                                    <td><label><input type="checkbox" value=""></label></td>
                                    <td><label><input type="checkbox" value=""></label></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="btn-button-group clearfix">
                            <button class="btn btn-info btn-price">Approve</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection