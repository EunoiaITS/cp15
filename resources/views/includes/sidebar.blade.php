<!-- sidebar nav -->
<div class="msb" id="msb">
    <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <div class="brand-wrapper">
                <!-- Brand -->
                <div class="brand-name-wrapper">
                    <a class="navbar-brand" href="index.html">
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
                    <span class="user-name-right">Jhon Doe</span>
                </div>
                <div class="user-name-full">
                    <span class="user-name"><b>Role :</b></span>
                    <span class="user-name-right">Executive</span>
                </div>
            </div>
            <ul class="nav navbar-nav">
                <!-- Dropdown-->
                <li class="panel panel-default" id="dropdown">
                    <a data-toggle="collapse" href="#dropdown-lvl1">
                        Create Supplier List<span class="icon-right"></span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-lvl1" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="executive-create-supplier.html">Create</a></li>
                                <li><a href="executive-upload-supp.html">Upload</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="executive-view-supplier.html"> View Supplier List</a></li>
                <!-- Dropdown-->
                <li class="panel panel-default active" id="dropdown">
                    <a data-toggle="collapse" href="#dropdown-lvl2">
                        Create QR Order<span class="icon-right"></span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-lvl2" class="panel-collapse collapse active">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="executive-create.html">Create</a></li>
                                <li><a href="executive-upload.html">Upload</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
                <li><a href="executive-order-list.html"> Veiw QR Order List</a></li>
                <li><a href="executive-invite.html"> Invite Suppliers</a></li>
                <li><a href="executive-view-quatation.html"> View Supplier Quotation</a></li>
                <li><a href="executive-tender-summary.html"> Tender Summary</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</div><!-- end sidebar menu -->