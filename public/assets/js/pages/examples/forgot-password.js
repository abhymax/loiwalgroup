$(function () {
    $('#forgot_password').validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        },
        submitHandler: function(form,e) {
            sendForgotPassEmail();
        }
    });

    $('#reset_password').validate({
        highlight: function (input) {
            $(input).parents('.form-line').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.form-line').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
        },
        submitHandler: function(form,e) {
            resetPassword();
        }
    });
});

function sendForgotPassEmail(){
    $('.page-loader-wrapper').show();
    event.preventDefault();
    $('#success-msg').text('');
    $('#error-msg').text('');
    let email = $('input[name="email"]').val();
    let _token = $('input[name="_token"]').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/forgot-password',
        data: {
            email: email,
            _token: _token
        },
        success: function(response){
            if(!response.errorStatus){
                $('#success-msg').text(response.successmessage);
            }
            else{
                $('#error-msg').text(response.errormessage);
            }
            $('.page-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    })
}

function resetPassword(){
    $('.page-loader-wrapper').show();
    event.preventDefault();
    $('#success-msg').text('');
    $('#error-msg').text('');
    let password = $('input[name="password"]').val();
    let token = $('input[name="token"]').val();
    let email = $('input[name="email"]').val();
    let _token = $('input[name="_token"]').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/reset-password',
        data: {
            password: password,
            token: token,
            email: email,
            _token: _token
        },
        success: function(response){
            if(!response.errorStatus){
                $('#success-msg').text(response.successmessage);
                setTimeout(function(){
                    window.location.href = site_url+'/login';
                }, 3000);
            }
            else{
                $('#error-msg').text(response.errormessage);
            }
            $('.page-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    })
}
