$(function () {
    
    // Inventory add start
	
       $('#addMaterialout').validate({
        rules: {
            'party_name': {
                required: true
            },
            'supplier_id': {
                required: true
            },
            'destination': {
                required: true
            },
            'district_id': {
                required: true
            },
			'invoice_number': {
                required: true
            },
			'invoice_date': {
                required: true
            },
			'transport': {
                required: true
            },
			'dispatch_date': {
                required: true
            },
			'delivery_date': {
                required: true
            }

        },
        messages: {
			party_name: 'Party name required',
			destination: 'Destination required',
			district_id: 'District required',
            invoice_number: 'Invoice number required',
            supplier_id: 'Supplier is required',
            invoice_date: 'Invoice date required',
			dispatch_date: 'Dispatch date required',
			transport: 'Transport required',
			delivery_date: 'Delivery date required'
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
            addMaterialOut();
        }
       });
	
    // Inventory add end

    // Building update start
    $('#editinventory').validate({
        rules: {
            'inv_po': {
                required: true
            },
            'inv_date_of_arr': {
                required: true
            },
            'inv_container': {
                required: true
            },
            'inv_cust_name': {
                required: true
            },
			'inv_tot_pieces': {
                required: true
            },
			'inv_weight': {
                required: true
            },
			'inv_description': {
				required: true
			}
        },
        messages: {
            inv_po: 'PO # is required',
            inv_date_of_arr: 'This field is required',
            inv_container: 'Container # is required',
			inv_cust_name: 'Customer Name is required',
			inv_tot_pieces: 'Total pieces received is required',
			inv_weight: 'Weight is required',
			inv_description: 'Description is required',
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
            updateInventory();
        }
    });
    // Building update end
    $('#searchmaterialout').validate({
        
        submitHandler: function(form,e) {
            searchData('materialout', 'searchmaterialout', 'materialoutListTableDiv', 'invoiceListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
  
});

function addMaterialOut(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addMaterialout')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/materialout',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
              //  reloadList('inventory', 'inventoryListTableDiv', 'inventoryListTable');
            }
            else{
                $("#error-msg").css("display", "block");
                $('#error-msg').text('Please fill form properly');
            }
            setTimeout(function(){
                $("#success-msg").css("display", "none");
                $("#error-msg").css("display", "none");
				window.location.href = site_url+'/materialout';
              //  editBulding(response.data.id);
            }, 3000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
}


function  getDetails(id)
{
	
	$('#product_sku_'+id).val($("#product_id_"+id+" option:selected" ).attr('prodsku'));
	
	var selected_product = $("#product_id_"+id+" option:selected" ).val();
	
	if(selected_product){
		$.ajax ({
			type: 'GET',
			url: site_url+'/materialout/getstock/'+selected_product,
			success : function(htmlresponse) {
				$('#batch_no_'+id).html(htmlresponse);
				console.log(htmlresponse);
			}
		});
	}
}
function  getRate(id)
{
	
	$('#qty_'+id).attr('max',$("#batch_no_"+id+" option:selected" ).attr('available'));
   // $('#rate_'+id).val($("#batch_no_"+id+" option:selected" ).attr('rate'));
	
}
function addnewBlock()
{
	
	var cur_block=parseInt($('#block_count').val());
	var new_block_id=cur_block;
	
	/*$('#table_block').append('<tr id="tr_block_'+new_block_id+'"><td><input type="text" name="pod_dep_date_'+new_block_id+'" class="payment_info_date"></td><td><input type="text" name="product_sku_'+new_block_id+'" value=""/></td><td><input type="text" name="batch_no_'+new_block_id+'" id="batch_no_'+new_block_id+'" value="" onchange="calculateLeft()" class="pod_pieces"  /></td><td><input type="text" name="description_'+new_block_id+'"  value="" /></td><td><input type="text" name="qty_'+new_block_id+'"  value="" /></td><td><input type="text" name="rate_'+new_block_id+'" value="" /></td><td><input type="text" name="amount_'+new_block_id+'" value="" /></td><td><input type="text" value="" name="manufacturing_date_'+new_block_id+'" id="payment_details_id_'+new_block_id+'" /></td><td><input type="text" name="expiry_date_'+new_block_id+'" ></td><td><input type="hidden" name="pod_id_'+new_block_id+'" id="pod_id_'+new_block_id+'" value=""><a href="javascript:;" onclick="deleteConfirm(\''+new_block_id+'\');"><img src="public/assets/images/delete.svg" style="width: 20px;"></a><div id="delconfirm_'+new_block_id+'" class="slidediv"><div class="slidediv-inner"><span class="label">Would you like to delete?<a href="javascript:;" onclick="delpod(\''+new_block_id+'\');">Yes</a> | <a href="javascript:;" onclick="closedeldiv(\''+new_block_id+'\')">No</a></span></div></div></td></tr>');*/
	$('#table_block').append('<tr id="tr_block_'+new_block_id+'"><td><input type="hidden" name="material_id_'+new_block_id+'" id="material_id_'+new_block_id+'" value=""><select name="product_id_'+new_block_id+'" id="product_id_'+new_block_id+'" class="product_name" onchange="getDetails('+new_block_id+')"><option value="">Select</option></select></td><td><input type="text" name="product_sku_'+new_block_id+'" id="product_sku_'+new_block_id+'" value="" readonly/></td><td><select name="batch_no_'+new_block_id+'" id="batch_no_'+new_block_id+'" onchange="getRate('+new_block_id+')"><option value="">Select</option></select></td><td><input type="number" onkeypress="return event.charCode >= 48" min="1"  name="qty_'+new_block_id+'"  value="" onchange="calculatePrice('+new_block_id+')" id="qty_'+new_block_id+'" /></td><td><input type="text" name="rate_'+new_block_id+'" value="" id="rate_'+new_block_id+'" onchange="calculatePrice('+new_block_id+')" /></td><td><input type="text" name="amount_'+new_block_id+'" value="" id="amount_'+new_block_id+'" class="amount" readonly /></td></tr>');
	
	$('#block_count').val(new_block_id+1);
	
	if($("#supplier_id").val()!='')
	{
		var sid = $("#supplier_id").val();
		if(sid){
			$.ajax ({
				type: 'GET',
				url: site_url+'/materialout/getproduct/'+sid,
				success : function(htmlresponse) {
					$('#product_id_'+new_block_id).html(htmlresponse);
					console.log(htmlresponse);
				}
			});
		}
	}
}
function calculatePrice(id)
{
	var pamt = $('#rate_'+id).val();
	var qty = $('#qty_'+id).val();
	if(pamt!='' && qty!='')
	{
		$('#amount_'+id).val((pamt*qty).toFixed(2));
	} else {
		$('#amount_'+id).val('');
	}
	calculateTotalamt();
}
function calculateTotalamt()
{
	
	var pamt = document.getElementsByClassName("amount");
	var total_amt = 0.00;
	for(var i=0; i<pamt.length; i++)
	{
		if($("#amount_"+i).val()!='')
		{
		    var amt =  $("#amount_"+i).val();
			
			total_amt = parseFloat(total_amt)+parseFloat(amt);
			
		}
	}
	$('#total_amount').val(total_amt.toFixed(2));
	
}
function calculateLeft()
{
    var pamt = document.getElementsByClassName("pod_pieces");
	var total_pieces = 0.00;
	for(var i=0; i<pamt.length; i++)
	{
		if($("#pod_pieces_ship_"+i).val()!='')
		{
		    var amt =  $("#pod_pieces_ship_"+i).val();
			
			total_pieces = parseFloat(total_pieces)+parseFloat(amt);
			
		}
	}
	
	var total_received = $("#inv_tot_pieces_edit").val();
	var left_pieces = parseFloat(total_received) - parseFloat(total_pieces);
	
	
	$('#inv_tot_piece_left_edit').val(left_pieces);
}