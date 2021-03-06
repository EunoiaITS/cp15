@extends('layoutLogin')
@section('content')
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-1 col-md-10 col-sm-12">
                    <div class="login-form dashboard-cs clearfix">
                        <h3>Dashboard</h3>
                        <div class="submenu-das clearfix">
                            <a href="@if(Auth::user()->role == 'super_userController'){{ url('superuser/users-list') }}@else{{ url('/tender-summery') }}@endif" class="btn btn-info btn-left odd">BBC Estate VII Sdn Bhd</a>
                            <a href="@if(Auth::user()->role == 'super_userController'){{ url('superuser/users-list') }}@else{{ url('/tender-summery') }}@endif" class="btn btn-info btn-left">BBC Pelita (Nyalau) Plantation Sdn Bhd</a>
                            <a href="@if(Auth::user()->role == 'super_userController'){{ url('superuser/users-list') }}@else{{ url('/tender-summery') }}@endif" class="btn btn-info btn-left odd">Almabumi (BUKIT) Plantation Sdn Bhd</a>
                            <a href="@if(Auth::user()->role == 'super_userController'){{ url('superuser/users-list') }}@else{{ url('/tender-summery') }}@endif" class="btn btn-info btn-left">Bumihas Sdn Bhd</a>
                            <a href="@if(Auth::user()->role == 'super_userController'){{ url('superuser/users-list') }}@else{{ url('/tender-summery') }}@endif" class="btn btn-info btn-left odd">Almabumi (SUNGAI) Plantation Sdn Bhd</a>
                            <a href="@if(Auth::user()->role == 'super_userController'){{ url('superuser/users-list') }}@else{{ url('/tender-summery') }}@endif" class="btn btn-info btn-left">BBC Palm Oil Mill Sdn Bhd</a>
                            <a href="@if(Auth::user()->role == 'super_userController'){{ url('superuser/users-list') }}@else{{ url('/tender-summery') }}@endif" class="btn btn-info btn-left odd">BBC Pelita Plantation (Jepak) Sdn Bhd</a>
                            <a href="@if(Auth::user()->role == 'super_userController'){{ url('superuser/users-list') }}@else{{ url('/tender-summery') }}@endif" class="btn btn-info btn-left">Majrany Plantation Sd Bhd</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection