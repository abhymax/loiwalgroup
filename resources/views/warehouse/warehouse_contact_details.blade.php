	<table id="table_block" class="table-box dataTable">
		<thead>
			<tr>
				<th>Email</th>
				<th>Contact Number   </th>
				<th></th>
			
			</tr>
		</thead>
		<tbody>
			@foreach($datacontact['contactinfo'] as $contactinfo)
			<tr id="tr_block_{{ $loop->index }}">
			    <input type="hidden" name="warehouse_contact_id[]" id="warehouse_contact_id_{{$loop->index }}" value="{{$contactinfo['warehouse_contact_id']}}">
				<td>
					<input type="text" name="contact_email[]" value="{{$contactinfo['warehouse_contact_email']}}"  id="contact_email_{{ $loop->index }}" maxlength="20">
				</td>
				<td>
					<input type="text" name="contact_no[]" value="{{$contactinfo['warehouse_contact_no']}}"  id="contact_no_{{ $loop->index }}" maxlength="20">
				</td>
				<td><a href="javascript:;" onclick="deleteConfirm({{ $loop->index }});"><img src="{{url('/')}}/public/assets/images/delete.svg" style="width: 20px;"></a>
				<div id="delconfirm_{{ $loop->index }}" class="slidediv">
					<div class="slidediv-inner">
						<span class="label">
							Would you like to delete?
							<a href="javascript:;" onclick="delcontact({{ $loop->index }})">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{ $loop->index }})">No</a>
						</span>
					</div>
				</div></td>
			</tr>
			@endforeach
		</tbody>
	</table>
	<input type="hidden" value="{{$datacontact['block_count']}}" name="block_count" id="block_count" />