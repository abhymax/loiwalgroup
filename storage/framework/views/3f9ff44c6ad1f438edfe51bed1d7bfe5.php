	<table class="table table-hover js-basic-example dataTable">
                                    <thead>
			<tr>
				<th>Date</th>
				<th>Doc No</th>
				<th>Source</th>
				<th>Destination</th>
				<th>Transport Name</th>
				<th>Quantity</th>
				<th>Dispatch Date</th>
				<th>Delivery Date</th>
				<th>Remarks</th>
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr>
					<td>
						<?php echo e(\Carbon\Carbon::parse($report['invoice_date'])->format('d/m/Y')); ?>

					</td>
					<td>
						<?php echo e($report['invoice_number']); ?>

					</td>
					<td>
						ABC
					</td>
					<td>
						<?php echo e($report['party_name']); ?>

					</td>
					<td>
						<?php echo e($report['transport']); ?>

					</td>
					<td>
						<?php echo e($report['materialout_sum_qty']); ?>

					</td>
					<td>
					   <?php echo e(\Carbon\Carbon::parse($report['dispatch_date'])->format('d/m/Y')); ?>

					</td>
					<td>
					   <?php echo e(\Carbon\Carbon::parse($report['delivery_date'])->format('d/m/Y')); ?>

					</td>
					<td>
						<?php echo e($report['remarks']); ?>

					</td>
				</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table><?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/misreport/exportlist.blade.php ENDPATH**/ ?>