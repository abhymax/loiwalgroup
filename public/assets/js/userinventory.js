$(function () {
    // user inventory update start
    $('#inventory_user_form').validate({
        rules:{
            admin_email: "required",
            admin_username: "required",
            password_confirm: {
                equalTo: "#password"
            },
        },
        messages: {
            admin_email: 'Email is required',
            admin_username: 'Username is required',
            password_confirm: {
                equalTo: 'Enter same as password'
            }
        },
        submitHandler: function(form,e) {
            updateUserInventory();
        }
    });
    // user inventory update end
});

// update user inventory
function updateUserInventory(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#inventory_user_form')[0]);
    $.ajax({
        type: 'POST',
        url: site_url+'/user-inventory-update',
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
