$(function () {

    // Banners add start
    $('#addBanners').validate({
        rules: {
            'banner_title': {
                required: true
            },
            'banner_image': {
                required: true
            },
            'banner_location': {
                required: true
            }
        }, 
        messages: {
            banner_title: 'Banner Title is required',
            banner_image: 'Banner Image is required',
            banner_location: 'Banner Location is required'
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
            addBanners();
        }
    });
    // Banners add end

    // Banners update start
    $('#updatebanners').validate({
        rules: {
            'banner_title': {
                required: true
            },
            'banner_location': {
                required: true
            }
        },
        messages: {
            banner_title: 'Banner Title is required',
            banner_location: 'Banner Location is required'
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
            updateBanners();
        }
    });
    // Banners update end

    // Banners search start
    $('#searchbanners').validate({
        
        submitHandler: function(form,e) {
            searchData('banners', 'searchbanners', 'bannersListTableDiv', 'bannersListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Banners search end
});

function addBanners(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addBanners')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/banners',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                reloadList('banners', 'bannersListTableDiv', 'bannersListTable');
            }
            else{
                $("#error-msg").css("display", "block");
                $('#error-msg').text('Please fill form properly');
            }
            setTimeout(function(){
                $("#success-msg").css("display", "none");
                $("#error-msg").css("display", "none");
                editBulding(response.data.id);
            }, 3000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
} 

function updateBanners(){
    $('.process-loader-wrapper').show();
    event.preventDefault();

    let formData = new FormData($('#updatebanners')[0]);
    
    let _token = $('input[id="_token_edit"]').val();
    let id = $('#banner_id').val();

    $.ajax({
        type: 'POST',
        url: site_url+'/banners/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            console.log(response);
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('banners', 'bannersListTableDiv', 'bannersListTable');
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

function editBanners(id){
    $.ajax({
        type: 'GET',
        url: site_url+'/banners/'+id+'/edit',
        success: function(response){
            console.log(response);
            let bannerinfo = response.bannerinfo;
			let contentinfo = response.contentinfo;
            
            $('#banner_title_edit').val(bannerinfo.banner_title);
            //$('#banner_content_edit').val(bannerinfo.banner_content);
            //$('#banner_location_edit').val(bannerinfo.banner_location);
            if(bannerinfo.banner_active == 'Y'){ $('#banner_active_edit').prop('checked',true); } else{ $('#banner_active_edit').prop('checked',false); }
            $('#banner_id').val(bannerinfo.banner_id);
            $('#banner_cover_img').html(response.banner_image);
            $('#banner_location_edit').html(response.contentinfo);
            
            if(bannerinfo.banner_content != null){
                tinyMCE.activeEditor.setContent(bannerinfo.banner_content);
            }else{
                tinyMCE.activeEditor.setContent('');
            }

            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetBannersSearch(){
    $('.process-loader-wrapper').show();
    $('#banner_title_search').val('');
    $('#banner_location_search').val('-1');
    reloadList('banners', 'bannersListTableDiv', 'bannersListTable');
}
