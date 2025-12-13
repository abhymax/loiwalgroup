$(function () {
    $.validator.addMethod(
        "money",
        function(value, element) {
            var isValidMoney = /^\d{0,4}(\.\d{0,2})?$/.test(value);
            return this.optional(element) || isValidMoney;
        },
        "Insert "
    );
    $('#addcontract').validate({
        rules: {
            
            'contract_amount': {
                money: true
            }
        },
        highlight: function (input) {
            console.log(input);
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
            event.preventDefault();
            $('#addcontractbutton').attr("disabled", "disabled");
            let formData = new FormData($('#addcontract')[0]);
            $.ajax({
                type: 'POST',
                url: site_url+'/contracts',
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    if(!response.errorStatus){
                        $('#addcontract').find('input:text').val(''); 
                        $('#addcontract').find('input:file').val(''); 
                        $("#success-msg").css("display", "block");
                        $('#success-msg').text(response.successmessage);
                        reloadList('contracts', 'contractDiv', 'contractList');
                    }
                    else{
                        $("#error-msg").css("display", "block");
                        $('#error-msg').text('Please fill form properly');
                    }
                    setTimeout(function(){
                        $("#success-msg").css("display", "none");
                        $("#error-msg").css("display", "none");
                        editContract(response.data.id);
                    }, 3000);
                    $('#addbutton').removeAttr("disabled");
                    
                },
                error: function(response){
                    console.log(response);
                }
            })
        }
    });

    $('#editcontract').validate({
        rules: {
            'family_member_no_edit': {
                digits: true
            }
        },
        highlight: function (input) {
            console.log(input);
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
            event.preventDefault();
            $('#editcontractbutton').attr("disabled", "disabled");
            let formData = new FormData($('#editcontract')[0]);
            let id = $('#contract_id').val();
            
            $.ajax({
                type: 'POST',
                url: site_url+'/contracts/update/'+id,
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    if(!response.errorStatus){
                        $("#success-msg-edit").css("display", "block");
                        $('#success-msg-edit').text(response.successmessage);
                        reloadList('contracts', 'contractDiv', 'contractList');
                    }
                    else{
                        $("#error-msg-edit").css("display", "block");
                        $('#error-msg-edit').text('Please fill form properly');
                    }
                    setTimeout(function(){
                        editContract(response.data.id);
                        $("#success-msg-edit").css("display", "none");
                        $("#error-msg-edit").css("display", "none");
                    }, 3000);
                    $('#editcontractbutton').removeAttr("disabled");
                },
                error: function(response){
                    console.log(response);
                }
            })
        }
    });
    $('#addNotes').validate({
        rules: {
            'note': {
                required: true
            }
        },
        highlight: function (input) {
            console.log(input);
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
            event.preventDefault();
            $('#notebutton').attr("disabled", "disabled");
            let formData = new FormData($('#addNotes')[0]);
            let id = $('#contractid').val();
            
            $.ajax({
                type: 'POST',
                url: site_url+'/contracts/addnotes/'+id,
                data: formData,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function(response){
                    if(!response.errorStatus){
                        $("#success-msg-note").css("display", "block");
                        $('#success-msg-note').text(response.successmessage);
                       
                    }
                    else{
                        $("#error-msg-note").css("display", "block");
                        $('#error-msg-note').text('Please fill form properly');
                    }
                    setTimeout(function(){
                        contractNotes(response.contractid);
                        $("#success-msg-note").css("display", "none");
                        $("#error-msg-note").css("display", "none");
                    }, 3000);
                    $('#notebutton').removeAttr("disabled");
                },
                error: function(response){
                    console.log(response);
                }
            })
        }
    });
    // Contract search start
    $('#searchcontract').validate({
        rules: {
            /*'flat_no': {
                required: true
            },
            'building_id': {
                required: true
            }*/
        },
        messages: {
            flat_no: 'This field is required',
            building_id: 'This field is required'
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
            searchData('contracts', 'searchcontract', 'contractDiv', 'contractList'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Contract search end
});


function getflats()
{
    var buildingid = $('#building_id').val();
    //$('#flat_id')
    $.ajax({
        type: 'GET',
        url: site_url+'/contracts/getflat/'+buildingid,
        success: function(response){
            $("#flat_id").empty();
            $("#flat_id").append('<option value="">-- Select --</option>');
            $.each(response,function(key,value){
                $("#flat_id").append('<option value="'+key+'">'+value+'</option>');
            });
        }

    })
}
function filterFlat()
{
    var buildingid = $('#building_id_search').val();
    //$('#flat_id')
    $.ajax({
        type: 'GET',
        url: site_url+'/contracts/getflat/'+buildingid,
        success: function(response){
            $("#flat_id_search").empty();
            $("#flat_id_search").append('<option value="">All</option>');
            $.each(response,function(key,value){
                $("#flat_id_search").append('<option value="'+key+'">'+value+'</option>');
            });
        }

    })
}
function createContractno()
{
    var buildingid = $('#building_id').val();
    var flatid = $('#flat_id').val();
    $.ajax({
        
            type: 'GET',
            url: site_url+'/contracts/createcontractno/'+buildingid+'/'+flatid,
            success: function(response){
              $('#contract_no').val(response);
            }
       
    })
}
function editContract(id)
{
    $.ajax({
        type: 'GET',
        url: site_url+'/contracts/'+id+'/edit',
        success: function(response){
            var contractinfo = response.contractinfo;
            $('#contract_no_edit').html(contractinfo.contract_no);
            $('#building').html(contractinfo.buildings.name);
            $('#flat').html(contractinfo.flats.flat_no);
            $('#tenant_edit').html(contractinfo.tenants.first_name+' '+contractinfo.tenants.last_name);
            $('#contract_amount_edit').val(contractinfo.contract_amount);
            $('#contract_date_edit').val(contractinfo.contract_date);
            $('#commencement_date_edit').val(contractinfo.commencement_date);
            $('#expiry_date_edit').val(contractinfo.expiry_date);
            $('#contract_notes_edit').val(contractinfo.contract_notes);
            if(contractinfo.contract_documents.length>0){
                var dochtml = '<div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label"><label for="document">Documents </label></div>';
                for(var i=0;i<contractinfo.contract_documents.length;i++)
                {
                    
                    dochtml = dochtml+'<div class="col-lg-8 col-md-10 col-sm-8 col-xs-7 "><a href="'+site_url+'/public/'+contractinfo.contract_documents[i].file_url+'">'+contractinfo.contract_documents[i].file_name+'</a><i class="material-icons" title="remove" onclick="removeFile('+contractinfo.contract_documents[i].id+','+contractinfo.id+')">clear</i></div>';
                }
                $('#documentdiv').html(dochtml);
            } else {
                $('#documentdiv').html('');
            }
            
            $('#contract_id').val(contractinfo.id);
            var boxWidth = $(".box-inner").width();
            $(".box").animate({
                width: '50%'
            });
            $('#editpanel').show();
            $('#addpanel').hide();
            $('#notepanel').hide();
            $(".box").addClass('col-lg-6');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    })    
    
    
}
function contractNotes(id)
{
    $.ajax({
        type: 'GET',
        url: site_url+'/contracts/notes/'+id,
        success: function(response){
            $(".box").animate({
                width: '50%'
            });
            
            $('#editpanel').hide();
            $('#addpanel').hide();
            $('#notepanel').show();
            $('#noteslist').html(response);
            $('#contractid').val(id);
            $(".box").addClass('col-lg-6');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    })
}
function removeFile(id,cid)
{
    $.ajax({
        type: 'GET',
        url: site_url + '/contracts/delete-documents/' + id +'/'+ cid,
        success: function (response) {
            var contractinfo = response.contractinfo;
            if(contractinfo.contract_documents.length>0){
                var dochtml = '<div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label"><label for="document">Documents </label></div>';
                for(var i=0;i<contractinfo.contract_documents.length;i++)
                {
                    
                    dochtml = dochtml+'<div class="col-lg-8 col-md-10 col-sm-8 col-xs-7 "><a href="'+site_url+'/public/'+contractinfo.contract_documents[i].file_url+'">'+contractinfo.contract_documents[i].file_name+'</a><i class="material-icons" title="remove" onclick="removeFile('+contractinfo.contract_documents[i].id+','+contractinfo.id+')">clear</i></div>';
                }
                $('#documentdiv').html(dochtml);
            }  else {
                $('#documentdiv').html('');
            }
            
        },
        error: function (response) {
          location.reload();
        }
      })
}
function resetContractSearch(){
    $('.process-loader-wrapper').show();
    $('#building_id_search').val('');
    $('#contract_no_search').val('');
    $('#flat_id_search').val('');
    $('#tenant_id_search').val('');
    $('#from_date').val('');
    $('#to_date').val('');
    reloadList('contracts', 'contractDiv', 'contractList');
}
