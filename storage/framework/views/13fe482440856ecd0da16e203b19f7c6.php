<?php echo $__env->make('common/admin_inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common/admin_main_navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
		<div class="row clearfix">
            <div>
				<div class="box col-lg-6 right-panel-big" style="width:100% !important;">
                    <div class="card innerCards">
                        <div>
                            <div class="header">
                                <h2>
                                    Add Stock Transfer
                                </h2>
                                <a class="btn  btn-blue pull-right" href="<?php echo e(url('/')); ?>/stocktransfer">Back</a>
                            </div>
							<div class="body">
                                <form id="addStocktransfer"  class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                    <div class="">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Party Name<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="party_name" name="party_name" class="form-control" maxlength="30">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_address">Supplier<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
                                                        <select class="form-control" name="supplier_id" id="supplier_id">
														    <option value="">Select</option>
															<?php $__currentLoopData = $data['suppliers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($supplier->supplier_id); ?>"><?php echo e($supplier->supplier_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
														</select>  
													</div>
												</div>
											</div>
											
										</div>
										<div class="row clearfix">
										   <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Destination<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="destination" name="destination" class="form-control" maxlength="30">
													</div>
												</div>
											</div>
											
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Invoice Number#<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="invoice_number" name="invoice_number" class="form-control" maxlength="30">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Invoice Date<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line" id="bs_datepicker_container">
														<input type="text" id="invoice_date" name="invoice_date" class="form-control" >
													</div>
												</div>
											</div>
											
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Ewaybill Number#</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="ewaybill_no" name="ewaybill_no" class="form-control" maxlength="30">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Ewaybill Updated</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control" name="ewaybill_updated" id="ewaybill_updated">
														    <option value="">Select</option>
															<option value="Y">Yes</option>
															<option value="N">No</option>
														</select>
													</div>
												</div>
											</div>
										</div>
									    <div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Transport<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="transport" name="transport" class="form-control" maxlength="30">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Dispatch Date<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line" id="bs_datepicker_container">
														<input type="text" id="dispatch_date" name="dispatch_date" class="form-control" >
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Truck Number</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="truck_no" name="truck_no" class="form-control" maxlength="30">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">LR Number</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="lr_no" name="lr_no" class="form-control" maxlength="30">
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Delivered<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
													    <select class="form-control" name="is_delivered" id="is_delivered">
															<option value="Y">Yes</option>
															<option value="N">No</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Delivery Date<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line" id="bs_datepicker_container">
														<input type="text" id="delivery_date" name="delivery_date" class="form-control" >
													</div>
												</div>
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">POD Status<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control" name="pod_status" id="pod_status">
															<option value="R">Received</option>
															<option value="NR">Not Received</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Remarks</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="remarks" name="remarks" class="form-control" maxlength="100">
													</div>
												</div>
											</div>
										</div>
										<div id="upload-files-pdf"></div>
										<div class="row clearfix">
											<div class="col-lg-12" id="pod_block">
												<table id="table_block" class="table-box dataTable">
													<thead>
														<tr>
															<th>Product</th>
															<th>SKU</th>
															<th>Batch No.</th>
															<th>Qty</th>
															<th>Rate (&#8377;)</th>
															<th>Amount (&#8377;)</th>
															
															
														</tr>
													</thead>
													<tbody>
														<?php $__currentLoopData = $data['podinfo']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $podinfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
														<tr id="tr_block_<?php echo e($loop->index); ?>">
															<input type="hidden" name="material_id_<?php echo e($loop->index); ?>" id="material_id_<?php echo e($loop->index); ?>" value="<?php echo e($podinfo['material_id']); ?>">
															
															<td>
															    <select name="product_id_<?php echo e($loop->index); ?>" id="product_id_<?php echo e($loop->index); ?>" class="product_name" onchange="getDetails(<?php echo e($loop->index); ?>)">
																<option value="">Select</option>
																</select>
																
															</td>
															<td>
																<input type="text" name="product_sku_<?php echo e($loop->index); ?>" value="<?php echo e($podinfo['product_sku']); ?>" readonly id="product_sku_<?php echo e($loop->index); ?>" maxlength="20">
															</td>
															<td>
															    <select name="batch_no_<?php echo e($loop->index); ?>" id="batch_no_<?php echo e($loop->index); ?>" onchange="getRate(<?php echo e($loop->index); ?>)">
																<option value="">Select</option>
																</select>
															</td>
															<td>
																<input type="number" name="qty_<?php echo e($loop->index); ?>" value="<?php echo e($podinfo['qty']); ?>" onkeypress="return event.charCode >= 48" min="1" onchange="calculatePrice(<?php echo e($loop->index); ?>)" id="qty_<?php echo e($loop->index); ?>"  maxlength="20">
															</td>
															<td>
																<input type="number" name="rate_<?php echo e($loop->index); ?>" value="<?php echo e($podinfo['rate']); ?>" maxlength="50" id="rate_<?php echo e($loop->index); ?>" onchange="calculatePrice(<?php echo e($loop->index); ?>)">
															</td>
															<td>
																<input type="text" name="amount_<?php echo e($loop->index); ?>" value="<?php echo e($podinfo['amount']); ?>" maxlength="50" id="amount_<?php echo e($loop->index); ?>" class="amount" readonly>
															</td>
															
														</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</tbody>
												</table>
												<input type="hidden" value="<?php echo e($data['block_count']); ?>" name="block_count" id="block_count" />

											</div>
											
                                        </div>
										<div class="row clearfix add-more-box">
                                            <a class="btn-common" onclick="addnewBlock()"> Add More</a>
                                            
                                        </div>
										<div class="row clearfix">
											<div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
											&nbsp;
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Total Amount (&#8377; )</label>
											</div>
											<div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="total_amount" name="total_amount" readonly class="form-control" >
													</div>
												</div>
											</div>
										</div>
                                    </div>
									
									
                                    <div class="row clearfix form-horizontal">
                                        <div class="col-lg-12">
										
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <button class="btn btn-blue btn-common waves-effect" type="submit" id="addbutton" onclick="test()">Save</button>
										
                                        <span class="font-bold col-pink" id="error-msg"></span>
                                        <span class="font-bold col-teal" id="success-msg"></span>
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

<link src="<?php echo e(url('/')); ?>/public/assets/css/bootstrap-datetimepicker.css">
<script src="<?php echo e(url('/')); ?>/public/assets/js/moment.js"></script>
<script src="<?php echo e(url('/')); ?>/public/assets/js/bootstrap-datetimepicker.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
    $(function () {
        navigationActivate();
		$('#dispatch_date,#invoice_date,#delivery_date').datetimepicker({
			useCurrent: false,
			format:'YYYY-MM-DD'
		});
		
		$("#supplier_id").on('change', function() {
			var sid = $(this).val();
				if(sid){
					$.ajax ({
						type: 'GET',
						url: site_url+'/stocktransfer/getproduct/'+sid,
						success : function(htmlresponse) {
							$('.product_name').html(htmlresponse);
							console.log(htmlresponse);
						}
					});
				}
		});
    });
	
    function navigationActivate() {
        $('#stocktransfer').addClass('active');
    }
	
	
</script>
<?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/stocktransfer/transfer_add.blade.php ENDPATH**/ ?>