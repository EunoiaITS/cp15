<body>
<!--[if lte IE 9]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
<![endif]-->
<!--login page -->
<div class="wrapper">
    <!-- topbar menu -->
    <nav class="mnb navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <div style="padding: 15px 0;">
                    <span id="msbo"></span>
                </div>
            </div>
            <div class="header-logo">
                <h3 class="text-center">Bumihas Sdn Bhd</h3>
            </div>
            <div class="user-login">
                <i class="fa fa-user"></i>
                <div class="user-icon-dropdown">
                    <ul>
                        <li><a href="{{ url('profile/change-password') }}">Change Password</a></li>
                        <li><a href="{{ url('logout') }}">Log Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav><!-- end topbar menu area -->
