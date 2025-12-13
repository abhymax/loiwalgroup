<?php echo $__env->make('common/admin_inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common/admin_main_navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="fromWrap">
                 <button type="button" class="btn btn-common btn-blue collapseBtn" data-toggle="collapse" data-target="#demo"><i class="material-icons">search</i></button>
                    <div class="card">
                         <div class="searchFormHeader">
                            <div id="demo" class="collapse">
                             <form id="searchsupplier" class="form-horizontal searchForm" enctype="multipart/form-data" autocomplete="off">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="supplier_number_search">Number</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="supplier_number_search" name="supplier_number_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="supplier_name_search">Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="supplier_name_search" name="supplier_name_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="supplier_email_search">Warehouse</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" name="warehouse_id_search" id="warehouse_id_search">
														    <option value=''>All</option>
															<?php $__currentLoopData = $data['warehouses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($warehouse->warehouse_id); ?>"><?php echo e($warehouse->warehouse_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
														</select>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									
								</div>
								<div class="row clearfix">
								    <div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="supplier_email_search">Email</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="supplier_email_search" name="supplier_email_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="supplier_mobile_search">Mobile Number</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="supplier_mobile_search" name="supplier_mobile_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-sm-3" style="width: 100%;">
                                                <a class="btn-reset waves-effect" onclick="resetSupplierSearch()">Reset</a>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                                <button class="btn btn-blue btn-common  waves-effect" type="submit" id="addbutton">Search</button>
                                            </div>
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
                            Principals
                        </h2>
						<a class="btn btn-default btn-common waves-effect pull-right slide-right">Add Principal</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive" id="supplierListTableDiv">
                            <?php if(isset($data['suppliers']) && !empty($data['suppliers'])): ?>
                                <table id="supplierListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
											<th>Warehouse</th>
											<th>Email</th>
											<th>Mobile Number</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data['suppliers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
													<?php echo e($supplier['supplier_number']); ?>

                                                </td>
                                                <td>
                                                    <?php echo e($supplier['supplier_name']); ?>

                                                </td>
												<td>
                                                    <?php echo e($supplier['warehouse']['warehouse_name']); ?>

                                                </td>
												<td>
                                                    <?php echo e($supplier['supplier_email']); ?>

                                                </td>
												<td>
                                                    <?php echo e($supplier['supplier_mobile_number']); ?>

                                                </td>
                                                <td>
                                                    <div>
                                                        <a onclick="editSupplier(<?php echo e($supplier['supplier_id']); ?>)" style="cursor:pointer; text-decoration: none">
                                                            <img src="<?php echo e(url('/')); ?>/public/assets/images/edit.svg">
                                                        </a>
														<?php if($supplier['product_count']<=0): ?> 
                                                        <a onclick="deleteConfirm(<?php echo e($supplier['supplier_id']); ?>)" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="<?php echo e(url('/')); ?>/public/assets/images/delete.svg">
                                                        </a>
														<?php endif; ?>
                                                    </div>
                                                    <div id="delconfirm_<?php echo e($supplier['supplier_id']); ?>" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord(<?php echo e($supplier['supplier_id']); ?>, 'suppliers', 'supplierListTableDiv', 'supplierListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv(<?php echo e($supplier['supplier_id']); ?>)">No</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php else: ?>
                                    No Record Found
                                <?php endif; ?>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="box col-lg-6 right-panel-big" style="width:100% !important;">
                    <div class="card innerCards">
                        <div id="addpanel">
                            <div class="header">
                                <h2>
                                    Add Principal
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body">
                                <form id="addSupplier" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                    <div class="">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_number">Number<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_number" name="supplier_number" class="form-control" maxlength="20">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_name">Name<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_name" name="supplier_name" class="form-control" maxlength="40">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
										    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_address">Warehouse<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
                                                        <select class="form-control" name="warehouse_id" id="warehouse_id">
															<?php $__currentLoopData = $data['warehouses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($warehouse->warehouse_id); ?>"><?php echo e($warehouse->warehouse_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
														</select>  
													</div>
												</div>
											</div>
										    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_phone_number">Phone Number</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_phone_number" name="supplier_phone_number" class="form-control" maxlength="15">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
										    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_address">Address</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
                                                        <textarea type="text" id="supplier_address" name="supplier_address" class="form-control" maxlength="135"></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_city">City</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_city" name="supplier_city" class="form-control" maxlength="20">
													</div>
												</div>
											</div>
										</div>

                                        <div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_contact_person">Contact Person(State)</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_contact_person" name="supplier_contact_person" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_contact_person">Contact Person(H/O)</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_contact_person_ho" name="supplier_contact_person_ho" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_email">Primary Email<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_email" name="supplier_email" class="form-control" maxlength="100">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_mobile_number">Primary Mobile Number<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_mobile_number" name="supplier_mobile_number" class="form-control" maxlength="15">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_email">Email</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<textarea id="contact_emails" name="contact_emails" class="form-control"></textarea>
														<small>Add multiple emails seperated by comma(,)</small>
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_mobile_number">Mobile Number<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<textarea id="contact_numbers" name="contact_numbers" class="form-control"></textarea>
														<small>Add multiple numbers seperated by comma(,)</small>
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
                                    Edit Principal
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body">
                                <form id="updatesupplier" class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                    <div class="">
                                        <div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_number">Number<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_number_edit" name="supplier_number" class="form-control" maxlength="20">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_name">Name<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_name_edit" name="supplier_name" class="form-control" maxlength="40">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
										    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_address">Warehouse<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
                                                        <select class="form-control" name="warehouse_id" id="warehouse_id_edit">
															<?php $__currentLoopData = $data['warehouses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($warehouse->warehouse_id); ?>"><?php echo e($warehouse->warehouse_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
														</select>  
													</div>
												</div>
											</div>
										    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_phone_number">Phone Number</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_phone_number_edit" name="supplier_phone_number" class="form-control" maxlength="15">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
										    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_address">Address</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
                                                        <textarea type="text" id="supplier_address_edit" name="supplier_address" class="form-control" maxlength="135"></textarea>
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_city">City</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_city_edit" name="supplier_city" class="form-control" maxlength="20">
													</div>
												</div>
											</div>
										</div>

                                        <div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_contact_person">Contact Person(State)</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_contact_person_edit" name="supplier_contact_person" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_contact_person">Contact Person(H/O)</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_contact_person_ho_edit" name="supplier_contact_person_ho" class="form-control" maxlength="50">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_email">Primary Email<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_email_edit" name="supplier_email" class="form-control" maxlength="100">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_mobile_number">Primary Mobile Number<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="supplier_mobile_number_edit" name="supplier_mobile_number" class="form-control" maxlength="15">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_email">Email</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<textarea id="contact_emails_edit" name="contact_emails" class="form-control"></textarea>
														<small>Add multiple emails seperated by comma(,)</small>
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_mobile_number">Mobile Number<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<textarea id="contact_numbers_edit" name="contact_numbers" class="form-control"></textarea>
														<small>Add multiple numbers seperated by comma(,)</small>
													</div>
												</div>
											</div>
										</div>
										</div>
                                        <input type="hidden" id="_token_edit" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <input type="hidden" name="supplier_id" id="supplier_id" value=""/>

                                        <div class="row clearfix">
                                            <div class="col-lg-12">
                                            <button class="btn btn-blue btn-common waves-effect" type="submit" id="editbutton">Update</button>
                                            <span class="font-bold" id="success-msg-edit" style="display:none"></span>
                                            <span class="font-bold" id="error-msg-edit" style="display:none"></span>
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
    </div>
</section>

<?php echo $__env->make('common/admin_inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function () {
        navigationActivate();
        $('#supplierListTable').DataTable({
            "searching": false,
            "bDestroy": true
        });
    });
    function navigationActivate() {
        $('#supplier').addClass('active');
    }
</script>
<?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/supplier/supplier_list.blade.php ENDPATH**/ ?>