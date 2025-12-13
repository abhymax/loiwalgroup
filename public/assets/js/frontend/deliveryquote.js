$(function () { 

    // Delivery quote form submit start
    $('#delivery_quote_submit_form').validate({
        rules: {
            'delivery_quote_company_name': {
                required: true
            },
            'delivery_quote_email': {
                required: true
            },
            'delivery_quote_puLocation': {
                required: true
            },
            'delivery_quote_deliveryLocation': {
                required: true
            },
            'delivery_quote_peices': {
                required: true
            },
            'delivery_quote_weight': {
                required: true
            },
            'captcha': {
                required: true
            }
        }, 
        messages: {
            delivery_quote_company_name: 'Company name is required',
            delivery_quote_email: 'email is required',
            delivery_quote_puLocation: 'Pickup location is required',
            delivery_quote_deliveryLocation: 'Delivery location is required',
            delivery_quote_peices: 'Peices is required',
            delivery_quote_weight: 'Weight is required',
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
            submitDeliveryQuote();
        }
    });
    // Delivery quote form submit end

});

function submitDeliveryQuote(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#delivery_quote_submit_form')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/deliveryquoteform/submit',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            //console.log(response);
            if(!response.errorStatus){
                console.log('test');
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                $('#delivery_quote_company_name').val('');
                $('#delivery_quote_reference').val('');
                $('#delivery_quote_email').val('');
                $('#delivery_quote_phone').val('');
                $('#delivery_quote_puLocation').val('');
                $('#delivery_quote_deliveryLocation').val('');
                $('#delivery_quote_peices').val('');
                $('#delivery_quote_weight').val('');
                $('#delivery_quote_instructions').val('');
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
            }, 3000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
} 