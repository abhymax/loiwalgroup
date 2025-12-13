$(function () { 

    // Contact form submit start
    $('#contactsubmitform').validate({
        rules: {
            'name': {
                required: true
            },
            'email': {
                required: true
            },
            'captcha': {
                required: true
            }
        }, 
        messages: {
            name: 'name is required',
            email: 'email is required',
            captcha: 'captcha is required',
        },
        highlight: function (input) {
            $(input).parents('.form-item').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-item').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(form,e) {
            submitContact();
        }
    });
    // Contact form submit end

});

function submitContact(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#contactsubmitform')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/contact/submit',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            console.log(response);
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                $('#name').val('');
                $('#email').val('');
                $('#phone').val('');
                $('#comments').val('');
                $('#captcha').val('');
                $('.btn-refresh').click();
            }
            else{
                $("#error-msg").css("display", "block");
                $('#error-msg').text(response.errormessage);
                $('.btn-refresh').click();
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