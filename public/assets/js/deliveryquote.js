$(function () {

   

    // Building update start
    $('#sendComment').validate({
        rules: {
            'subject': {
                required: true
            },
            'comments': {
                required: true
            }
        },
        messages: {
            subject: 'Subject is required',
            comments: 'Comments is required',
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
            sendComment();
        }
    });
    // Building update end

    // Delivery Quote search start
    $('#searchdeliveryquote').validate({
        
        submitHandler: function(form,e) {
            searchData('deliveryquote', 'searchdeliveryquote', 'deliveryquoteListTableDiv', 'deliveryquoteListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Delivery Quote search end
});



function sendComment(){
    $('.process-loader-wrapper').show();
    event.preventDefault();

    let formData = new FormData($('#sendComment')[0]);

    $.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/deliveryquote/update',
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
				$('#subject').val('');
				$('#comments').val('');
				editDeliveryquote($('#delivery_quote_id').val());
                //reloadList('deliveryquote', 'deliveryquoteListTableDiv', 'deliveryquoteListTable');
            }
            else{
                $("#error-msg-edit").css("display", "block");
                $('#error-msg-edit').text('Please fill form properly');
            }
            setTimeout(function(){
                $("#success-msg-edit").css("display", "none");
                $("#error-msg-edit").css("display", "none");
            }, 3000);
            $('.process-loader-wrapper').hide();
            $('#editbutton').removeAttr("disabled");
        },
        error: function(response){
            console.log(response);
        }
    });
}

function editDeliveryquote(id){
	$('#comment-list').html('');
	$.ajax({
        type: 'GET',
        url: site_url+'/deliveryquote/'+id+'/edit',
        success: function(response){
            let quoteinfo = response.quoteinfo;
			
            $('#delivery_quote_unique_id_view').html(quoteinfo.delivery_quote_unique_id);
            $('#delivery_quote_company_name_view').html(quoteinfo.delivery_quote_company_name);
            $('#delivery_quote_date_view').html(quoteinfo.delivery_quote_date);
            $('#delivery_quote_email_view').html(quoteinfo.delivery_quote_email);
            $('#delivery_quote_reference_view').html(quoteinfo.delivery_quote_reference);
			$('#delivery_quote_weight_view').html(quoteinfo.delivery_quote_weight);
			$('#delivery_quote_puLocation_view').html(quoteinfo.delivery_quote_puLocation);
            $('#delivery_quote_deliveryLocation_view').html(quoteinfo.delivery_quote_deliveryLocation);
            $('#delivery_quote_peices_view').html(quoteinfo.delivery_quote_peices);
            $('#delivery_quote_instructions_view').html(quoteinfo.delivery_quote_instructions);
            $('#delivery_quote_id').val(quoteinfo.delivery_quote_id);
			$('#comment-list').html(response.comment_view);
            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetDeliveryquoteSearch(){
    $('.process-loader-wrapper').show();
    $('#delivery_quote_unique_id_search').val('');
    $('#delivery_quote_email_search').val('');
    $('#fromdate').val('');
    $('#todate').val('');
    reloadList('deliveryquote', 'deliveryquoteListTableDiv', 'deliveryquoteListTable');
}
function delcomment(id,qid){
	$('.process-loader-wrapper').show();
	
    event.preventDefault();
	$.ajax({
        type: 'GET',
        url: site_url+'/deliveryquote/delcomment/'+id,
        success: function(response){
			if(!response.errorStatus){
				editDeliveryquote(qid);
			}
			$('.process-loader-wrapper').hide();
		}
	});
}
