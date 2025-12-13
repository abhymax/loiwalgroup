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
                                    View Material In
                                </h2>
                                <a class="btn  btn-blue pull-right" href="<?php echo e(url('/')); ?>/materialin">Back</a>
                            </div>
							<div class="body">
                                
                                    <div class="">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="po">Invoice Number #</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php echo e($data['invoiceinfo']->invoice_number); ?>

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
												<label for="container">Invoice Date</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php echo e(\Carbon\Carbon::parse($data['invoiceinfo']->invoice_date)->format('d/m/Y')); ?>

											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Receive Date</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<?php echo e(\Carbon\Carbon::parse($data['invoiceinfo']->receive_date)->format('d/m/Y')); ?>

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
															<th>Description</th>
															<th>Qty</th>
															<th>Rate (&#8377;)</th>
															<th>Amount (&#8377;)</th>
															<th>Manufacturing Date</th>
															<th>Best Before Date</th>
															
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
																<?php echo e($podinfo['description']); ?>

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
															<td>
																<?php if($podinfo['manufacturing_date']!=''): ?><?php echo e(\Carbon\Carbon::parse($podinfo['manufacturing_date'])->format('m/d/Y')); ?><?php endif; ?>
															</td>
															<td>
																<?php if($podinfo['expiry_date']!=''): ?><?php echo e(\Carbon\Carbon::parse($podinfo['expiry_date'])->format('m/d/Y')); ?><?php endif; ?>
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
		
		$("#supplier_id").on('change', function() {
			var sid = $(this).val();
				if(sid){
					$.ajax ({
						type: 'GET',
						url: site_url+'/materialin/getproduct/'+sid,
						success : function(htmlresponse) {
							$('.product_name').html(htmlresponse);
							console.log(htmlresponse);
						}
					});
				}
		});
    });
    function navigationActivate() {
        $('#materialin').addClass('active');
    }
	
</script>
<?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/invoice/invoice_view.blade.php ENDPATH**/ ?>