$(function () {

    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate()+1;
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    //alert(maxDate);
    $('#consultation_date').attr('min', maxDate);

	// Book consultation start
    $('#consultation').validate({
        rules: {
            'person_name': {
                required: true
            },
            'person_email': {
                required: true
            },
        },
        messages: {
            person_name: 'This field is required',
            person_email: 'This field is required',
        },
        highlight: function (input) {
            $(input).parents('.fld').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.fld').removeClass('error');
        },
        errorPlacement: function (error, element) {
			//console.log(error)
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function (form, e) {
            bookConsultation();
        }
    });

    // Newsletter start
    $('#newsletter').validate({
        rules: {
            'newsletter_email': {
                required: true
            },
        },
        messages: {
            newsletter_email: 'This field is required',
        },
        highlight: function (input) {
            $(input).parents('.newslform').addClass('error');
        },
        unhighlight: function (input) {
            $(input).parents('.newslform').removeClass('error');
        },
        errorPlacement: function (error, element) {
			//console.log(error)
            $(element).parents('.input-group').append(error);
            $(element).parents('.form-group').append(error);
        },
        submitHandler: function (form, e) {
            newsletter();
        }
    });

});

function bookConsultation() {   
    var cval = cdate();
    
    if (cval == 'g') {
        $('#consultation_date').css('border-color','red');
    } else {
        $('#consultation_date').css('border-color','#bbb'); 
        event.preventDefault();
        let formData = new FormData($('#consultation')[0]);    
        $.ajax({
            type: 'POST',
            url: 'ajax/book_consultation.php',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                grecaptcha.reset();
                console.log(response);
                var response = JSON.parse(response);
                if (!response.errorStatus) {
                    $("#success-msg-edit").css("display", "block");
                    $('#success-msg-edit').text(response.successmessage);
                    $("#consultation")[0].reset();
                } else {
                    $("#error-msg-edit").css("display", "block");
                    $('#error-msg-edit').text(response.errormessage);
                }
                setTimeout(function () {
                    $("#success-msg-edit").css("display", "none");
                    $("#error-msg-edit").css("display", "none");
                }, 4000);
                //$('.process-loader-wrapper').hide();
                
            },
            error: function (response) {
                console.log(response);
            }
        });
    }
}

function newsletter() {    
    event.preventDefault();
    let formData = new FormData($('#newsletter')[0]);    
    $.ajax({
        type: 'POST',
        url: 'ajax/newsletter.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {
			console.log(response);			
            var response = JSON.parse(response);
            if (!response.errorStatus) {
                $("#success-msg-nl").css("display", "block");
                $('#success-msg-nl').text(response.successmessage);
                $("#newsletter")[0].reset();
            } else {
                $("#error-msg-nl").css("display", "block");
                $('#error-msg-nl').text(response.errormessage);
            }
            setTimeout(function () {
                $("#success-msg-nl").css("display", "none");
                $("#error-msg-nl").css("display", "none");
            }, 4000);
            //$('.process-loader-wrapper').hide();
            
        },
        error: function (response) {
            console.log(response);
        }
    });
}

function cdatecheck()
{    
    var cval = cdate();
    
    if (cval == 'g') {
        $('#consultation_date').css('border-color','red');
    } else {
        $('#consultation_date').css('border-color','#bbb');
    }
}

function cdate()
{
    let date2 = $("input[type='date']").val();

    var dtToday = new Date();
    
    var month = dtToday.getMonth() + 1;
    var day = dtToday.getDate()+1;
    var year = dtToday.getFullYear();
    if(month < 10)
        month = '0' + month.toString();
    if(day < 10)
        day = '0' + day.toString();
    
    var maxDate = year + '-' + month + '-' + day;
    if (date2 < maxDate) {
        return 'g';
    } else {
        return 'r';
    }
}

function mmenuc()
{
    setTimeout(function () {
        jQuery("body").removeClass("menu_active");
    }, 500);
}