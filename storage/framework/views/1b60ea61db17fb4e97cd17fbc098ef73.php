<?php if(isset($data['reports']) && !empty($data['reports'])): ?>
<form method="post" action="<?php echo e(route('inwardreport.export')); ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>

	<input type="hidden" name="sid" value="<?php echo e($data['sid']); ?>">
	<input type="hidden" name="inv_date" value="<?php echo e($data['inv_date']); ?>">
	<input type="submit" class="btn btn-primary" value="Export Excel">
    </form>
	
	<form method="post" action="<?php echo e(route('inwardreport.exportpdf')); ?>">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>

	<input type="hidden" name="sid" value="<?php echo e($data['sid']); ?>">
	<input type="hidden" name="inv_date" value="<?php echo e($data['inv_date']); ?>">
	<input type="submit" class="btn btn-primary" value="Export PDF">
    </form> 
                                <table id="transferreportListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Recd Date</th>
                                            <th>Doc No</th>
											<th>Source</th>
											<th>Invoice Date</th>
											<th>Product</th>
											<th>Pack</th>
											<th>Total Curtain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									    <?php $__currentLoopData = $data['reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
											    <td>
													<?php echo e($report['delivery_date']); ?>

                                                </td>
                                                <td>
													<?php echo e($report['invoice_number']); ?>

                                                </td>
                                                <td>
													<?php echo e($report['party_name']); ?>

                                                </td>
												<td>
                                                    <?php echo e(\Carbon\Carbon::parse($report['invoice_date'])->format('d/m/Y')); ?>

                                                </td>
												<td>
												<?php $__currentLoopData = $report['stocktransfermaterial']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($material['product_name']); ?> <br/>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
												</td>
												<td>
												<?php $__currentLoopData = $report['stocktransfermaterial']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $material): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
													<?php echo e($material['product_sku']); ?> <br/>
												<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>  
												</td>
												<td>
												   <?php echo e($report['stocktransfermaterial_sum_qty']); ?>

												</td>
											</tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								    </tbody>
								</table>
								<?php else: ?>
                                    No Record Found
                                <?php endif; ?>
								
                        <?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/inwardreport/list_ajax.blade.php ENDPATH**/ ?>