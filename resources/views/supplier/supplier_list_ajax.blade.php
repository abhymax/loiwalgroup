@if(isset($data['suppliers']) && !empty($data['suppliers']))
                                <table id="supplierListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Name</th>
											<th>Warehouse</th>
											<th>Email</th>
											<th>Mobile Number</th>
											<th>Action</th>
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
                                                    {{ $supplier['warehouse']['warehouse_name'] }}
                                                </td>
												<td>
                                                    {{ $supplier['supplier_email'] }}
                                                </td>
												<td>
                                                    {{ $supplier['supplier_mobile_number'] }}
                                                </td>
                                                <td>
                                                    <div>
                                                        <a onclick="editSupplier({{$supplier['supplier_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/edit.svg">
                                                        </a>
														@if($supplier['product_count']<=0) 
                                                        <a onclick="deleteConfirm({{$supplier['supplier_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>
														@endif
                                                    </div>
                                                    <div id="delconfirm_{{$supplier['supplier_id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$supplier['supplier_id']}}, 'suppliers', 'supplierListTableDiv', 'supplierListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$supplier['supplier_id']}})">No</a>
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