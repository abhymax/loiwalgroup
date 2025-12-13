<?php if(isset($data['warehouses']) && !empty($data['warehouses'])): ?>
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
                                        <?php $__currentLoopData = $data['warehouses']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $warehouse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><a href="javascript:;" class="wname" id="<?php echo e($warehouse['warehouse_id']); ?>" style="text-decoration: underline; color: blue"><?php echo e($warehouse['warehouse_name']); ?></a>
                                                  
                                                </td>
                                                <td>
                                                    <?php echo e($warehouse['warehouse_email']); ?>

                                                  
                                                </td>
												<td>
                                                    <?php echo e($warehouse['warehouse_contact_number']); ?>

                                                  
                                                </td>
												<td>
                                                    <?php echo e($warehouse['warehouse_address']); ?>

                                                  
                                                </td>
												
                                                <td>
                                                    <div>
                                                        <a onclick="editWarehouse(<?php echo e($warehouse['warehouse_id']); ?>)" style="cursor:pointer; text-decoration: none">
                                                            <img src="<?php echo e(url('/')); ?>/public/assets/images/edit.svg">
                                                        </a>
                                                        <a onclick="deleteConfirm(<?php echo e($warehouse['warehouse_id']); ?>)" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="<?php echo e(url('/')); ?>/public/assets/images/delete.svg">
                                                        </a>
                                                    </div>
                                                    <div id="delconfirm_<?php echo e($warehouse['warehouse_id']); ?>" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord(<?php echo e($warehouse['warehouse_id']); ?>, 'warehouses', 'warehouseListTableDiv', 'warehouseListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv(<?php echo e($warehouse['warehouse_id']); ?>)">No</a>
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

<script type="text/javascript">
    
	$('.wname').on('click',function(){
		var id = $(this).attr('id');
		$('.modal-body').load(site_url+'/getsupplier/'+id,function(){
			$('#myModal').modal({show:true});
		});
	});
</script><?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/warehouse/warehouse_list_ajax.blade.php ENDPATH**/ ?>