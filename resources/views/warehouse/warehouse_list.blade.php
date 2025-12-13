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
                             <form id="searchwarehouse" class="form-horizontal searchForm" enctype="multipart/form-data" autocomplete="off">
                                <div class="row clearfix">

                                    <div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="warehouse_name_search">Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="warehouse_name_search" name="warehouse_name_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="warehouse_email_search">Email</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="warehouse_email_search" name="warehouse_email_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="name_search">Contact Number</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="warehouse_contact_number_search" name="warehouse_contact_number_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    
									</div>
									<div class="row clearfix">
                                    <div class="col-sm-3" style="width: 100%;">
                                        <a class="btn-reset waves-effect" onclick="resetWarehouseSearch()">Reset</a>
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
                            Warehouses
                        </h2>
						<a class="btn btn-default btn-common waves-effect pull-right slide-right" onclick="showContact()">Add Warehouse</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive" id="warehouseListTableDiv">
                            @if(isset($data['warehouses']) && !empty($data['warehouses']))
                                <table id="warehouseListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
											<th>Contact Number</th>
											<th>Address</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['warehouses'] as $warehouse)
                                            <tr>
                                                <td><a href="javascript:;" class="wname" id="{{$warehouse['warehouse_id']}}" style="text-decoration: underline; color: blue">{{ $warehouse['warehouse_name'] }}</a>
                                                  
                                                </td>
                                                <td>
                                                    {{ $warehouse['warehouse_email'] }}
                                                  
                                                </td>
												<td>
                                                    {{ $warehouse['warehouse_contact_number'] }}
                                                  
                                                </td>
												<td>
                                                    {{ $warehouse['warehouse_address'] }}
                                                  
                                                </td>
												
                                                <td>
                                                    <div>
                                                        <a onclick="editWarehouse({{$warehouse['warehouse_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/edit.svg">
                                                        </a>
														@if($warehouse['supplier_count']<=0)
                                                        <a onclick="deleteConfirm({{$warehouse['warehouse_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>
														@endif
                                                    </div>
                                                    <div id="delconfirm_{{$warehouse['warehouse_id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$warehouse['warehouse_id']}}, 'warehouses', 'warehouseListTableDiv', 'warehouseListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$warehouse['warehouse_id']}})">No</a>
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
                                    Add Warehouse
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body">
                                <form id="addWarehouse" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                    <div class="formwrap">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Warehouse Name<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="warehouse_name" name="warehouse_name" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Warehouse Incharge<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="warehouse_contact_person" name="warehouse_contact_person" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
											
										</div>
										<div class="row clearfix">
										   <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Contact Number<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="number" id="warehouse_contact_number" name="warehouse_contact_number" class="form-control" maxlength="20">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Email</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="email" id="warehouse_email" name="warehouse_email" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
										</div>
										
									    <div class="row clearfix">
											
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="postal_code">Address </label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<textarea id="warehouse_address" name="warehouse_address" class="form-control" maxlength="350"></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-12" id="contact_block">
												
											</div>
											
                                        </div>
										<div class="row clearfix add-more-box">
                                            <a class="btn-common" onclick="addnewContact()"> Add More</a>
                                            
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
                                    Edit Warehouse
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body">
                                <form id="updatewarehouse" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                <div class="formwrap">
                                    <div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Warehouse Name<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="warehouse_name_edit" name="warehouse_name" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Warehouse Incharge<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="warehouse_contact_person_edit" name="warehouse_contact_person" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
											
											
									</div>
									<div class="row clearfix">
										   <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Contact Number<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="number" id="warehouse_contact_number_edit" name="warehouse_contact_number" class="form-control" maxlength="20">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Email</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="email" id="warehouse_email_edit" name="warehouse_email" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
										</div>	
									    <div class="row clearfix">
											
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="postal_code">Address </label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<textarea id="warehouse_address_edit" name="warehouse_address" class="form-control" maxlength="350"></textarea>
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-12" id="contact_block_edit">
												
											</div>
											
                                        </div>
										<div class="row clearfix add-more-box">
                                            <a class="btn-common" onclick="addnewContact()"> Add More</a>
                                            
                                        </div>
                                    </div>
                                    <input type="hidden" id="_token_edit" name="_token" value="<?php echo csrf_token(); ?>"/>
                                    <input type="hidden" name="warehouse_id" id="warehouse_id" value=""/>

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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Principles</h4>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@include('common/admin_inner_footer')

<script type="text/javascript">
    $(function () {
        navigationActivate();
        $('#warehouseListTable').DataTable({
            "searching": false,
            "bDestroy": true
        });
    });
    function navigationActivate() {
        $('#warehouse').addClass('active');
    }
	$('.wname').on('click',function(){
		var id = $(this).attr('id');
		$('.modal-body').load(site_url+'/getsupplier/'+id,function(){
			$('#myModal').modal({show:true});
		});
	});
</script>
