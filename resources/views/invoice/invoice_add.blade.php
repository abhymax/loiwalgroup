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
                                    Add Material In
                                </h2>
                                <a class="btn  btn-blue pull-right" href="{{url('/')}}/materialin">Back</a>
                            </div>
							<div class="body">
                                <form id="addInventory"  class="form-horizontal" enctype="multipart/form-data" autocomplete="off">
                                    <div class="">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="po">Invoice Number #<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="invoice_number" name="invoice_number" class="form-control" maxlength="30">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="supplier_address">Principal<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
                                                        <select class="form-control" name="supplier_id" id="supplier_id">
														    <option value="">Select</option>
															@foreach($data['suppliers'] as $supplier)
															<option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
															@endforeach
															
														</select>  
													</div>
												</div>
											</div>
											
										</div>
										<div class="row clearfix">
										   
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Invoice Date<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line" id="bs_datepicker_container">
														<input type="text" id="invoice_date" name="invoice_date" class="form-control" >
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Receive Date<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line" id="bs_datepicker_container">
														<input type="text" id="receive_date" name="receive_date" class="form-control" >
													</div>
												</div>
											</div>
										</div>
									    <div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Transport Document Number<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="transport_document_number" name="transport_document_number" class="form-control" >
													</div>
												</div>
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
															<input type="hidden" name="material_id_{{$loop->index }}" id="material_id_{{$loop->index }}" value="{{$podinfo['material_id']}}">
															
															<td>
															    <select name="product_id_{{$loop->index}}" id="product_id_{{$loop->index}}" class="product_name" onchange="getSku({{$loop->index}})">
																<option value="">Select</option>
																</select>
																
															</td>
															<td>
																<input type="text" name="product_sku_{{ $loop->index }}" value="{{$podinfo['product_sku']}}" readonly id="product_sku_{{ $loop->index }}" maxlength="20">
															</td>
															<td>
																<input type="text" name="batch_no_{{ $loop->index }}" id="batch_no_{{ $loop->index }}" value="{{$podinfo['batch_no']}}" onchange="calculateLeft()" maxlength="10">
															</td>
															<td>
																<input type="text" name="description_{{ $loop->index }}" id="paid_amount_{{ $loop->index }}" value="{{$podinfo['description']}}" maxlength="50">
															</td>
															<td>
																<input type="number" name="qty_{{ $loop->index }}" value="{{$podinfo['qty']}}" onkeypress="return event.charCode >= 48" min="1" onchange="calculateAmt({{ $loop->index }})" id="qty_{{ $loop->index }}"  maxlength="50">
															</td>
															<td>
																<input type="number" name="rate_{{ $loop->index }}" value="{{$podinfo['rate']}}" maxlength="20" id="rate_{{ $loop->index }}" onchange="calculateAmt({{ $loop->index }})">
															</td>
															<td>
																<input type="text" name="amount_{{ $loop->index }}" value="{{$podinfo['amount']}}" maxlength="50" id="amount_{{ $loop->index }}" class="amount" readonly>
															</td>
															<td>
																<input type="text" name="manufacturing_date_{{ $loop->index }}" value="{{$podinfo['manufacturing_date']}}" maxlength="20" class="payment_info_date">
															</td>
															<td>
																<input type="text" name="expiry_date_{{ $loop->index }}" value="{{$podinfo['expiry_date']}}" maxlength="20" class="payment_info_date">
															</td>
														</tr>
														@endforeach
													</tbody>
												</table>
												<input type="hidden" value="{{$data['block_count']}}" name="block_count" id="block_count" />

											</div>
											
                                        </div>
										<div class="row clearfix add-more-box">
                                            <a class="btn-common" onclick="addblock()"> Add More</a>
                                            
                                        </div>
										<div class="row clearfix">
											<div class="col-lg-6 col-md-2 col-sm-4 col-xs-5 form-control-label">
											&nbsp;
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="container">Total Amount (&#8377; )</label>
											</div>
											<div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="total_amount" name="total_amount" readonly class="form-control" >
													</div>
												</div>
											</div>
										</div>
                                    </div>
									
									
                                    <div class="row clearfix form-horizontal">
                                        <div class="col-lg-12">
										
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <button class="btn btn-blue btn-common waves-effect" type="submit" id="addbutton" onclick="test()">Save</button>
										
                                        <span class="font-bold col-pink" id="error-msg"></span>
                                        <span class="font-bold col-teal" id="success-msg"></span>
                                        </div>
                                    </div>
								</form>
                                
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
