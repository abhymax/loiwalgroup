@if(isset($data['categories']) && !empty($data['categories']))
                                <table id="categoryListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['categories'] as $category)
                                            <tr>
                                                <td>{{ $category['category_name'] }}
                                                  
                                                </td>
                                                <td>
                                                    {{ $category['category_description'] }}
                                                  
                                                </td>
												
                                                <td>
                                                    <div>
                                                        <a onclick="editCategory({{$category['category_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/edit.svg">
                                                        </a>
														@if($category['product_count']<=0)
                                                        <a onclick="deleteConfirm({{$category['category_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>
														@endif
                                                    </div>
                                                    <div id="delconfirm_{{$category['category_id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$category['category_id']}}, 'categories', 'categoryListTableDiv', 'categoryListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$category['category_id']}})">No</a>
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