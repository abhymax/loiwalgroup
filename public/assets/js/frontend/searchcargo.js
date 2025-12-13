$(function () { 

    // Search cargo form submit start
    $('#searchcargoform').validate({
        rules: {
            'shipment': {
                required: true
            },
            'track_number': {
                required: true
            }
        }, 
        messages: {
            shipment: 'shipment is required',
            track_number: 'track number is required',
        },
        highlight: function (input) {
            $(input).parents('field').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('field').removeClass('error');
        },
        errorPlacement: function (error, element) {
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function(form,e) {
            submitSearchCargo();
        }
    });
    // Search cargo form submit end

});

function submitSearchCargo(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#searchcargoform')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    
    $("#searchcargosubmit").html('Searching ...');
    $('#searchcargosubmit').prop('disabled', true);
    
    $.ajax({
        type: 'POST',
        url: site_url+'/searchcargo/submit',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            //console.log(response.data);
            $('.searchcargo-result').html(response.searchcargo_view);
            $("#searchcargosubmit").html('Search cargo');
            $('#searchcargosubmit').prop('disabled', false);
            
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
            }
            else{
                $("#error-msg").css("display", "block");
                $('#error-msg').text('Please fill form properly');
                $("#searchcargosubmit").html('Search cargo');
                $('#searchcargosubmit').prop('disabled', false);
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