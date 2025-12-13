<?php if(isset($data['suppliers']) && !empty($data['suppliers'])): ?>
<table  class="table table-hover js-basic-example dataTable">
	<thead>
		<tr>
			<th>Number</th>
			<th>Name</th>
			<th>Email</th>
			<th>Mobile Number</th>
			
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
				<?php echo e($supplier['supplier_email']); ?>

			</td>
			<td>
				<?php echo e($supplier['supplier_mobile_number']); ?>

			</td>
		</tr>
	 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</tbody>
</table>	
 <?php else: ?>
	No Record Found
<?php endif; ?>	
	
	<?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/warehouse/supplier_list.blade.php ENDPATH**/ ?>