@include('common/admin_inner_header') 
@include('common/admin_main_navbar')
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-sm-12 shipper-wrap">
                <div class="fromWrap">
                 <button type="button" class="btn btn-common btn-blue collapseBtn" data-toggle="collapse" data-target="#demo"><i class="material-icons">search</i></button>
                    <div class="card">
                         <div class="searchFormHeader">
                            <div id="demo" class="collapse">
                             <form id="searchadminusers" class="form-horizontal searchForm" enctype="multipart/form-data" autocomplete="off">
                                <div class="row clearfix">

                                    <div class="col-sm-3">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="admin_username_search">Admin Users</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="admin_username_search" name="admin_username_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-9 search-reset-box">
                                        <a class="btn-reset waves-effect" onclick="resetAdminusersSearch()">Reset</a>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <button class="btn btn-blue btn-common  waves-effect" type="submit" id="addbutton">Search</button>
                                    </div>
									</div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="contentInner">
                <div class="col-lg-12 innerCards" id="content-area">
                    <div class="card">
                    <div class="header">
                        <h2>
                            Admin Users
                        </h2>
						<a class="btn btn-default btn-common waves-effect pull-right slide-right">Add Admin User</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive" id="adminusersListTableDiv">
                            @if(isset($data['adminusers']) && !empty($data['adminusers']))
                                <table id="adminusersListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
											<th>Email</th>
                                            <th>Status</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['adminusers'] as $adminusers)
                                            <tr>
                                                <td>{{ $adminusers['admin_username'] }}</td>
												<td>{{ $adminusers['admin_email'] }}</td>
												<td>@if($adminusers['is_active']=='Y') Enabled @else Disabled @endif</td>
												<td>
                                                    <div>
                                                        <a onclick="editAdminusers({{$adminusers['admin_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/edit.svg">
                                                        </a>
                                                        <a onclick="deleteConfirm({{$adminusers['admin_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>
                                                    </div>
                                                    <div id="delconfirm_{{$adminusers['admin_id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$adminusers['admin_id']}}, 'adminusers', 'adminusersListTableDiv', 'adminusersListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$adminusers['admin_id']}})">No</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    No Record Found
                                @endif
                        </div>
                    </div>
                    </div>
                </div>

                <div class="box col-lg-6 right-panel-big" style="width:100% !important;">
                    <div class="card innerCards">
                        <div id="addpanel">
                            <div class="header">
                                <h2>
                                    Add Admin Users
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body">
                                <form id="addadminusers" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                    <div class="formwrap">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="admin_username">Username<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="admin_username" name="admin_username" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Password</label>
											</div>
											<div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="password" id="admin_password" name="admin_password" class="form-control" maxlength="99">
													</div>
												</div>
											</div>	
										</div>
										<div class="row clearfix">

                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="admin_email">Email<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="admin_email" name="admin_email" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
                                            
                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="is_active">Active</label>
                                            </div>
                                            <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                                                <input type="checkbox" id="is_active" name="is_active" checked class="" style="position: unset; opacity: 1">
                                            </div> 											
										</div>
										<div class="row clearfix">
										    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="news_img_edit">Supplier</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
                                                            @foreach($data['supplierlist'] as $supplier)
																<input type="checkbox" name="selected_supplier_ids[]" value="{{ $supplier->supplier_id }}" style="position: unset; opacity: 1">
																{{ $supplier->supplier_name }} 
																<br>
															@endforeach
													</div>
												</div>
											</div>
									   </div>
									</div>
                                    <div class="row clearfix">
                                        <div class="col-lg-12">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <button class="btn btn-blue btn-common waves-effect" type="submit" id="addbutton">Save</button>
                                        <span class="font-bold col-pink" id="error-msg"></span>
                                        <span class="font-bold col-teal" id="success-msg"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="editpanel">
                            <div class="header">
                                <h2>
                                    Edit Admin Users
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body">
                                <form id="updateadminusers" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <div class="formwrap">
                                    <div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="admin_username_edit">Username<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="admin_username_edit" name="admin_username" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Password</label>
											</div>
											<div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="password" id="admin_password_edit" name="admin_password" class="form-control" maxlength="99">
													</div>
												</div>
											</div>
											
								    </div>
									<div class="row clearfix">

                                            <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="admin_email_edit">Email<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="admin_email_edit" name="admin_email" class="form-control" maxlength="50">
													</div>
												</div>
											</div>

									        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="is_active_edit">Active</label>
                                            </div>
                                            <div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
                                                <input type="checkbox" id="is_active_edit" name="is_active" class="" style="position: unset; opacity: 1">
                                            </div>
                                            
									</div>
										
                                    </div>
                                    <input type="hidden" id="_token_edit" name="_token" value="<?php echo csrf_token(); ?>"/>
                                    <input type="hidden" name="admin_id" id="admin_id" value=""/>

                                    <div class="row clearfix">
                                        <div class="col-lg-12">
                                        <button class="btn btn-blue btn-common waves-effect" type="submit" id="editbutton">Update</button>
                                        <span class="font-bold" id="success-msg-edit" style="display:none"></span>
                                        <span class="font-bold" id="error-msg-edit" style="display:none"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('common/admin_inner_footer')

<script type="text/javascript">
    $(function () {
        navigationActivate();
        $('#feelingsListTable').DataTable({
            "searching": false,
            "bDestroy": true,
			"aaSorting": [[ 1, "asc" ]]
        });
    });
    function navigationActivate() {
        $('#adminusersmenu').addClass('active');
    }
	function limitInput(element, maxLength) {
		if (element.value.length > maxLength) {
			element.value = element.value.slice(0, maxLength);
		}
	}
</script>
