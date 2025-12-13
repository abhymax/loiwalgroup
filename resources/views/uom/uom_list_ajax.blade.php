@if(isset($data['uomall']) && !empty($data['uomall']))
                                <table id="uomListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>UOM</th>
                                            <th>Description</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['uomall'] as $uom)
                                            <tr>
                                                <td>{{ $uom['uom_name'] }}
                                                  
                                                </td>
                                                <td>
                                                    {{ $uom['uom_description'] }}
                                                  
                                                </td>
												
                                                <td>
                                                    <div>
                                                        <a onclick="editUom({{$uom['uom_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/edit.svg">
                                                        </a>
														@if($uom['product_count']<=0)
                                                        <a onclick="deleteConfirm({{$uom['uom_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>
														@endif
                                                    </div>
                                                    <div id="delconfirm_{{$uom['uom_id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$uom['uom_id']}}, 'uom', 'uomListTableDiv', 'uomListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$uom['uom_id']}})">No</a>
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