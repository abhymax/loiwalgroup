$(function () { 

    // newsletter form submit start
    $('#newslettersubmitform').validate({
        rules: {
            'subscriber_email': {
                required: true
            }
        }, 
        messages: {
            subscriber_email: 'email is required'
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
            submitNewsletter();
        }
    });
    // newsletter form submit end

});

function submitNewsletter(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#newslettersubmitform')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    
    $("#newslettersubmit").html('Sending ...');
    $('#newslettersubmit').prop('disabled', true);
    
    $.ajax({
        type: 'POST',
        url: site_url+'/newsletter/submit',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            console.log(response);
             
            $("#newslettersubmit").html('Send');
            $('#newslettersubmit').prop('disabled', false);
            
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                $('#subscriber_email').val('');
            }
            else{
                $("#error-msg").css("display", "block");
                $('#error-msg').text('Please enter email properly');
                $("#newslettersubmit").html('Send');
                $('#newslettersubmit').prop('disabled', false);
            }
            setTimeout(function(){
                $("#success-msg").css("display", "none");
                $("#error-msg").css("display", "none");
            }, 5000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
} 