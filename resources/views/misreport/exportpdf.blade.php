<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
 
    <link rel="stylesheet" href="{{url('/')}}/public/assets/css/pdf.css" type="text/css"> 
</head>
<body>
    <table class="w-full">
        <tr>
            <td class="w-half">
                <h2>DISPATCH FOR THE MONTH {{$invoices['month_yr']}} </h2>
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
			@foreach($invoices['items'] as $report)
				<tr class="items">
               
                    <td>
                        {{ \Carbon\Carbon::parse($report['invoice_date'])->format('d/m/Y')}}
                    </td>
                    <td>
                        {{ $report['invoice_number'] }}
                    </td>
                    <td>
                        {{ $report['party_name'] }}
                    </td>
					<td>
                        {{ $report['destination'] }}
                    </td>
					<td>
                        {{ $report['transport'] }}
                    </td>
					<td>
                        
                    </td>
					<td>
					    {{ \Carbon\Carbon::parse($report['dispatch_date'])->format('d/m/Y')}}
					</td>
					<td>
                        {{ \Carbon\Carbon::parse($report['delivery_date'])->format('d/m/Y')}}
					</td>
					<td>
						{{ $report['remarks'] }}
					</td>
                
            </tr>
			@endforeach
        </table>
    </div>

</body>
</html>