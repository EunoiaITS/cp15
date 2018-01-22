<!-- sidebar nav -->
<div class="msb" id="msb">
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="brand-wrapper">
                <!-- Brand -->
                <div class="brand-name-wrapper">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ URL::asset('assets/img/logo.png') }}" class="img-responsive" alt="">
                        <h3>Company Name</h3>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Menu -->
        <div class="side-menu-container clearfix">
            <div class="sidebar-user clearfix">
                <h2 class="user-profile">User Profile</h2>
                <div class="user-name-full">
                    <span class="user-name"><b>Name :</b></span>
                    <span class="user-name-right">@if(isset(Auth::user()->name)){{ Auth::user()->name }}@endif</span>
                </div>
                <div class="user-name-full">
                    <span class="user-name"><b>Role :</b></span>
                    <span class="user-name-right">@if(isset(Auth::user()->role)){{ Auth::user()->role }}@endif</span>
                </div>
            </div>
            <ul class="nav navbar-nav">
                @if(isset(Auth::user()->role) && Auth::user()->role == 'suppliers')
                    <li class="active"><a href="{{ url('/supplier-controller/view-qr/') }}"> View QR Order List <span class="label label-default">10</span></a></li>
                    <li><a href="{{ url('/profile') }}"> Profile</a></li>
                    @endif
                @if(isset(Auth::user()->role) && Auth::user()->role == 'admin' || isset(Auth::user()->role) && Auth::user()->role == 'executive' || isset(Auth::user()->role) && Auth::user()->role == 'manager')
                <!-- Dropdown-->
                <li class="panel panel-default @if(isset($page) && $page == 'supplier'){{ "active" }}@endif" id="dropdown">
                    <a data-toggle="collapse" href="#dropdown-lvl1">
                        Create Supplier List<span class="icon-right"></span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-lvl1" class="panel-collapse collapse @if(isset($page) && $page == 'supplier'){{ 'active' }}@endif">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li class="@if(isset($section) && $section == 'add'){{ 'active' }}@endif"><a href="{{ url('/suppliers/add-supplier') }}">Create</a></li>
                                <li class="@if(isset($section) && $section == 'excel'){{ 'active' }}@endif"><a href="{{ url('/suppliers/add-supplier') }}">Upload</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="@if(isset($page) && $page == 'view-supplier'){{ 'active' }}@endif"><a href="{{ url('/suppliers/view-supplier/') }}"> View Supplier List</a></li>
                <!-- Dropdown-->
                <li class="panel panel-default @if(isset($page) && $page == 'qr-order'){{ "active" }}@endif" id="dropdown">
                    <a data-toggle="collapse" href="#dropdown-lvl2">
                        Create QR Order<span class="icon-right"></span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-lvl2" class="panel-collapse collapse @if(isset($page) && $page == 'qr-order'){{ "active" }}@endif">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li class="@if(isset($section) && $section == 'add'){{ 'active' }}@endif"><a href="{{ url('/qr-orders/add-qr-order') }}">Create</a></li>
                                <li class="@if(isset($section) && $section == 'excel'){{ 'active' }}@endif"><a href="{{ url('/qr-orders/add-qr-order') }}">Upload</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li class="@if(isset($page) && $page == 'view-qr-order'){{ "active" }}@endif"><a href="{{url('/qr-orders/view')}}"> Veiw QR Order List</a></li>
                <li class="@if(isset($page) && $page == 'invite'){{ "active" }}@endif"><a href="{{url('suppliers/invite-suppliers')}}"> Invite Suppliers</a></li>
                <li class="@if(isset($page) && $page == 'quotations'){{ "active" }}@endif"><a href="{{url('/view-supplier-quotation')}}"> View Supplier Quotation</a></li>
                <li class="@if(isset($page) && $page == 'tender'){{ "active" }}@endif"><a href="{{url('/tender-summery')}}"> Tender Summary</a></li>
                    @endif
                @if(isset(Auth::user()->role) && Auth::user()->role == 'director')
                    <li class="@if(isset($page) && $page == 'qr-order'){{ "active" }}@endif"><a href="{{url('/qr-orders')}}"> View QR Order</a></li>
                    <li class="@if(isset($page) && $page == 'view-supplier'){{ "active" }}@endif"><a href="{{url('/suppliers')}}"> View Supplier List</a></li>
                    <li><a href="{{url('/approve-quotations')}}">Quotation Approval <span class="label label-default">10</span></a></li>
                    <li class="@if(isset($page) && $page == 'tender'){{ "active" }}@endif"><a href="{{url('/tender-summery')}}"> Tender Summary</a></li>
                    <li><a href="{{url('/allow-price-show')}}">Allow to View Unit Price</a></li>
                    @endif
                @if(isset(Auth::user()->role) && Auth::user()->role == 'super_userController')
                        <!-- Dropdown-->
                        <li class="panel panel-default @if(isset($page) && $page == 'user'){{ "active" }}@endif" id="dropdown">
                            <a data-toggle="collapse" href="#dropdown-lvl1">
                                Create Supplier List<span class="icon-right"></span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-lvl1" class="panel-collapse collapse @if(isset($page) && $page == 'user'){{ 'active' }}@endif">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li class="@if(isset($section) && $section == 'add'){{ 'active' }}@endif"><a href="{{ url('/suppliers') }}">Create</a></li>
                                        <li><a href="executive-upload-supp.html">Upload</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                        <!-- Dropdown-->
                        <li class="panel panel-default" id="dropdown">
                            <a data-toggle="collapse" href="#dropdown-lvl2">
                                Create QR Order<span class="icon-right"></span>
                            </a>
                            <!-- Dropdown level 1 -->
                            <div id="dropdown-lvl2" class="panel-collapse collapse">
                                <div class="panel-body">
                                    <ul class="nav navbar-nav">
                                        <li class="active"><a href="executive-create.html">Create</a></li>
                                        <li><a href="executive-upload.html">Upload</a></li>
                                    </ul>
                                </div>
                            </div>
                        </li>
                    <li class="active"><a href="director-qr-order.html"> View QR Order</a></li>
                    <li><a href="{{ url('/suppliers/viewSupplier') }}"> View Supplier List</a></li>
                    <li><a href="supplier-quotation.html">Quotation Approval <span class="label label-default">10</span></a></li>
                    <li><a href="tender-summary.html"> Tender Summary</a></li>
                    <li><a href="quotation.html">Allow to View Unit Price</a></li>
                    @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</div><!-- end sidebar menu -->