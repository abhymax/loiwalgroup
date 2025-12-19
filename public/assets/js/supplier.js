$(function () {

    // News add start
    $('#addSupplier').validate({
        rules: {
            'supplier_number': {
                required: true
            },
            'supplier_name': {
                required: true
            },
			'warehouse_id': {
                required: true
            },
            'supplier_email': {
                required: true,
				email: true
            },
			'supplier_mobile_number': {
                required: true,
				/*remote: {
				url:site_url+'/suppliers/checkmobile',
				type: "post",
				async: false,
				data: {
				  supplier_mobile_number: function() {
					return $( "#supplier_mobile_number" ).val();
				  }
				}
			  }*/
            }
        }, 
        messages: {
            supplier_number: 'Supplier Number required',
            supplier_name: 'Name required',
			warehouse_id: 'Warehouse required',
            supplier_email: {
                required: 'Email required',
                email: 'Provide valid email address'
            },
			supplier_mobile_number: {
				required: 'Mobile Number required',
				//remote: 'Provide unique mobile number'
			}
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
            addSupplier();
        }
    });
    // News add end

    // News update start
    $('#updatesupplier').validate({
        rules: {
            'supplier_number': {
                required: true
            },
            'supplier_name': {
                required: true
            },
			'warehouse_id': {
                required: true
            },
            'supplier_email': {
                required: true,
				email: true
            },
			'supplier_mobile_number': {
                required: true
            }
        }, 
        messages: {
            supplier_number: 'Supplier Number required',
            supplier_name: 'Name required',
			warehouse_id: 'Warehouse required',
            supplier_email: {
                required: 'Email required',
                email: 'Provide valid email address'
            },
			supplier_mobile_number: 'Mobile Number required'
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
            updateSupplier();
        }
    });
    // News update end

    // Supplier search start
    $('#searchsupplier').validate({
        
        submitHandler: function(form,e) {
            searchData('suppliers', 'searchsupplier', 'supplierListTableDiv', 'supplierListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Supplier search end
});

function addSupplier(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addSupplier')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
    url: BASE_URL + '/supplier/store',
    type: 'POST',
    data: new FormData(this),
    contentType: false,
    processData: false,
    success: function (data) {
        if(data.success){
             $('.page-loader-wrapper').hide(); // Stop loader
             // ... existing success logic ...
             alert(data.success);
             location.reload();
        } else {
             $('.page-loader-wrapper').hide(); // Stop loader on validation error
             alert('Validation Error: ' + JSON.stringify(data.errors));
        }
    },
    error: function(xhr, status, error) {
        $('.page-loader-wrapper').hide(); // STOP LOADER ON CRASH
        
        // Show the actual error message from the server
        var errorMessage = xhr.status + ': ' + xhr.statusText;
        if(xhr.responseText) {
            // Try to extract the Laravel exception message
            var response = JSON.parse(xhr.responseText);
            if(response.message) {
                errorMessage = response.message;
            }
        }
        alert('Server Error: ' + errorMessage);
    }
});
} 

function updateSupplier(){
    $('.process-loader-wrapper').show();
    event.preventDefault();

    let formData = new FormData($('#updatesupplier')[0]);
    
    let _token = $('input[id="_token_edit"]').val();
    let id = $('#supplier_id').val();

    $.ajax({
        type: 'POST',
        url: site_url+'/suppliers/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            console.log(response);
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('suppliers', 'supplierListTableDiv', 'supplierListTable');
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

function editSupplier(id){
    $.ajax({
        type: 'GET',
        url: site_url+'/suppliers/'+id+'/edit',
        success: function(response){
            console.log(response);
            let supplierinfo = response.supplierinfo;
			
            $('#supplier_number_edit').val(supplierinfo.supplier_number);
            $('#supplier_name_edit').val(supplierinfo.supplier_name);
            $('#supplier_address_edit').val(supplierinfo.supplier_address);
            $('#supplier_city_edit').val(supplierinfo.supplier_city);
            $('#supplier_contact_person_edit').val(supplierinfo.supplier_contact_person);
			$('#supplier_contact_person_ho_edit').val(supplierinfo.supplier_contact_person_ho);
			$('#supplier_phone_number_edit').val(supplierinfo.supplier_phone_number);
			$('#supplier_email_edit').val(supplierinfo.supplier_email);
			$('#supplier_mobile_number_edit').val(supplierinfo.supplier_mobile_number);
			$('#contact_emails_edit').val(supplierinfo.contact_emails);
			$('#contact_numbers_edit').val(supplierinfo.contact_numbers);
            $("#warehouse_id_edit").val(supplierinfo.warehouse_id); 
            $('#supplier_id').val(supplierinfo.supplier_id);
            
            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetSupplierSearch(){
    $('.process-loader-wrapper').show();
    $('#supplier_number_search').val('');
    $('#supplier_name_search').val('');
	$('#supplier_email_search').val('');
	$('#supplier_mobile_search').val('');
    reloadList('suppliers', 'supplierListTableDiv', 'supplierListTable');
}
