@if(isset($data['reports']) && !empty($data['reports']))
	<form method="post" action="{{ route('misreport.export') }}">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>

	<input type="hidden" name="sid" value="{{$data['sid']}}">
	<input type="hidden" name="inv_date" value="{{$data['inv_date']}}">
	<input type="submit" class="btn btn-primary" value="Export Excel">
    </form>
	
	<form method="post" action="{{ route('exportpdf') }}">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>

	<input type="hidden" name="sid" value="{{$data['sid']}}">
	<input type="hidden" name="inv_date" value="{{$data['inv_date']}}">
	<input type="submit" class="btn btn-primary" value="Export PDF">
    </form>
                                <table id="reportListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Doc No</th>
											<th>Source</th>
											<th>Destination</th>
											<th>Transport Name</th>
											<th>Quantity</th>
											<th>Dispatch Date</th>
											<th>Delivery Date</th>
											<th>Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['reports'] as $report)
                                            <tr>
											    <td>
                                                    {{ \Carbon\Carbon::parse($report['invoice_date'])->format('d/m/Y')}}
                                                </td>
                                                <td>
													{{ $report['invoice_number'] }}
                                                </td>
                                                <td>
                                                    ABC
                                                </td>
												<td>
                                                    {{ $report['party_name'] }}
                                                </td>
												<td>
                                                    {{ $report['transport'] }}
                                                </td>
												<td>
                                                    {{ $report['materialout_sum_qty']}}
                                                </td>
												<td>
                                                   {{ \Carbon\Carbon::parse($report['dispatch_date'])->format('d/m/Y')}}
                                                </td>
                                                <td>
                                                   {{ \Carbon\Carbon::parse($report['delivery_date'])->format('d/m/Y')}}
                                                </td>
												<td>
                                                    {{ $report['remarks'] }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    No Record Found
                                @endif
							
