@include('common/login_header')
<body class="fp-page">
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
    <div class="fp-box">
        <div class="logo">
            <a href="javascript:void(0);"><img src="{{url('/')}}/public/assets/images/logo-dark.png"></a>
        </div>
        <div class="card">
            <div class="body">
                <form id="forgot_password" method="POST" autocomplete="off">
                    <div class="msg">
                        Enter your email address. We'll send you an email with a link to reset your password.
                    </div>
                    <div class="input-group">
                        <!--<span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>-->
                        <div class="form-line">
                            <input type="email" class="form-control" name="email" placeholder="Email" required autofocus>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="font-bold col-teal" id="success-msg">
                        </div>
                        <div class="font-bold col-pink" id="error-msg">
                        </div>
                    </div>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>

                    <button class="btn btn-block btn-lg btn-blue btn-common waves-effect" type="submit">Reser my Password</button>

                    <div class="row m-t-20 m-b--5 align-center">
                        <a href="{{url('/')}}/login">Sign In!</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@include('common/login_footer')
