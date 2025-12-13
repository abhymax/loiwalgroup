@include('common/admin_inner_header')
@include('common/admin_main_navbar')
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="fromWrap">
                 <button type="button" class="btn btn-common btn-blue collapseBtn" data-toggle="collapse" data-target="#demo"><i class="material-icons">search</i></button>
                    <div class="card">
                         <div class="searchFormHeader">
                            <div id="demo" class="collapse">
                             <form id="searchproduct" class="form-horizontal searchForm" autocomplete="off">
                                
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                            <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="name_search">Name</label>
                                            </div>
                                            <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="product_name_search" name="product_name_search" class="form-control" maxlength="25">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>

                                    <div class="col-sm-4">
                                            <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="sku_search">SKU#</label>
                                            </div>
                                            <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="product_sku_search" name="product_sku_search" class="form-control" maxlength="25">
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    
                                    <div class="col-sm-4">
                                            <div class="col-lg-5 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                            <label for="supplier_search">Supplier</label>
                                            </div>
                                            <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" name="supplier_id_search" id="supplier_id_search" >
                                                        <option value="">All</option>
                                                        @foreach($data['suppliers'] as $supplier)
															<option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
														@endforeach
                                                        </select>
                                                    </div>
                                                </div>  
                                            </div>
                                    </div>
                                    
                                </div>

                                    
                                   <div class="row clearfix">
                                        <div class="col-sm-3" style="width: 100%;">
                                            <a class="btn-reset waves-effect" onclick="resetProductSearch()">Reset</a>
                                            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                            <button class="btn btn-blue btn-common  waves-effect" type="submit" id="addbutton">Search</button>
                                        </div>
                                   </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="contentInner">
                <div class="col-lg-12 innerCards" id="content-area">
                    <div class="card">
                    <div class="header">
                        <h2>
                            Products
                        </h2>
						<a class="btn btn-default btn-common waves-effect pull-right slide-right" onclick="showForm()">Add Product</a>
						
                    </div>
					<!--<button class="btn btn-primary btn-xs removeAll pull-right">Delete</button>-->
                    <div class="body">
					    
                        <div class="table-responsive" id="productListTableDiv">
                            @if(isset($data['products']) && !empty($data['products']))
                                <table id="productListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
										    
                                            <th>Name</th>
                                            <th>SKU #</th>
											<th>Supplier #</th>
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
                        </div>
                    </div>
                    </div>
                </div>

                <div class="box col-lg-6 right-panel-big" style="width:100% !important;">
                    <div class="card innerCards">
                        <div id="addpanel">
                            <div class="header">
                                <h2>
                                    Add Product
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body" id="add-form">
                               
                            </div>
                        </div>
                        <div id="editpanel">
                            <div class="header">
                                <h2>
                                    Edit Product
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body" id="edit-form">
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('common/admin_inner_footer')


<script src="{{url('/')}}/public/assets/js/product.js"></script>
<script type="text/javascript">
    $(function () {
        navigationActivate();
	
        
        $('#productListTable').DataTable({
            "searching": false,
            "bDestroy": true
            
        });
		
    });
    function navigationActivate() {
       
	    $('#shipmentmenu').addClass('toggled');
	    $('#shipmentmenuul').show();
		$('#product').addClass('active');
    }
</script>
