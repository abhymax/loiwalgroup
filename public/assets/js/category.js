$(function () {

    // Category add start
    $('#addCategory').validate({
        rules: {
            'category_name': {
                required: true
            }
        }, 
        messages: {
            category_name: 'Category name required'
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
            addCategory();
        }
    });
    // Category add end

    // Category update start
    $('#updatecategory').validate({
        rules: {
            'category_name': {
                required: true
            }
        }, 
        messages: {
            category_name: 'Category name required'
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(form,e) {
            updateCategory();
        }
    });
    // Category update end

    // Category search start
    $('#searchcategory').validate({
        
        submitHandler: function(form,e) {
            searchData('categories', 'searchcategory', 'categoryListTableDiv', 'categoryListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Category search end
});

function addCategory(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addCategory')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/categories',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                reloadList('categories', 'categoryListTableDiv', 'categoryListTable');
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

function updateCategory(){
    $('.process-loader-wrapper').show();
    event.preventDefault();

    let formData = new FormData($('#updatecategory')[0]);

    /*let shipper_name = $('#shipper_name_edit').val();
    let shipper_email = $('#shipper_email_edit').val();
    let shipper_phone = $('#shipper_phone_edit').val();
    let shipper_address = $('#shipper_address_edit').val();*/
    
    let _token = $('input[id="_token_edit"]').val();
    let id = $('#category_id').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/categories/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('categories', 'categoryListTableDiv', 'categoryListTable');
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

function editCategory(id){
    $.ajax({
        type: 'GET',
        url: site_url+'/categories/'+id+'/edit',
        success: function(response){
            let categoryinfo = response.categoryinfo;
			
            $('#category_name_edit').val(categoryinfo.category_name);
            $('#category_description_edit').val(categoryinfo.category_description);
            $('#category_id').val(categoryinfo.category_id);
            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetCategorySearch(){
    $('.process-loader-wrapper').show();
    $('#category_name_search').val('');
   
    reloadList('categories', 'categoryListTableDiv', 'categoryListTable');
}
