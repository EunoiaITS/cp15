@extends('layout')
@section('content')
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="col-sm-10 padding-left-0">
                        <div class="create-qr qr-overfollow">
                            <h3 class="text-uppercase color-bbc">Quotation Requisition Upload</h3>
                            @if(session()->has('success-message'))
                                <p class="alert alert-success">
                                    {{ session()->get('success-message') }}
                                </p>
                            @endif
                            <form action="{{url('/qr-orders/import-data')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <label>Upload File</label>
                                <input type="file" name="file" required><br/>
                                <input type="submit" value="upload">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection