@extends('layout')
@section('content')
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="col-sm-10 padding-left-0">
                        <div class="create-qr qr-overfollow">
                            <h3 class="text-uppercase color-bbc">Excel Upload</h3>
                            <table>
                                <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Category</td>
                                    <td>Contact</td>
                                </tr>
                                <?php echo "<pre>"; print_r($results);echo "</pre>";?>

                                 <tr>
                                     <td></td>
                                     <td>Email</td>
                                     <td></td>
                                     <td>Contact</td>
                                    <tr>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection