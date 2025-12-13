<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To | Stock Management</title>
    <!-- Favicon-->
    <link rel="shortcut icon" type="image/png" href="{{url('/')}}/public/assets/images/favicon.png"/>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/plugins/bootstrap/css/bootstrap.css">

    <!-- Waves Effect Css -->
    <link href="{{url('/')}}/public/assets/css/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{url('/')}}/public/assets/css/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="{{url('/')}}/public/assets/css/plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{url('/')}}/public/assets/css/css/themes/all-themes.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="{{url('/')}}/public/assets/css/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

	<link href="{{url('/')}}/public/assets/css/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="{{url('/')}}/public/assets/css/css/style.css" rel="stylesheet">

    <link href="{{url('/')}}/public/assets/css/css/custom.css" rel="stylesheet">

	<!-- Jquery Core Js -->
    <script src="{{url('/')}}/public/assets/css/plugins/jquery/jquery.min.js"></script>



    <!-- Bootstrap Core Js -->
    <script src="{{url('/')}}/public/assets/css/plugins/bootstrap/js/bootstrap.js"></script>

    <!-- Select Plugin Js -->
    <!--<script src="{{url('/')}}/public/assets/css/plugins/bootstrap-select/js/bootstrap-select.js"></script>-->

    <!-- Slimscroll Plugin Js -->
    <script src="{{url('/')}}/public/assets/css/plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="{{url('/')}}/public/assets/css/plugins/node-waves/waves.js"></script>

    <!-- Jquery CountTo Plugin Js -->
    <script src="{{url('/')}}/public/assets/css/plugins/jquery-countto/jquery.countTo.js"></script>

    <!-- Validation Plugin Js -->
    <script src="{{url('/')}}/public/assets/css/plugins/jquery-validation/jquery.validate.js"></script>

    <!-- Bootstrap DatePicker Css -->
    <link href="{{url('/')}}/public/assets/css/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />

    <!-- Morris Css -->
    <link href="{{url('/')}}/public/assets/css/plugins/morrisjs/morris.css" rel="stylesheet" />



    <script>
		var site_url = '{{url('/')}}';
	</script>
</head>

<body class="sidebar-menu">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-thm_golden">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Page Loader -->
    <div class="process-loader-wrapper" style="display: none;">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-thm_golden">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <!--<a class="navbar-brand" href="index.html">Almutlaq Rent</a>-->
                <span class="sidebar-toggle"><i class="material-icons">notes</i></span>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <div class="user-info">

                		<div class="info-container">
                			<!--<div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Session::get('first_name') }} {{ Session::get('last_name') }}</div>
                			<div class="email">{{ Session::get('email') }}</div>-->
                			<div class="btn-group user-helper-dropdown">
                            <div class="image"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                			@if(Session::get('profile_image_link') != '')
                				<img src="{{ url('public/'.Session::get('profile_image_link')) }}" width="48" height="48" alt="User">
                			@else
                				<img src="{{url('/')}}/public/assets/images/user.png" width="48" height="48" alt="User" />
                            @endif
                            <i class="material-icons">arrow_drop_down</i>
                		</div>

                				<ul class="dropdown-menu pull-right">
                					
                					<!--<li role="separator" class="divider"></li>
                					<li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>
                					<li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>
                					<li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>-->
                					
                                    @if(Session::get('admin_id'))
                                        <li><a href="{{url('/')}}/my-profile"><i class="material-icons">person</i>Profile</a></li>
                                        <li role="separator" class="divider"></li>
                					    <li id="admin-logout"><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                                    @else
                                        <li id="inventory-admin-logout"><a href="javascript:void(0);"><i class="material-icons">input</i>Sign Out</a></li>
                                    @endif
                				</ul>
                			</div>
                		</div>
                	</div>
                </div>
            	<!-- #User Info -->
              
            </div>

        </div>
    </nav>
    <!-- #Top Bar -->
    <section>
