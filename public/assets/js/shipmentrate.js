$(function () {
    // Shipmentrate update start
    $('#shipmentrate_form').validate({
        rules:{
            import_service_fee: "required",
            documentation_fee: "required",
            warehouse_surcharge: "required",
            handling_charge_minimum: "required",
            handling_multiply_by: "required"
        },
        messages: {
            import_service_fee: 'Import service is required',
            documentation_fee: 'Documentation fee is required',
            warehouse_surcharge: 'Warehouse surcharge is required',
            handling_charge_minimum: 'Handling charge is required',
            handling_multiply_by: 'Handling multiply is required',
        },
        submitHandler: function(form,e) {
            updateShipmentrate();
        }
    });
    // Shipmentrate update end
});

// update Shipmentrate
function updateShipmentrate(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#shipmentrate_form')[0]);
    $.ajax({
        type: 'POST',
        url: site_url+'/update-shipmentrate',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            //console.log(response.data);
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
