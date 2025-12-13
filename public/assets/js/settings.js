$(function () {
    // settings update start
    $('#settings_form').validate({
        rules:{
            shipment_request_email: "required",
            delivery_quote_email: "required",
            contact_email: "required",
            footer_copyrights: "required"
        },
        messages: {
            shipment_request_email: 'Email is required',
            delivery_quote_email: 'Email is required',
            contact_email: 'Email is required',
            footer_copyrights: 'Text is required'
        },
        submitHandler: function(form,e) {
            updateSettings();
        }
    });
    // settings update end
});

// update settings
function updateSettings(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#settings_form')[0]);
    $.ajax({
        type: 'POST',
        url: site_url+'/update_settings',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $('#success-msg').text(response.successmessage);
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
