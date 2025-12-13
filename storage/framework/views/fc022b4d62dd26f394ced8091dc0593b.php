<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
 
    <link rel="stylesheet" href="<?php echo e(url('/')); ?>/public/assets/css/pdf.css" type="text/css"> 
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <h2>DISPATCH FOR THE MONTH <?php echo e($invoices['month_yr']); ?> </h2>
            </td>
            <td class="w-half">
                
            </td>
        </tr>
    </table>

    <div class="margin-top">
        <table class="products">
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
			<?php $__currentLoopData = $invoices['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<tr class="items">
               
                    <td>
                        <?php echo e(\Carbon\Carbon::parse($report['invoice_date'])->format('d/m/Y')); ?>

                    </td>
                    <td>
                        <?php echo e($report['invoice_number']); ?>

                    </td>
                    <td>
                        <?php echo e($report['party_name']); ?>

                    </td>
					<td>
                        <?php echo e($report['destination']); ?>

                    </td>
					<td>
                        <?php echo e($report['transport']); ?>

                    </td>
					<td>
                        
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
        </table>
    </div>

</body>
</html><?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/misreport/exportpdf.blade.php ENDPATH**/ ?>