 								<form id="updateproduct" class="form-horizontal" autocomplete="off">
                                    <div class="formwrap">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="category">Category</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control" name="category_id" id="category_id" disabled>
															<?php $__currentLoopData = $data['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($category->category_id); ?>" <?php if($data['productinfo']->category_id==$category->category_id): ?>selected="selected"<?php endif; ?>><?php echo e($category->category_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
														</select>  
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="category_description">Supplier </label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control" name="supplier_id" id="supplier_id" disabled>
															<?php $__currentLoopData = $data['suppliers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($supplier->supplier_id); ?>" <?php if($data['productinfo']->supplier_id==$supplier->supplier_id): ?>selected="selected"<?php endif; ?>><?php echo e($supplier->supplier_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
														</select>  
													</div>
												</div>
											</div>
											
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="uom">Unit of Measurement</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control" name="uom_id" id="uom_id" disabled>
															<?php $__currentLoopData = $data['uomall']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($uom->uom_id); ?>"<?php if($data['productinfo']->uom_id==$uom->uom_id): ?>selected="selected"<?php endif; ?>><?php echo e($uom->uom_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
														</select>  
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="product_name">Product Name<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="product_name" name="product_name" class="form-control" maxlength="45" value="<?php echo e($data['productinfo']->product_name); ?>">
													</div>
												</div>
											</div>
											
										</div>
										<div class="row clearfix">
											
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="product_sku">Product SKU<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="product_sku" name="product_sku" class="form-control" maxlength="20" value="<?php echo e($data['productinfo']->product_sku); ?>">
													</div>
												</div>
											</div>
											
										</div>
                                    </div>
									<input type="hidden" id="_token_edit" name="_token" value="<?php echo csrf_token(); ?>"/>
                                    <input type="hidden" name="product_id" id="product_id" value="<?php echo e($data['productinfo']->product_id); ?>"/>
                                    <div class="row clearfix">
										<div class="col-lg-12">
										<button class="btn btn-blue btn-common waves-effect" type="submit" id="editbutton">Update</button>
										<span class="font-bold" id="success-msg-edit" style="display:none"></span>
										<span class="font-bold" id="error-msg-edit" style="display:none"></span>
										</div>
                                    </div>
                                </form>



<script type="text/javascript">
    $(function() {
		$('#updateproduct').validate({
			rules: {
				'product_sku': {
					required: true
				},
				'product_name': {
					required: true
				}
			}, 
			messages: {
				product_name: 'Product name required',
				product_sku: 'Product SKU required'
			},
			highlight: function (input) {
				$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function (input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function (error, element) {
				$(element).parents('.input-group').append(error);
				$(element).parents('.form-group').append(error);
			},
			submitHandler: function(form,e) {
				updateProduct();
			}
		});
	});
</script><?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/product/edit_product.blade.php ENDPATH**/ ?>