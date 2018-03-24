@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">Supplier List</h3>
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
                                    <th>Supplier Name</th>
                                    <th>Category</th>
                                    <th>Email Address </th>
                                    <th>Contact</th>
                                </tr>
                                </thead>
                                <tbody id="filtered-data">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- pagination -->
                <div class="col-sm-10">
                    <div class="float-pagination">
                        <nav aria-label="Page navigation example">
                          <ul class="p-asc">
                              {{ $asc_result -> links() }}
                          </ul>
                          <ul class="p-desc">
                              {{ $desc_result -> links() }}
                          </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
