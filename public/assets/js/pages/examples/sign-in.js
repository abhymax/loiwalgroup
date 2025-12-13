$(function () {
    $('#sign_in').validate({
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
            loginCheck();
        }
    });
});

function loginCheck(){
    event.preventDefault();
    let username = $('input[name="username"]').val();
    let password = $('input[name="password"]').val();
    let _token = $('input[name="_token"]').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/login',
        data: {
            username: username,
            password: password,
            _token: _token
        },
        success: function(response){
            if(!response.errorStatus){
                window.location.href = site_url+'/dashboard';
            }
            else{
                $('#error-msg').text(response.errormessage).show();
            }
        },
        error: function(response){
            console.log(response);
        }
    })
}
