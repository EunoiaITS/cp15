@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">Supplier List</h3>
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
                    <!-- fliter button: new added -->
                     <div class="supplier-filter-option">
                        <select class="selectfilter" title="Filter">
                            <option class="asc" value="ascending">Ascending A-Z</option>
                            <option class="desc" value="descending">Descending Z-A</option>
                        </select>
                    </div>
                    <div class="col-sm-10 padding-left-0">
                        <div class="table table-responsive">
                            <table class="table sort-table" id="sort-table">
                                <thead>
                                <tr>
                                    <th>Serial No</th>
                                    <th>Supplier Name</th>
                                    <th>Category</th>
                                    <th>Email Address </th>
                                    <th>Contact</th>
                                </tr>
                                </thead>
                                <tbody id="filtered-data">
                                <?php $j=1;?>
                                    @foreach($result as $res)
                                    <tr>
                                        <td>{{$j++}}</td>
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
                <!-- pagination -->
                <div class="col-sm-10">
                    <div class="float-pagination">
                        <nav aria-label="Page navigation example">
                            {{ $result->appends([ 'order' => $cur_order ])->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
