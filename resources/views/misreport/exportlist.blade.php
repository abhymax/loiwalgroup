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
			@foreach ($invoices as $report)
				<tr>
					<td>
						{{ \Carbon\Carbon::parse($report['invoice_date'])->format('d/m/Y')}}
					</td>
					<td>
						{{ $report['invoice_number'] }}
					</td>
					<td>
						ABC
					</td>
					<td>
						{{ $report['party_name'] }}
					</td>
					<td>
						{{ $report['transport'] }}
					</td>
					<td>
						{{ $report['materialout_sum_qty']}}
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
		</tbody>
	</table>