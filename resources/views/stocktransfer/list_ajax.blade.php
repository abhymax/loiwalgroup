@if(isset($data['stocktransfers']) && !empty($data['stocktransfers']))
	<table id="transferListTable" class="table table-hover js-basic-example dataTable">
		<thead>
			<tr>
				<th>Number</th>
				<th>Invoice Date</th>
				<th>Dispatch Date</th>
				<th>Principal</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($data['stocktransfers'] as $stocktransfer)
				<tr>
					<td>
						{{ $stocktransfer['invoice_number'] }}
					</td>
					<td>
						{{ \Carbon\Carbon::parse($stocktransfer['invoice_date'])->format('d/m/Y')}}
					</td>
					<td>
						{{ \Carbon\Carbon::parse($stocktransfer['dispatch_date'])->format('d/m/Y')}}
					</td>
					<td>
						{{ $stocktransfer['supplier']['supplier_name'] }}
					</td>
					
					<td>
						<div>
							<a  href="{{url('/')}}/stocktransfer/view/{{$stocktransfer['stock_transfer_id']}}" style="cursor:pointer; text-decoration: none">
								<img src="{{url('/')}}/public/assets/images/view.svg" title="view">
							</a>
							
						
							
						</div>
						
					</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@else
	No Record Found
@endif
