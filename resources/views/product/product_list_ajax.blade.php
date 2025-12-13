@if(isset($data['products']) && !empty($data['products']))
                                <table id="productListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
										    
                                            <th>Name</th>
                                            <th>SKU #</th>
											<th>Supplier</th>
											<th>Action</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['products'] as $product)
                                            <tr>
											    
                                                <td>
                                                    {{ $product['product_name'] }}
                                                </td>
                                                <td>
                                                    {{ $product['product_sku'] }}
                                                </td>
												<td>
                                                    {{ $product['supplier']['supplier_name'] }}
                                                </td>
                                                <td>
                                                    <div>
                                                        <a onclick="editShipment({{$product['product_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/edit.svg">
                                                        </a>
                                                        <a onclick="deleteConfirm({{$product['product_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>
                                                    </div>
                                                    <div id="delconfirm_{{$product['product_id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$product['product_id']}}, 'products', 'productListTableDiv', 'productListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$product['product_id']}})">No</a>
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