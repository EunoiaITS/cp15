@extends('layout')
@section('content')
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <div class="col-sm-10 padding-left-0">
                        <div class="create-qr qr-overfollow">
                            <h3 class="text-uppercase color-bbc">Excel Upload</h3>
                            <style>
                                table,tr,td{
                                    border:1px solid black;
                                }
                            </style>
                            <table>
                                <tr>
                                    <td>Name</td>
                                    <td>Email</td>
                                    <td>Category</td>
                                    <td>Contact</td>
                                    <td>Password</td>

                                </tr>
                                <tr>
                                    <td><?php echo $results[0][0]['name'];?></td>
                                    <td><?php echo $results[0][0]['email'];?></td>
                                    <td><?php echo $results[0][0]['category'];?></td>
                                    <td><?php echo $results[0][0]['contact'];?></td>
                                    <td><?php echo $results[0][0]['password'];?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection