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
        <div class="logo">
            <a href="javascript:void(0);">Almutlaq</a>
            <small>Rent Collection System</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="reset_password" method="POST" autocomplete="off">
                    <div class="msg">Reset your pasword here</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8 p-t-5">
                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                            <input type="hidden" name="token" value="{{ $data['token']}}"/>
                            <input type="hidden" name="email" value="{{ $data['email']}}"/>
                        </div>
                        <div class="col-xs-4">
                            <button class="btn btn-block bg-pink waves-effect" type="submit">Reset</button>
                        </div>
                    </div>
                    <div class="row m-t-15 m-b--20">
                        <div class="col-xs-9">
                            <div class="font-bold col-pink" id="error-msg"></div>
                            <div class="font-bold col-teal" id="success-msg"></div>
                        </div>
                        <div class="col-xs-3 align-right">
                            <a href="{{url('/')}}/login">Sign In!</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@include('common/login_footer')
