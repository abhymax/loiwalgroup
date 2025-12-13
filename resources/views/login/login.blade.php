@include('common/login_header')

<body class="login-page">
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
    <div class="login-box">
        <div class="card">
            <div class="head">
                Login
            </div>
            <div class="logo-iImg">
                        <img src="{{url('/')}}/public/assets/images/logo.png">
                    </div>
            <div class="body">
                <form id="sign_in" method="POST" autocomplete="off">
                    
                    <div class="input-group">
                        <!--<span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>-->
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required
                                autofocus>
                        </div>
                    </div>
                    <div class="input-group">
                        <!--<span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>-->
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-4">
                            <button class="btn btn-block waves-effect btn-blue btn-common" type="submit">Sign
                                in</button>
                        </div>
                        <div class="col-xs-8 p-t-10">
                            <!--<a href="{{url('/')}}/forgot-password" class="loginLink">Forgot Password?</a>-->
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

    @include('common/login_footer')