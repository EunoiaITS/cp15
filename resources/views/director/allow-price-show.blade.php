@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <form action="{{ url('/allow-price-show') }}" method="post">
                    {{csrf_field()}}
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">Price View Approval</h3>
                    @if(session()->has('success-message'))
                        <p class="alert alert-success">
                            {{ session()->get('success-message') }}
                        </p>
                    @endif
                    <div class="col-sm-10 padding-left-0">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>PR ID</th>
                                    <th>Manager</th>
                                    <th>Executive</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($quotations as $pr)
                                    <tr>
                                        <td>{{ $pr->pr_id }}</td>
                                        <td><label><input name="manager{{ $pr->id }}" type="checkbox" value="manager" @if($pr->show_price_m == 'manager'){{ 'checked' }}@endif></label></td>
                                        <td><label><input name="executive{{ $pr->id }}" type="checkbox" value="executive" @if($pr->show_price_e == 'executive'){{ 'checked' }}@endif></label></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="btn-button-group clearfix">
                            <button type="submit" class="btn btn-info btn-price">Approve</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection