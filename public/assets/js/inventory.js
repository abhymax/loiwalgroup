$(function () {
    
    // Inventory add start
	
       $('#addInventory').validate({
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
            addInventory();
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

    // Shipper search start
    $('#searchinventory').validate({
        
        submitHandler: function(form,e) {
            searchData('inventory', 'searchinventory', 'inventoryListTableDiv', 'inventoryListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Shipper search end

    
});
function test()
{
	$("#addInventory").submit();
}
function update()
{
	$("#editinventory").submit();
}
function showAdd(){
    $('.process-loader-wrapper').show();
	$('#pod_block_edit').html('');
   // $('#edit-form').html('');
    $.ajax({
        type: 'GET',
        url: site_url+'/inventoryfile',
        success: function(response){
            $('.process-loader-wrapper').hide();
            $('#upload-file').html(response.file_upload);
            $('#pod_block').html(response.pod_details);
        }
    });

}
function addInventory(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addInventory')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/inventory',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                reloadList('inventory', 'inventoryListTableDiv', 'inventoryListTable');
            }
            else{
                $("#error-msg").css("display", "block");
                $('#error-msg').text('Please fill form properly');
            }
            setTimeout(function(){
                $("#success-msg").css("display", "none");
                $("#error-msg").css("display", "none");
                editBulding(response.data.id);
            }, 3000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
}

function updateInventory(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    
    let formData = new FormData($('#editinventory')[0]);

    /*let name = $('#name_edit').val();
    let street = $('#street_edit').val();
    let city = $('#city_edit').val();
    let postal_code = $('#postal_code_edit').val();
    let state_id = $('#state_id_edit').val();*/

    let _token = $('input[id="_token_edit"]').val();
    let id = $('#inv_id').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/inventory/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('inventory', 'inventoryListTableDiv', 'inventoryListTable');
            }
            else{
                $("#error-msg-edit").css("display", "block");
                $('#error-msg-edit').text('Please fill form properly');
            }
            setTimeout(function(){
                $("#success-msg-edit").css("display", "none");
                $("#error-msg-edit").css("display", "none");
            }, 3000);
            $('.process-loader-wrapper').hide();
            $('#editbutton').removeAttr("disabled");
        },
        error: function(response){
            console.log(response);
        }
    });
}

function editInventory(id){
	$('#upload-file').html('');
	$('#pod_block').html('');
    $.ajax({
        type: 'GET',
        url: site_url+'/inventory/'+id+'/edit',
        success: function(response){
            let inventoryinfo = response.inventoryinfo;
			
            $('#inv_po_edit').val(inventoryinfo.inv_po);
            $('#inv_container_edit').val(inventoryinfo.inv_container);
            $('#inv_tot_pieces_edit').val(inventoryinfo.inv_tot_pieces);
            $('#inv_weight_edit').val(inventoryinfo.inv_weight);
            $('#inv_date_of_arr_edit').val(inventoryinfo.inv_date_of_arr);
			$('#inv_sku_edit').val(inventoryinfo.inv_sku);
			$('#inv_pallet_edit').val(inventoryinfo.inv_pallet);
            $('#inv_cust_name_edit').val(inventoryinfo.inv_cust_name);
            $('#inv_description_edit').val(inventoryinfo.inv_description);
            $('#inv_tot_piece_left_edit').val(inventoryinfo.inv_tot_piece_left);
            $('#inv_id').val(inventoryinfo.inv_id);

            // for print div data set start
            $('#inventory-po').html(inventoryinfo.inv_po);
			$('#inventory-doa').html(inventoryinfo.inv_date_of_arr);
			$('#inventory-container').html(inventoryinfo.inv_container);
			$('#inventory-cname').html(inventoryinfo.inv_cust_name);
			$('#inventory-sku').html(inventoryinfo.inv_sku);
            $('#inventory-pallet').html(inventoryinfo.inv_pallet);
            $('#inventory-tpr').html(inventoryinfo.inv_tot_pieces);
            $('#inventory-tpl').html(inventoryinfo.inv_tot_piece_left);
            $('#inventory-weight').html(inventoryinfo.inv_weight);
            $('#inventory-des').html(inventoryinfo.inv_description);
			$('#update-upload-file').html(response.file_upload);
			$('#pod_block_edit').html(response.pod_details);
            // for print div data set end
            calculateLeft();
            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetInventorySearch(){
    $('.process-loader-wrapper').show();
    $('#inv_po_search').val('');
    $('#inv_container_search').val('');
    $('#inv_cust_name_search').val('');
    $('#inv_sku_search').val('');
    $('#formdate').val('');
    $('#todate').val('');
    reloadList('inventory', 'inventoryListTableDiv', 'inventoryListTable');
}
function delinvfile(imgid)
{
    $('.process-loader-wrapper').show();
    event.preventDefault();
	
		$.ajax({
			type: 'GET',
			url: site_url+'/delinvfile/'+imgid,
			success: function(response){
				if(!response.errorStatus){
					$('.process-loader-wrapper').hide();
					$('#inventory_image_'+imgid).remove();
					
				}
				
			}
		});
	
}

function appendDiv(id)
{
	$('#delconfirmimg_'+id).addClass('del-img');
}
function deleteDiv(id)
{
	$('#delconfirmimg_'+id).removeClass('del-img');
}
function addblock()
{
	
	var cur_block=parseInt($('#block_count').val());
	var new_block_id=cur_block;
	
	$('#table_block').append('<tr id="tr_block_'+new_block_id+'"><td><input type="text" name="pod_dep_date_'+new_block_id+'" class="payment_info_date"></td><td><input type="text" name="shipper_order_no_'+new_block_id+'" value=""/></td><td><input type="number" name="pod_pieces_ship_'+new_block_id+'" id="pod_pieces_ship_'+new_block_id+'" value="" onchange="calculateLeft()" class="pod_pieces"  /></td><td><input type="text" name="pod_desc_'+new_block_id+'"  value="" /></td><td><input type="text" name="pod_dest_'+new_block_id+'"  value="" /></td><td><input type="text" name="pod_trucker_'+new_block_id+'" value="" /></td><td><input type="text" name="pod_driv_name_'+new_block_id+'" value="" /></td><td><input type="text" value="" name="pod_sku_'+new_block_id+'" id="payment_details_id_'+new_block_id+'" /></td><td><input type="text" name="pod_pallet_'+new_block_id+'" ></td><td><input type="hidden" name="pod_id_'+new_block_id+'" id="pod_id_'+new_block_id+'" value=""><a href="javascript:;" onclick="deleteConfirm(\''+new_block_id+'\');"><img src="public/assets/images/delete.svg" style="width: 20px;"></a><div id="delconfirm_'+new_block_id+'" class="slidediv"><div class="slidediv-inner"><span class="label">Would you like to delete?<a href="javascript:;" onclick="delpod(\''+new_block_id+'\');">Yes</a> | <a href="javascript:;" onclick="closedeldiv(\''+new_block_id+'\')">No</a></span></div></div></td></tr>');
	
	$('#block_count').val(new_block_id+1);
	$('.payment_info_date').datetimepicker({
	    useCurrent: false,
		format:'YYYY-MM-DD'
	});
}
function delpod(blockid)
{
	var details_id=$('#pod_id_'+blockid).val();
	var del_val=$('#paid_amount_'+blockid).val();
	$('.process-loader-wrapper').show();
    event.preventDefault();
	if(details_id!=''){
		$.ajax({
			type: 'GET',
			url: site_url+'/delpod/'+details_id,
			success: function(response){
				if(!response.errorStatus){
					$('.process-loader-wrapper').hide();
					$('#tr_block_'+blockid).remove();
					var cur_block=parseInt($('#block_count').val());
					$('#block_count').val(cur_block-1);
					calculateDue();
				}
				
			}
		});
	} else {
		$('.process-loader-wrapper').hide();
		$('#tr_block_'+blockid).remove();
		var cur_block=parseInt($('#block_count').val());
		$('#block_count').val(cur_block-1);
		calculateDue();
	}
	
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