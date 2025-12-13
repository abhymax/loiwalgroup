	<table id="table_block" class="table-box dataTable">
		<thead>
			<tr>
				<th>Email</th>
				<th>Contact Number   </th>
				<th></th>
			
			</tr>
		</thead>
		<tbody>
			<?php $__currentLoopData = $datacontact['contactinfo']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contactinfo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			<tr id="tr_block_<?php echo e($loop->index); ?>">
			    <input type="hidden" name="warehouse_contact_id[]" id="warehouse_contact_id_<?php echo e($loop->index); ?>" value="<?php echo e($contactinfo['warehouse_contact_id']); ?>">
				<td>
					<input type="text" name="contact_email[]" value="<?php echo e($contactinfo['warehouse_contact_email']); ?>"  id="contact_email_<?php echo e($loop->index); ?>" maxlength="20">
				</td>
				<td>
					<input type="text" name="contact_no[]" value="<?php echo e($contactinfo['warehouse_contact_no']); ?>"  id="contact_no_<?php echo e($loop->index); ?>" maxlength="20">
				</td>
				<td><a href="javascript:;" onclick="deleteConfirm(<?php echo e($loop->index); ?>);"><img src="<?php echo e(url('/')); ?>/public/assets/images/delete.svg" style="width: 20px;"></a>
				<div id="delconfirm_<?php echo e($loop->index); ?>" class="slidediv">
					<div class="slidediv-inner">
						<span class="label">
							Would you like to delete?
							<a href="javascript:;" onclick="delcontact(<?php echo e($loop->index); ?>)">Yes</a> | <a href="javascript:;" onclick="closedeldiv(<?php echo e($loop->index); ?>)">No</a>
						</span>
					</div>
				</div></td>
			</tr>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</tbody>
	</table>
	<input type="hidden" value="<?php echo e($datacontact['block_count']); ?>" name="block_count" id="block_count" /><?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/warehouse/warehouse_contact_details.blade.php ENDPATH**/ ?>