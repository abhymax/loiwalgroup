$(function () {
    // Profile update start
    $('#profile_form').validate({
        rules:{
            admin_email: {
                required: true,
                email: true
            },
            admin_username: "required",
            password_confirm: {
                equalTo: "#password"
            },
        },
        messages: {
            admin_email: {
                required: 'Email is required',
                email: 'Please provide valid email'
            },
            admin_username: 'Username is required',
            password_confirm: {
                equalTo: 'Enter same as password'
            }
        },
        submitHandler: function(form,e) {
            updateProfile();
        }
    });
    // Profile update end
});

// update user profile
function updateProfile(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#profile_form')[0]);
    $.ajax({
        type: 'POST',
        url: site_url+'/update-profile',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            $('#admin_password').val('');
            $('#password_confirm').val('');
            
            if(!response.errorStatus){
                $('#success-msg').text(response.successmessage);
                // update side panel data start
               // $('.info-container .name').text(response.data.first_name+' '+response.data.last_name);
                
                // update side panel data strat
            }
            else{
                $('#error-msg').text(response.errormessage);
            }
            setTimeout(function(){
                $('#success-msg').text('');
                $('#error-msg').text('');
            }, 3000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    })
}
