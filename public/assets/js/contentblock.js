$(function () {

    // Cms update start
    $('#updateblock').validate({
        rules: {
            'block_type': {
                required: true
            },
            'block_title': {
                required: true
            }
        },
        messages: {
            block_type: 'Type is required',
            block_title: 'Title is required'
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
            updateBlock();
        }
    });
    // Cms update end

    // Cms search start
    $('#searchblock').validate({
        
        submitHandler: function(form,e) {
            searchData('contentblock', 'searchblock', 'blockListTableDiv', 'blockListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Cms search end
});


function updateBlock(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    tinyMCE.triggerSave();
    let formData = new FormData($('#updateblock')[0]);

    let _token = $('input[id="_token_edit"]').val();
    let id = $('#block_id').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/contentblock/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('contentblock', 'blockListTableDiv', 'blockListTable');
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

function editBlock(id){
    $.ajax({
        type: 'GET',
        url: site_url+'/contentblock/'+id+'/edit',
        success: function(response){
            let blockinfo = response.blockinfo;
			
            $('#block_type_edit').val(blockinfo.block_type);
            $('#block_title_edit').val(blockinfo.block_title);
            $('#block_content_edit').val(blockinfo.block_content);
            $('#block_id').val(blockinfo.block_id);

            tinyMCE.activeEditor.setContent(blockinfo.block_content);

            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetBlockSearch(){
    $('.process-loader-wrapper').show();
    $('#block_title_search').val('');
    
    reloadList('contentblock', 'blockListTableDiv', 'blockListTable');
}
