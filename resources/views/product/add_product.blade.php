 								<form id="addProduct" class="form-horizontal" autocomplete="off">
                                    <div class="formwrap">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="category">Category<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control" name="category_id" id="category_id">
															@foreach($data['categories'] as $category)
															<option value="{{$category->category_id}}">{{$category->category_name}}</option>
															@endforeach
															
														</select>  
														
													</div>
													<button id="buttonCat" type="button">Add Category</button>
												</div>
												
												<div id="dialogCat">

												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="category_description">Supplier<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control" name="supplier_id" id="supplier_id">
															@foreach($data['suppliers'] as $supplier)
															<option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
															@endforeach
															
														</select>  
													</div>
													<button id="buttonSupplier" type="button">Add Supplier</button>
												</div>
												<div id="dialogSupplier">

												</div>
											</div>
											
										</div>
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="uom">Unit of Measurement<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<select class="form-control" name="uom_id" id="uom_id">
															@foreach($data['uomall'] as $uom)
															<option value="{{$uom->uom_id}}">{{$uom->uom_name}}</option>
															@endforeach
															
														</select>  
													</div>
													<button id="buttonUom" type="button">Add UOM</button>
												</div>
												<div id="dialogUom">

												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="product_name">Product Name<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="product_name" name="product_name" class="form-control" maxlength="45">
													</div>
												</div>
											</div>
											
										</div>
										<div class="row clearfix">
											
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="product_sku">Product SKU<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="product_sku" name="product_sku" class="form-control" maxlength="20">
													</div>
												</div>
											</div>
											
										</div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-12">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <button class="btn btn-blue btn-common waves-effect" type="submit" id="addbutton">Save</button>
                                        <span class="font-bold col-pink" id="error-msg"></span>
                                        <span class="font-bold col-teal" id="success-msg"></span>
                                        </div>
                                    </div>
                                </form>


<div id="cat_add" style="display:none">
  Category Name:<br/>
  <input type="text" name="category_name" id="category_name">
  <br/>
  <input type="button" value="Save" onclick="saveCat()">
  <span class="font-bold col-pink" id="error-cat"></span>
</div>
<div id="uom_add" style="display:none">
  UOM:<br/>
  <input type="text" name="uom_name" id="uom_name">
  <br/>
  <input type="button" value="Save" onclick="saveUom()">
  <span class="font-bold col-pink" id="error-uom"></span>
</div>
<div id="supplier_add" style="display:none">
  Supplier Number:
  <input type="text" name="supplier_number" id="supplier_number">
  <br/>
  Supplier Name:
  <input type="text" name="supplier_name" id="supplier_name">
  <br/>
  Email:
  <input type="text" name="supplier_email" id="supplier_email">
  <br/>
  Mobile:
  <input type="text" name="supplier_mobile_number" id="supplier_mobile_number">
  <br/>
  <input type="button" value="Save" onclick="saveSupplier()">
  <span class="font-bold col-pink" id="error-supplier"></span>
</div>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
    $(function() {
		$('#addProduct').validate({
			rules: {
				'product_sku': {
					required: true
				},
				'product_name': {
					required: true
				}
			}, 
			messages: {
				product_name: 'Product name required',
				product_sku: 'Product SKU required'
			},
			highlight: function (input) {
				$(input).parents('.form-line').addClass('error');
			},
			unhighlight: function (input) {
				$(input).parents('.form-line').removeClass('error');
			},
			errorPlacement: function (error, element) {
				$(element).parents('.input-group').append(error);
				$(element).parents('.form-group').append(error);
			},
			submitHandler: function(form,e) {
				addProduct();
			}
		});
	});
	$('#buttonCat').click(function() {
	  $("div#cat_add").dialog({
		appendTo: '#dialogCat',
		title: "Add Category"
	  });
	});
	$('#buttonUom').click(function() {
	  $("div#uom_add").dialog({
		appendTo: '#dialogUom',
		title: "Add UOM"
	  });
	});
	$('#buttonSupplier').click(function() {
		$("div#supplier_add").dialog({
		appendTo: '#dialogSupplier',
		title: "Add Supplier"
	  });
	});
</script>