@include('common/admin_inner_header')
@include('common/admin_main_navbar')

<section class="content">
    <div class="container-fluid">

        <!-- Horizontal Layout -->
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Update Profile
                        </h2>
                    </div>
                    <div class="body">
                        <form id="profile_form" class="form-horizontal" enctype="multipart/form-data">
                            <div class="input-group">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="admin_email">Email</label>
                                </div>
                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-line">
                                        <input type="text" class="form-control" id="admin_email" name="admin_email" placeholder="Enter your email" value="{{ $data['admin_email'] }}" maxlength="50">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="admin_username">Username</label>
                                </div>
                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-line">
                                        <input type="text" id="admin_username" class="form-control" name="admin_username" placeholder="Enter your username" value="{{ $data['admin_username'] }}"  maxlength="20">
                                    </div>
                                </div>
                            </div>

                           
                            <div class="input-group">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="admin_password">Password</label>
                                </div>
                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-line">
                                        <input type="password" id="password" class="form-control" name="password" placeholder="Enter your password"  maxlength="20">
                                    </div>
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                    <label for="password_confirm">Confirm Password</label>
                                </div>
                                <div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
                                    <div class="form-line">
                                        <input type="password" id="password_confirm" class="form-control" name="password_confirm" placeholder="Enter your password"  maxlength="20">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
                                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                    <button class="btn btn-common btn-blue waves-effect" type="submit">Update</button>
                                    <span class="font-bold" id="error-msg"></span>
                                    <span class="font-bold" id="success-msg"></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Horizontal Layout -->
    </div>
</section>

@include('common/admin_inner_footer')
<script type="text/javascript">
    $(function () {
        navigationActivate();
        
    });
    function navigationActivate() {
        //$('#publications').addClass('active');
	  //  $('#adminmenu').addClass('toggled');
	  //  $('#adminmenuul').show();
		$('#myprofile').addClass('active');
    }
</script>