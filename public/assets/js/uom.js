$(function () {

    // UOM add start
    $('#addUom').validate({
        rules: {
            'uom_name': {
                required: true
            }
        }, 
        messages: {
            uom_name: 'UOM required'
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
            addUom();
        }
    });
    // UOM add end

    // UOM update start
    $('#updateuom').validate({
        rules: {
            'uom_name': {
                required: true
            }
        }, 
        messages: {
            uom_name: 'UOM required'
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(form,e) {
            updateUom();
        }
    });
    // Uom update end

    // Uom search start
    $('#searchuom').validate({
        
        submitHandler: function(form,e) {
            searchData('uom', 'searchuom', 'uomListTableDiv', 'uomListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // UOm search end
});

function addUom(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addUom')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/uom',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                reloadList('uom', 'uomListTableDiv', 'uomListTable');
            }
            else{
                $("#error-msg").css("display", "block");
                $('#error-msg').text('Please fill form properly');
            }
            setTimeout(function(){
                $("#success-msg").css("display", "none");
                $("#error-msg").css("display", "none");
               // editBulding(response.data.id);
            }, 3000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
} 

function updateUom(){
    $('.process-loader-wrapper').show();
    event.preventDefault();

    let formData = new FormData($('#updateuom')[0]);

    /*let shipper_name = $('#shipper_name_edit').val();
    let shipper_email = $('#shipper_email_edit').val();
    let shipper_phone = $('#shipper_phone_edit').val();
    let shipper_address = $('#shipper_address_edit').val();*/
    
    let _token = $('input[id="_token_edit"]').val();
    let id = $('#uom_id').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/uom/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('uom', 'uomListTableDiv', 'uomListTable');
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

function editUom(id){
    $.ajax({
        type: 'GET',
        url: site_url+'/uom/'+id+'/edit',
        success: function(response){
            let uominfo = response.uominfo;
			
            $('#uom_name_edit').val(uominfo.uom_name);
            $('#uom_description_edit').val(uominfo.uom_description);
            $('#uom_id').val(uominfo.uom_id);
            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetUomSearch(){
    $('.process-loader-wrapper').show();
    $('#uom_name_search').val('');
   
    reloadList('uom', 'uomListTableDiv', 'uomListTable');
}
