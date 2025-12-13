@if(isset($data['suppliers']) && !empty($data['suppliers']))
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
	@foreach ($data['suppliers'] as $supplier)
		<tr>
			<td>
				{{ $supplier['supplier_number'] }}
			</td>
			<td>
				{{ $supplier['supplier_name'] }}
			</td>
			<td>
				{{ $supplier['supplier_email'] }}
			</td>
			<td>
				{{ $supplier['supplier_mobile_number'] }}
			</td>
		</tr>
	 @endforeach
	</tbody>
</table>	
 @else
	No Record Found
@endif	
	
	