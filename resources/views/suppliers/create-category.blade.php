@extends('layout')
@section('content')
<div class="bbc-content-area mcw">
    <div class="container">
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <h3 class="text-uppercase color-bbc">Create Category</h3>
                <div class="col-sm-10 padding-left-0">
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
                </div>
                <form action="{{ url('suppliers/create-category/add') }}" method="post">
                    {{ csrf_field() }}
                    <div class="category-create-item clearfix">
                        <input type="text" name="category" placeholder="Type Category Name Here" class="form-control from-qr-create" id="category-auto-suggetion">
                        <button type="submit" class="btn btn-info btn-price-category">Create</button>
                    </div>
                </form>

                <div class="col-sm-10 padding-left-0">
                    <div class="table table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $c = 0 @endphp
                            @foreach($categories as $cat)
                                @php $c ++ @endphp
                                <tr>
                                    <td>{{ $c }}</td>
                                    <td id="category{{ $cat->id }}" class="cat" rel="{{$cat->id}}">{{ $cat->category }}</td>
                                    <td><button rel="{{ $cat->id }}" id="edit{{ $cat->id }}" class="btn btn-info btn-view-table edit-button open-popup-comp float-inherit">Edit</button></td>
                                    <td><button rel="{{ $cat->id }}" id="delete{{ $cat->id }}"class="btn btn-info btn-view-table delete-button float-inherit open-popup-delete popup-left">Delete</button>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- pagination -->
                <div class="col-sm-11">
                    <div class="float-pagination">
                        <nav aria-label="Page navigation example">
                            {{ $categories->links() }}
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>


<!--=============
View Qr Order Popup:manager
==================-->
<div class="popup-wrapper-compa">
    <div class="popup-base">
        <div class="search-popup">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <div class="search-destination">
                    <h2 class="search-title">Edit Category</h2>
                </div>
                <!-- header got seach area -->
                <div class="popup-got-search">
                    <form action="{{ url('suppliers/create-category/edit') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group clearfix">
                            <label for="pr-type" class="label-d">Category<span class="fright">:</span></label>
                            <input type="text" name="category" class="form-control from-qr" id="e-category">
                        </div>
                        <input type="hidden" name="cat_id" id="e-cat">
                        <div class="col-sm-12">
                            <div class="btn-button-group btn-button-group-opitonal clearfix">
                                <button type="submit" class="btn btn-info btn-price e-dis">OK</button>
                                <button type="button" class="btn btn-info btn-popup close">Cancel</button>
                            </div>
                        </div>
                    </form>
                </div><!--// end header got search area -->
            </div>
        </div>
    </div>
</div><!-- Popup -->

<!--
delete popup
========================-->
<div class="popup-wrapper-delete">
    <div class="popup-base">
        <div class="search-popup">
            <i class="close fa fa-remove"></i>
            <div class="row">
                <div class="search-destination">
                    <h2 class="search-title">Confirmation Delete</h2>
                </div>
                <div class="popup-got-search">
                    <p>Do you really want to delete ?</p>
                </div>
                <form action="{{url('suppliers/create-category/delete')}}" method="post">
                    {{ csrf_field() }}
                <input type="hidden" name="cat_id" id="d-cat" value="">
                    <div class="col-sm-12">
                        <div class="btn-button-group clearfix">
                            <button type="submit" class="btn btn-info btn-price d-dis">Yes</button>
                            <button type="button" class="btn btn-info btn-popup close">No</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div><!-- Popup -->
@endsection