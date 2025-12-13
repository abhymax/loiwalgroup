$(function () {

    // Adminusers add start
    $('#addadminusers').validate({
        rules: {
            'admin_username': {
                required: true
            },
            'admin_password': {
                required: true
            },
            'admin_email': {
                required: true
            }
        }, 
        messages: {
            admin_username: 'Username is required',
            admin_password: 'Password is required',
            admin_email: 'Email is required'
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
            addAdminusers();
        }
    });
    // Adminusers add end

    // Adminusers update start
    $('#updateadminusers').validate({
        rules: {
            'admin_username': {
                required: true
            },
            'admin_email': {
                required: true
            }
        }, 
        messages: {
            admin_username: 'Username is required',
            admin_email: 'Email is required'
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
            updateAdminusers();
        }
    });
    // Adminusers update end

    // Adminusers search start
    $('#searchadminusers').validate({
        
        submitHandler: function(form,e) {
            searchData('adminusers', 'searchadminusers', 'adminusersListTableDiv', 'adminusersListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Adminusers search end
});

function addAdminusers(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addadminusers')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/adminusers',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
				$('#addadminusers')[0].reset();
                reloadList('adminusers', 'adminusersListTableDiv', 'adminusersListTable');
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

function updateAdminusers(){
    $('.process-loader-wrapper').show();
    event.preventDefault();

    let formData = new FormData($('#updateadminusers')[0]);

    /*let shipper_name = $('#shipper_name_edit').val();
    let shipper_email = $('#shipper_email_edit').val();
    let shipper_phone = $('#shipper_phone_edit').val();
    let shipper_address = $('#shipper_address_edit').val();*/
    
    let _token = $('input[id="_token_edit"]').val();
    let id = $('#fid').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/adminusers/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('adminusers', 'adminusersListTableDiv', 'adminusersListTable');
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

function editAdminusers(id){
    $.ajax({
        type: 'GET',
        url: site_url+'/adminusers/'+id+'/edit',
        success: function(response){
            let adminusers = response.adminusers;
			
            $('#admin_username_edit').val(adminusers.admin_username);
			$('#admin_password_edit').val('');
            $('#admin_email_edit').val(adminusers.admin_email);
            if(adminusers.is_active == 'Y'){ $('#is_active_edit').prop('checked',true); } else{ $('#is_active_edit').prop('checked',false); }
            $('#admin_id').val(adminusers.admin_id);
            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetAdminusersSearch(){
    $('.process-loader-wrapper').show();
    $('#admin_username_search').val('');
    reloadList('adminusers', 'adminusersListTableDiv', 'adminusersListTable');
}
