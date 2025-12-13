<?php echo $__env->make('common/admin_inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common/admin_main_navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="fromWrap">
                 
                    <div class="card">
                         <div class="searchFormHeader">
                            <div>
                             <form id="searchmisrport" class="form-horizontal searchForm" enctype="multipart/form-data" autocomplete="off">
                                <div class="row clearfix">
                                   
									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="supplier_id_search">Supplier</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" name="supplier_id_search" id="supplier_id_search">
														    <option value=''>Select</option>
															<?php $__currentLoopData = $data['suppliers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($supplier->supplier_id); ?>"><?php echo e($supplier->supplier_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
														</select>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="supplier_id_search">Report Month</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line" id="bs_datepicker_container">
														<input type="text" id="invoice_date" name="invoice_date" class="form-control" >
													</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-sm-3" style="width: 100%;">
                                                <a class="btn-reset waves-effect" onclick="resetReportSearch()">Reset</a>
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
                            Dispatch Report
                        </h2>
						
                    </div>
                    <div class="body">
                        <div class="table-responsive" id="misreportListTableDiv">
                            <?php if(isset($data['reports']) && !empty($data['reports'])): ?>
								<a class="btn btn-warning" href="<?php echo e(route('misreport.export')); ?>">Export Report</a>
                                <table id="reportListTable" class="table table-hover js-basic-example dataTable">
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
                                        <?php $__currentLoopData = $data['reports']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                </table>
                                <?php else: ?>
                                    No Record Found
                                <?php endif; ?>
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
        $('#reportListTable').DataTable({
            "searching": false,
            "bDestroy": true,
			"paging": false,
			"info": false,
			"lengthChange" : false,
			"bSort":false,
			"aaSorting": []
        });
		$('#invoice_date').datetimepicker({
			useCurrent: true,
			format:'YYYY-MM',
			maxDate: new Date()
		});
		var aLengthMenu = $('select[name=reportListTable_length]');
        $(aLengthMenu).prop('display', 'disabled');
    });
    function navigationActivate() {
        $('#misreport').addClass('active');
    }
</script>
<?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/misreport/list.blade.php ENDPATH**/ ?>