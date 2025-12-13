$(function () {

    // User add start
    $('#adduser').validate({
        rules: {
            'email': {
                required: true
            },
            'first_name': {
                required: true
            },
            'user_password': {
                required: true
            },
            'password_confirm': {
                required: true,
                equalTo: "#user_password"
            },
        },
        messages: {
            email: {
                required: 'This field is required',
                email: 'Please enter a valid email address.'
            },
            first_name: 'This field is required',
            user_password: 'This field is required',
            password_confirm: {
                required: 'This field is required',
                equalTo: 'Enter same as password'
            }
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
            addUser();
        }
    });
    // User add end

    // User update start
    $('#updateuser').validate({
        rules: {
            'first_name_edit': {
                required: true
            }
        },
        messages: {
            first_name_edit: 'This field is required'
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
            updateUser();
        }
    });
    // User update end

    // User search start
    $('#searchuser').validate({
        submitHandler: function(form,e) {
            searchData('users', 'searchuser', 'userListTableDiv', 'userListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // User search end
});

function addUser(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#adduser')[0]);
    $.ajax({
        type: 'POST',
        url: site_url+'/users',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                reloadList('users', 'userListTableDiv', 'userListTable');
            }
            else{
                $("#error-msg").css("display", "block");
                $('#error-msg').text(response.errormessage);
            }
            setTimeout(function(){
                $("#success-msg").css("display", "none");
                $("#error-msg").css("display", "none");
                editUser(response.data.id);
            }, 3000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
}

function updateUser(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let first_name = $('#first_name_edit').val();
    let last_name = $('#last_name_edit').val();
    let _token = $('input[id="_token_edit"]').val();
    let id = $('#user_id').val();
    $.ajax({
        type: 'PUT',
        url: site_url+'/users/'+id,
        data: {
            first_name: first_name,
            last_name: last_name,
            id: id,
            _token: _token
        },
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('users', 'userListTableDiv', 'userListTable');
            }
            else{
                $("#error-msg-edit").css("display", "block");
                $('#error-msg-edit').text(response.errormessage);
            }
            setTimeout(function(){
                $("#success-msg-edit").css("display", "none");
                $("#error-msg-edit").css("display", "none");
            }, 3000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
}

function editUser(id){
    $.ajax({
        type: 'GET',
        url: site_url+'/users/'+id+'/edit',
        success: function(response){
            let userinfo = response.userinfo;
            $('#email_edit').val(userinfo.email);
            $('#first_name_edit').val(userinfo.first_name);
            $('#last_name_edit').val(userinfo.last_name);
            $('#user_id').val(userinfo.id);
            var boxWidth = $(".box-inner").width();
            $(".box").animate({
                width: '50%'
            });
            $('#editpanel').show();
            $('#addpanel').hide();
            $(".box").addClass('col-lg-6');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetUserSearch(){
    $('.process-loader-wrapper').show();
    $('#email_search').val('');
    $('#first_name_search').val('');
    $('#last_name_search').val('');
    reloadList('users', 'userListTableDiv', 'userListTable');
}
