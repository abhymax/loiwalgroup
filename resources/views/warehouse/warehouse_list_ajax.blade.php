@if(isset($data['warehouses']) && !empty($data['warehouses']))
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
                                        @foreach ($data['warehouses'] as $warehouse)
                                            <tr>
                                                <td><a href="javascript:;" class="wname" id="{{$warehouse['warehouse_id']}}" style="text-decoration: underline; color: blue">{{ $warehouse['warehouse_name'] }}</a>
                                                  
                                                </td>
                                                <td>
                                                    {{ $warehouse['warehouse_email'] }}
                                                  
                                                </td>
												<td>
                                                    {{ $warehouse['warehouse_contact_number'] }}
                                                  
                                                </td>
												<td>
                                                    {{ $warehouse['warehouse_address'] }}
                                                  
                                                </td>
												
                                                <td>
                                                    <div>
                                                        <a onclick="editWarehouse({{$warehouse['warehouse_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/edit.svg">
                                                        </a>
                                                        @if($warehouse['supplier_count']<=0)
                                                        <a onclick="deleteConfirm({{$warehouse['warehouse_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>
														@endif
                                                    </div>
                                                    <div id="delconfirm_{{$warehouse['warehouse_id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$warehouse['warehouse_id']}}, 'warehouses', 'warehouseListTableDiv', 'warehouseListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$warehouse['warehouse_id']}})">No</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    No Record Found
                                @endif
								
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
</script>