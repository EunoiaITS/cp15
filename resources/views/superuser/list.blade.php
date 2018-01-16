@extends('layout')
@section('content')
    <!-- content area-->
    <div class="bbc-content-area mcw">
        <div class="container">
            <div class="row">
                <div class="col-sm-11 col-sm-offset-1">
                    <h3 class="text-uppercase color-bbc">View Users List</h3>
                    <div class="col-sm-10 padding-left-0">
                        <div class="table table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>User Name</th>
                                    <th>Role</th>
                                    <th>Email Address</th>
                                    <th>Password</th>
                                    <th>Edit/Delete</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td id="name{{ $user->id }}">{{ $user->name }}</td>
                                    <td id="role{{ $user->id }}">{{ $user->role }}</td>
                                    <td id="email{{ $user->id }}">{{ $user->email }}</td>
                                    <td id="password{{ $user->id }}">{{ $user->password }}</td>
                                    <td><button rel="{{ $user->id }}" id="edit{{ $user->id }}" class="btn btn-info btn-view-table open-popup popup-left">Edit</button>
                                        <button rel="{{ $user->id }}" id="delete{{ $user->id }}" class="btn btn-info btn-view-table open-popup-delete">Delete</button></td>
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

    <!--=============
        edit qr popup
        ==================-->
    <div class="popup-wrapper-view">
        <div class="popup-base">
            <div class="search-popup">
                <i class="close fa fa-remove"></i>
                <div class="row">
                    <div class="search-destination">
                        <h2 class="search-title">Edit User</h2>
                    </div>
                    <!-- header got seach area -->
                    <div class="popup-got-search">
                        <form method="post" action="{{ url('superuser/users-edit') }}">
                            {{ csrf_field() }}
                            <div class="form-group clearfix">
                                <label for="supplier-name" class="label-d">User Name <span class="fright">:</span></label>
                                <input name="name" type="text" class="form-control from-qr" id="supplier-name">
                            </div>
                            <div class="form-group clearfix">
                                <label for="catagory-catagory" class="label-d">Role <span class="fright">:</span></label>
                                <select name="role" type="text" class="form-control from-qr" id="catagory-catagory">
                                    @foreach($roles as $role)
                                        <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                </select>
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-email" class="label-d">Email Address <span class="fright">:</span></label>
                                <input name="email" type="email" class="form-control from-qr" id="pr-email">
                            </div>
                            <div class="form-group clearfix">
                                <label for="pr-contact" class="label-d">Password <span class="fright">:</span></label>
                                <input name="password" type="password" class="form-control from-qr" id="pr-contact">
                            </div>
                            <input type="hidden" name="user_id" id="user_id">
                            <div class="col-sm-12">
                                <div class="btn-button-group clearfix">
                                    <button class="btn btn-info btn-price open-popup-comp">Save</button>
                                    <button class="btn btn-info btn-popup close">Cancel</button>
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
                        <h2 class="search-title">Delete Supplier</h2>
                    </div>
                    <!-- header got seach area -->
                    <div class="popup-got-search">
                        <p>Confirm to delete the Supplier from the view Supplier list ?</p>
                    </div><!--// end header got search area -->
                    <div class="col-sm-12">
                        <div class="btn-button-group clearfix">
                            <button class="btn btn-info btn-price open-popup-comp">Delete</button>
                            <button class="btn btn-info btn-popup close">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Popup -->
    @endsection