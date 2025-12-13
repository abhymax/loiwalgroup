<?php echo $__env->make('common/admin_inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php echo $__env->make('common/admin_main_navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="fromWrap">
                 <button type="button" class="btn btn-common btn-blue collapseBtn" data-toggle="collapse" data-target="#demo"><i class="material-icons">search</i></button>
                    <div class="card">
                         <div class="searchFormHeader">
                            <div id="demo" class="collapse">
                             <form id="searchmaterialout" class="form-horizontal searchForm" enctype="multipart/form-data" autocomplete="off">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="invoice_number_search">Number</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="invoice_number_search" name="invoice_number_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="supplier_id_search">Supplier</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" name="supplier_id_search" id="supplier_id_search">
														    <option value=''>All</option>
															<?php $__currentLoopData = $data['suppliers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
															<option value="<?php echo e($supplier->supplier_id); ?>"><?php echo e($supplier->supplier_name); ?></option>
															<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
															
														</select>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									
								</div>
								<div class="row clearfix">
										<div class="col-sm-4">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="date_type_search">Invoice Date</label>
                                            </div>
                                            <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="input-daterange input-group">
                                                    <div class="col-md-6">
                                                        <div class="form-line">
                                                        <input type="text" id="fromdate" name="from_date" class="form-control" maxlength="10" placeholder="From" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-line">
                                                        <input type="text" id="todate" name="to_date" class="form-control" maxlength="10" placeholder="To" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-sm-3" style="width: 100%;">
                                                <a class="btn-reset waves-effect" onclick="resetInvoiceSearch()">Reset</a>
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
                            Material Out
                        </h2>
						<a class="btn btn-default btn-common waves-effect pull-right" href="<?php echo e(url('/')); ?>/materialout/add">Add Record</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive" id="materialoutListTableDiv">
                            <?php if(isset($data['invoices']) && !empty($data['invoices'])): ?>
                                <table id="materialoutListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Invoice Date</th>
											<th>Dispatch Date</th>
											<th>Supplier</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data['invoices']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
													<?php echo e($invoice['invoice_number']); ?>

                                                </td>
                                                <td>
                                                    <?php echo e(\Carbon\Carbon::parse($invoice['invoice_date'])->format('d/m/Y')); ?>

                                                </td>
												<td>
                                                    <?php echo e(\Carbon\Carbon::parse($invoice['dispatch_date'])->format('d/m/Y')); ?>

                                                </td>
												<td>
                                                    <?php echo e($invoice['supplier']['supplier_name']); ?>

                                                </td>
												
                                                <td>
                                                    <div>
                                                        <a  href="<?php echo e(url('/')); ?>/materialout/view/<?php echo e($invoice['id']); ?>" style="cursor:pointer; text-decoration: none">
                                                            <img src="<?php echo e(url('/')); ?>/public/assets/images/view.svg" title="view">
                                                        </a>
														
                                                        <!--<a onclick="deleteConfirm(<?php echo e($invoice['id']); ?>)" style="cursor:pointer; text-decoration: none">
                                                             <img src="<?php echo e(url('/')); ?>/public/assets/images/delete.svg">
                                                        </a>-->
														
                                                    </div>
                                                    <!--<div id="delconfirm_<?php echo e($invoice['id']); ?>" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord(<?php echo e($invoice['id']); ?>, 'materialin', 'invoiceListTableDiv', 'invoiceListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv(<?php echo e($invoice['id']); ?>)">No</a>
                                                            </span>
                                                        </div>
                                                    </div>-->
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
        $('#invoiceListTable').DataTable({
            "searching": false,
            "bDestroy": true
        });
		$('#fromdate,#todate').datetimepicker({
			useCurrent: false,
			format:'YYYY-MM-DD'
		});
		$('#fromdate').datetimepicker().on('dp.change', function (e) {
            var incrementDay = moment(new Date(e.date));
            incrementDay.add(1, 'days');
            $('#todate').data('DateTimePicker').minDate(incrementDay);
            $(this).data("DateTimePicker").hide();
        });

        $('#todate').datetimepicker().on('dp.change', function (e) {
            var decrementDay = moment(new Date(e.date));
            decrementDay.subtract(1, 'days');
            $('#fromdate').data('DateTimePicker').maxDate(decrementDay);
            $(this).data("DateTimePicker").hide();
        });
    });
    function navigationActivate() {
        $('#materialout').addClass('active');
    }
</script>
<?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/invoiceout/list.blade.php ENDPATH**/ ?>