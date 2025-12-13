$(function () {

    // Warehouse add start
    $('#addWarehouse').validate({
        rules: {
            'warehouse_name': {
                required: true
            },
            'warehouse_contact_person': {
                required: true
            },
			'warehouse_contact_number': {
				required: true
			}
        }, 
        messages: {
            warehouse_name: 'Warehouse name is required',
            warehouse_contact_person: 'Contact person is required',
			warehouse_contact_number: 'Contact number is required',
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
            addWarehouse();
        }
    });
    // Warehouse add end

    // Warehouse update start
    $('#updatewarehouse').validate({
        rules: {
            'warehouse_name': {
                required: true
            },
            'warehouse_contact_person': {
                required: true
            },
			'warehouse_contact_number': {
				required: true
			}
        }, 
        messages: {
            warehouse_name: 'Warehouse name is required',
            warehouse_contact_person: 'Contact person required',
			warehouse_contact_number: 'Contact number required',
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(form,e) {
            updateWarehouse();
        }
    });
    // Warehouse update end

    // Warehouse search start
    $('#searchwarehouse').validate({
        
        submitHandler: function(form,e) {
            searchData('warehouses', 'searchwarehouse', 'warehouseListTableDiv', 'warehouseListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Warehouse search end
});
function showContact(){
    $('.process-loader-wrapper').show();
	$('#contact_block_edit').html('');
	
   // $('#edit-form').html('');
    $.ajax({
        type: 'GET',
        url: site_url+'/warehouseadd',
        success: function(response){
			
            $('.process-loader-wrapper').hide();
            $('#contact_block').html(response.contact_details);
        }
    });

}
function addWarehouse(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addWarehouse')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/warehouses',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                reloadList('warehouses', 'warehouseListTableDiv', 'warehouseListTable');
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

function updateWarehouse(){
    $('.process-loader-wrapper').show();
    event.preventDefault();

    let formData = new FormData($('#updatewarehouse')[0]);

    /*let shipper_name = $('#shipper_name_edit').val();
    let shipper_email = $('#shipper_email_edit').val();
    let shipper_phone = $('#shipper_phone_edit').val();
    let shipper_address = $('#shipper_address_edit').val();*/
    
    let _token = $('input[id="_token_edit"]').val();
    let id = $('#warehouse_id').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/warehouses/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('warehouses', 'warehouseListTableDiv', 'warehouseListTable');
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

function editWarehouse(id){
    $.ajax({
        type: 'GET',
        url: site_url+'/warehouses/'+id+'/edit',
        success: function(response){
            let warehouseinfo = response.warehouseinfo;
			
            $('#warehouse_name_edit').val(warehouseinfo.warehouse_name);
            $('#warehouse_email_edit').val(warehouseinfo.warehouse_email);
            $('#warehouse_contact_number_edit').val(warehouseinfo.warehouse_contact_number);
			$('#warehouse_contact_person_edit').val(warehouseinfo.warehouse_contact_person);
            $('#warehouse_address_edit').val(warehouseinfo.warehouse_address);
            $('#warehouse_id').val(warehouseinfo.warehouse_id);
			$('#contact_block_edit').html(response.contact_details);
            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetWarehouseSearch(){
    $('.process-loader-wrapper').show();
    $('#warehouse_name_search').val('');
    $('#warehouse_email_search').val('');
    $('#warehouse_contact_number_search').val('');
    
    reloadList('warehouses', 'warehouseListTableDiv', 'warehouseListTable');
}
function addnewContact()
{
  
	
	var cur_block=parseInt($('#block_count').val());
	var new_block_id=cur_block;

	$('#table_block').append('<tr id="tr_block_'+new_block_id+'"><td><input type="text" name="contact_email[]" id="contact_email_'+new_block_id+'" value="" /></td><td><input type="text" name="contact_no[]" id="contact_no_'+new_block_id+'" value=""  /></td><td><input type="hidden" name="warehouse_contact_id[]" id="warehouse_contact_id_'+new_block_id+'" value=""><a href="javascript:;" onclick="deleteConfirm(\''+new_block_id+'\');"><img src="public/assets/images/delete.svg" style="width: 20px;"></a><div id="delconfirm_'+new_block_id+'" class="slidediv"><div class="slidediv-inner"><span class="label">Would you like to delete?<a href="javascript:;" onclick="delcontact(\''+new_block_id+'\');">Yes</a> | <a href="javascript:;" onclick="closedeldiv(\''+new_block_id+'\')">No</a></span></div></div></td></tr>');
	
	$('#block_count').val(new_block_id+1);
	
}
function delcontact(blockid)
{
        var details_id=$('#warehouse_contact_id_'+blockid).val();
		$('.process-loader-wrapper').hide();
		event.preventDefault();
		if(details_id!=''){
			$.ajax({
				type: 'GET',
				url: site_url+'/delcontact/'+details_id,
				success: function(response){
					if(!response.errorStatus){
						$('.process-loader-wrapper').hide();
						$('#tr_block_'+blockid).remove();
						var cur_block=parseInt($('#block_count').val());
						$('#block_count').val(cur_block-1);
						
					}
					
				}
			});
		} else {
			$('#tr_block_'+blockid).remove();
			var cur_block=parseInt($('#block_count').val());
			$('#block_count').val(cur_block-1);
	    }
	
	
}
