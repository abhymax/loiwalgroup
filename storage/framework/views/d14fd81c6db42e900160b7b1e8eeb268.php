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
                                    Stock Transfer
                                </h2>
                                <a class="btn  btn-blue pull-right" href="<?php echo e(url('/')); ?>/stocktransfer">Back</a>
                            </div>
							<div class="body">
                                
                                    <div class="">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="po">Party Name</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php echo e($data['invoiceinfo']->party_name); ?>

											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="supplier_address">Supplier</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												
                                                <?php echo e($data['invoiceinfo']['supplier']->supplier_name); ?>  
													
											</div>
											
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="po">Destination</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php echo e($data['invoiceinfo']->destination); ?>

											</div>
											
											
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="po">Invoice Number#</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php echo e($data['invoiceinfo']->invoice_number); ?>

											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="supplier_address">Invoice Date</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												
                                                <?php echo e(\Carbon\Carbon::parse($data['invoiceinfo']->invoice_date)->format('d/m/Y')); ?>  
													
											</div>
											
										</div>
										
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Ewaybill Number#</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												
												<?php if($data['invoiceinfo']->ewaybill_no!=''): ?> <?php echo e($data['invoiceinfo']->ewaybill_no); ?> <?php else: ?> NA <?php endif; ?>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Ewaybill Updated</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php if($data['invoiceinfo']->ewaybill_updated=='Y'): ?> Yes <?php else: ?> No <?php endif; ?>
											</div>
										</div>
										
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Transport</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php echo e($data['invoiceinfo']->transport); ?>

											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Dispatch Date</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php echo e(\Carbon\Carbon::parse($data['invoiceinfo']->dispatch_date)->format('d/m/Y')); ?>  
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Truck Number</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php if($data['invoiceinfo']->truck_no!=''): ?> <?php echo e($data['invoiceinfo']->truck_no); ?> <?php else: ?> NA <?php endif; ?>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">LR Number</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php if($data['invoiceinfo']->lr_no!=''): ?> <?php echo e($data['invoiceinfo']->lr_no); ?> <?php else: ?> NA <?php endif; ?>
											</div>
										</div>
									    <div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Delivered</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												
												<?php if($data['invoiceinfo']->is_delivered=='Y'): ?> Yes <?php else: ?> No <?php endif; ?>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Delivery Date</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php echo e(\Carbon\Carbon::parse($data['invoiceinfo']->delivery_date)->format('d/m/Y')); ?> 
											</div>
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">POD Status</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												
												<?php if($data['invoiceinfo']->pod_status=='R'): ?> Received <?php else: ?> Not Received <?php endif; ?>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Remarks</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												
												<?php if($data['invoiceinfo']->remarks!=''): ?> <?php echo e($data['invoiceinfo']->remarks); ?> <?php else: ?> NA <?php endif; ?>
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
															<td>
															    <?php echo e($podinfo['product']->product_name); ?>

																
															</td>
															<td>
																<?php echo e($podinfo['product_sku']); ?>

															</td>
															<td>
																<?php echo e($podinfo['batch_no']); ?>

															</td>
															<td>
																<?php echo e($podinfo['qty']); ?>

															</td>
															<td>
																<?php echo e($podinfo['rate']); ?>

															</td>
															<td>
																<?php echo e($podinfo['amount']); ?>

															</td>
															
														</tr>
														<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</tbody>
												</table>
												

											</div>
											
                                        </div>
										
										<div class="row clearfix">
											<div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
											&nbsp;
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Total Amount (&#8377; )</label>
											</div>
											<div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
												
												<?php echo e($data['invoiceinfo']->total_amount); ?>  	
											</div>
										</div>
                                    </div>
									
									
                                    <div class="row clearfix form-horizontal">
                                        <div class="col-lg-12">
                                        <span class="font-bold col-pink" id="error-msg"></span>
                                        <span class="font-bold col-teal" id="success-msg"></span>
                                        </div>
                                    </div>
								
                                
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

<script type="text/javascript">
    $(function () {
        navigationActivate();
		$('.payment_info_date,#receive_date,#invoice_date').datetimepicker({
			useCurrent: false,
			format:'YYYY-MM-DD'
		});

    });
    function navigationActivate() {
        $('#stocktransfer').addClass('active');
    }
	
</script>
<?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/stocktransfer/transfer_view.blade.php ENDPATH**/ ?>