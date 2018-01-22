@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">Supplier List</h3>
                    <div class="col-sm-10 padding-left-0">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Supplier Name</th>
                                    <th>Category</th>
                                    <th>Email Address </th>
                                    <th>Contact</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($result as $res)
                                    <tr>
                                        <td id="name{{$res->id}}">{{$res->name}}</td>
                                        <td id="category{{$res->id}}">@foreach($res->info as $in){{ $in->category }}@endforeach</td>
                                        <td id="email{{$res->id}}">{{$res->email}}</td>
                                        <td id="contact{{$res->id}}">@foreach($res->info as $in){{ $in->contact }}@endforeach</td>
                                    </tr>
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