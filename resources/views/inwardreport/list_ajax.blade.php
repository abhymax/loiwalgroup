@if(isset($data['reports']) && !empty($data['reports']))
<form method="post" action="{{ route('inwardreport.export') }}">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>

	<input type="hidden" name="sid" value="{{$data['sid']}}">
	<input type="hidden" name="inv_date" value="{{$data['inv_date']}}">
	<input type="submit" class="btn btn-primary" value="Export Excel">
    </form>
	
	<form method="post" action="{{ route('inwardreport.exportpdf') }}">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>

	<input type="hidden" name="sid" value="{{$data['sid']}}">
	<input type="hidden" name="inv_date" value="{{$data['inv_date']}}">
	<input type="submit" class="btn btn-primary" value="Export PDF">
    </form> 
                                <table id="transferreportListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Recd Date</th>
                                            <th>Doc No</th>
											<th>Source</th>
											<th>Invoice Date</th>
											<th>Product</th>
											<th>Pack</th>
											<th>Total Curtain</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									    @foreach ($data['reports'] as $report)
                                            <tr>
											    <td>
													{{ $report['delivery_date'] }}
                                                </td>
                                                <td>
													{{ $report['invoice_number'] }}
                                                </td>
                                                <td>
													{{ $report['party_name'] }}
                                                </td>
												<td>
                                                    {{ \Carbon\Carbon::parse($report['invoice_date'])->format('d/m/Y')}}
                                                </td>
												<td>
												@foreach ($report['stocktransfermaterial'] as $material)
													{{$material['product_name']}} <br/>
												@endforeach
												</td>
												<td>
												@foreach ($report['stocktransfermaterial'] as $material)
													{{$material['product_sku']}} <br/>
												@endforeach  
												</td>
												<td>
												   {{ $report['stocktransfermaterial_sum_qty']}}
												</td>
											</tr>
                                        @endforeach
								    </tbody>
								</table>
								@else
                                    No Record Found
                                @endif
								
                        