@if(isset($data['invoices']) && !empty($data['invoices']))
                                <table id="invoiceListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Invoice Date</th>
											<th>Dispatch Date</th>
											<th>Supplier</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['invoices'] as $invoice)
                                            <tr>
                                                <td>
													{{ $invoice['invoice_number'] }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($invoice['invoice_date'])->format('d/m/Y')}}
                                                </td>
												<td>
                                                    {{ \Carbon\Carbon::parse($invoice['dispatch_date'])->format('d/m/Y')}}
                                                </td>
												<td>
                                                    {{ $invoice['supplier']['supplier_name'] }}
                                                </td>
												
                                                <td>
                                                    <div>
                                                        <a  href="{{url('/')}}/materialin/view/{{$invoice['id']}}" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/view.svg" title="view">
                                                        </a>
														
                                                        <!--<a onclick="deleteConfirm({{$invoice['id']}})" style="cursor:pointer; text-decoration: none">
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>-->
														
                                                    </div>
                                                    <!--<div id="delconfirm_{{$invoice['id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$invoice['id']}}, 'materialin', 'invoiceListTableDiv', 'invoiceListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$invoice['id']}})">No</a>
                                                            </span>
                                                        </div>
                                                    </div>-->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    No Record Found
                                @endif