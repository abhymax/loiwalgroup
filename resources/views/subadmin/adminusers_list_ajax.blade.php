@if(isset($data['adminusers']) && !empty($data['adminusers']))
                                <table id="adminusersListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Username</th>
											<th>Email</th>
                                            <th>Status</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['adminusers'] as $adminusers)
                                            <tr>
                                                <td>{{ $adminusers['admin_username'] }}</td>
												<td>{{ $adminusers['admin_email'] }}</td>
												<td>@if($adminusers['is_active']=='Y') Enabled @else Disabled @endif</td>
												<td>
                                                    <div>
                                                        <a onclick="editAdminusers({{$adminusers['admin_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/edit.svg">
                                                        </a>
                                                        <a onclick="deleteConfirm({{$adminusers['admin_id']}})" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>
                                                    </div>
                                                    <div id="delconfirm_{{$adminusers['admin_id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$adminusers['admin_id']}}, 'adminusers', 'adminusersListTableDiv', 'adminusersListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$adminusers['admin_id']}})">No</a>
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
