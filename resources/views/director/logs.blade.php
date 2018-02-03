@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">Log</h3>
                    <div class="col-sm-10 padding-left-0">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>PR ID</th>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Supplier</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>{{ $log->details->pr_id }}</td>
                                        <td>{{ date('d/m/Y', strtotime($log->details->created_at)) }}</td>
                                        <td>{{ date('G:i:s A', strtotime($log->details->created_at)) }}</td>
                                        <td>{{ $log->name }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="float-right">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item @if($current == 1){{ 'disabled' }}@endif"><a class="page-link" href="?page=1"><i class="fa fa-angle-left"></i></a></li>
                                    @for($i = 1; $i <= $page; $i++)
                                        <li class="page-item @if($current == $i){{ 'active' }}@endif"><a class="page-link" href="?page={{ $i }}">{{ $i }}</a></li>
                                        @endfor
                                    <li class="page-item @if($current == $page){{ 'disabled' }}@endif"><a class="page-link" href="?page={{ $page }}"><i class="fa fa-angle-right"></i></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection