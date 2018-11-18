@extends('layout')
@section('content')
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="col-sm-10 padding-left-0">
                        <div class="create-qr qr-overfollow">
                            <h3 class="text-uppercase color-bbc">Suppliers List Upload</h3>
                            @include('includes.messages')
                            <form action="{{url('/suppliers/import-data')}}" method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="file btn btn-sm btn-primary">
                                    <div class="upload-icon"><i class="fa fa-cloud-upload" aria-hidden="true"></i></div><span>Upload excel</span>
                                    <input type="file" class="input-upload" name="file" required>
                                </div>
                                <button class="btn btn-info btn-view-submit" type="submit" value="upload">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
