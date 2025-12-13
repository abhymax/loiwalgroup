$(function () {

    // Cms update start
    $('#updatecms').validate({
        rules: {
            'cms_title': {
                required: true
            },
            'metatag_title': {
                required: true
            },
            'metatag_keywords': {
                required: true
            },
            'metatag_description': {
                required: true
            }
        },
        messages: {
            cms_title: 'Cms Title is required',
            metatag_title: 'Metatag Title is required',
            metatag_keywords: 'Metatag Keywords is required',
            metatag_description: 'Metatag Description is required'
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
            updateCms();
        }
    });
    // Cms update end

    // Cms search start
    $('#searchcms').validate({
        
        submitHandler: function(form,e) {
            searchData('cms', 'searchcms', 'cmsListTableDiv', 'cmsListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Cms search end
});


function updateCms(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    tinyMCE.triggerSave();
    let formData = new FormData($('#updatecms')[0]);

    let _token = $('input[id="_token_edit"]').val();
    let id = $('#cms_id').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/cms/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('cms', 'cmsListTableDiv', 'cmsListTable');
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

function editCms(id){
    $.ajax({
        type: 'GET',
        url: site_url+'/cms/'+id+'/edit',
        success: function(response){
            let cmsinfo = response.cmsinfo;
			
            $('#cms_title_edit').val(cmsinfo.cms_title);
            $('#metatag_title_edit').val(cmsinfo.metatag_title);
            $('#metatag_keywords_edit').val(cmsinfo.metatag_keywords);
            $('#metatag_description_edit').val(cmsinfo.metatag_description);
            $('#cms_describtion_edit').val(cmsinfo.cms_describtion);
            $('#cms_id').val(cmsinfo.cms_id);

            if(cmsinfo.cms_describtion){tinyMCE.activeEditor.setContent(cmsinfo.cms_describtion);}

            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetCmsSearch(){
    $('.process-loader-wrapper').show();
    $('#cms_title_search').val('');
    
    reloadList('cms', 'cmsListTableDiv', 'cmsListTable');
}
