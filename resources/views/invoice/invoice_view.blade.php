@include('common/admin_inner_header')
@include('common/admin_main_navbar')
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
		<div class="row clearfix">
            <div>
				<div class="box col-lg-6 right-panel-big" style="width:100% !important;">
                    <div class="card innerCards">
                        <div>
                            <div class="header">
                                <h2>
                                    View Material In
                                </h2>
                                <a class="btn  btn-blue pull-right" href="{{url('/')}}/materialin">Back</a>
                            </div>
							<div class="body">
                                
                                    <div class="">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="po">Invoice Number #</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												{{$data['invoiceinfo']->invoice_number}}
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="supplier_address">Supplier</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												
                                                {{$data['invoiceinfo']['supplier']->supplier_name}}  
													
											</div>
											
										</div>
										
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Invoice Date</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												{{ \Carbon\Carbon::parse($data['invoiceinfo']->invoice_date)->format('d/m/Y')}}
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Receive Date</label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												{{ \Carbon\Carbon::parse($data['invoiceinfo']->receive_date)->format('d/m/Y')}}
											</div>
										</div>
									    
										<div id="upload-files-pdf"></div>
										<div class="row clearfix">
											<div class="col-lg-12" id="pod_block">
												<table id="table_block" class="table-box dataTable">
													<thead>
														<tr>
															<th>Product</th>
															<th>SKU</th>
															<th>Batch No.</th>
															<th>Description</th>
															<th>Qty</th>
															<th>Rate (&#8377;)</th>
															<th>Amount (&#8377;)</th>
															<th>Manufacturing Date</th>
															<th>Best Before Date</th>
															
														</tr>
													</thead>
													<tbody>
														@foreach($data['podinfo'] as $podinfo)
														<tr id="tr_block_{{ $loop->index }}">
															<td>
															    {{$podinfo['product']->product_name}}
																
															</td>
															<td>
																{{$podinfo['product_sku']}}
															</td>
															<td>
																{{$podinfo['batch_no']}}
															</td>
															<td>
																{{$podinfo['description']}}
															</td>
															<td>
																{{$podinfo['qty']}}
															</td>
															<td>
																{{$podinfo['rate']}}
															</td>
															<td>
																{{$podinfo['amount']}}
															</td>
															<td>
																@if($podinfo['manufacturing_date']!=''){{ \Carbon\Carbon::parse($podinfo['manufacturing_date'])->format('m/d/Y')}}@endif
															</td>
															<td>
																@if($podinfo['expiry_date']!=''){{ \Carbon\Carbon::parse($podinfo['expiry_date'])->format('m/d/Y')}}@endif
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
												

											</div>
											
                                        </div>
										
										<div class="row clearfix">
											<div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
											&nbsp;
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5">
												<label for="container">Total Amount (&#8377; )</label>
											</div>
											<div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
												
												{{$data['invoiceinfo']->total_amount}}  	
											</div>
										</div>
                                    </div>
									
									
                                    <div class="row clearfix form-horizontal">
                                        <div class="col-lg-12">
                                        <span class="font-bold col-pink" id="error-msg"></span>
                                        <span class="font-bold col-teal" id="success-msg"></span>
                                        </div>
                                    </div>
								
                                
                            </div>
                        </div>
					</div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('common/admin_inner_footer')

<link src="{{url('/')}}/public/assets/css/bootstrap-datetimepicker.css">
<script src="{{url('/')}}/public/assets/js/moment.js"></script>
<script src="{{url('/')}}/public/assets/js/bootstrap-datetimepicker.js"></script>

<script type="text/javascript">
    $(function () {
        navigationActivate();
		$('.payment_info_date,#receive_date,#invoice_date').datetimepicker({
			useCurrent: false,
			format:'YYYY-MM-DD'
		});
		
		$("#supplier_id").on('change', function() {
			var sid = $(this).val();
				if(sid){
					$.ajax ({
						type: 'GET',
						url: site_url+'/materialin/getproduct/'+sid,
						success : function(htmlresponse) {
							$('.product_name').html(htmlresponse);
							console.log(htmlresponse);
						}
					});
				}
		});
    });
    function navigationActivate() {
        $('#materialin').addClass('active');
    }
	
</script>
