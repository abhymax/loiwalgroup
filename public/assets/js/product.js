$(function () {

    
    
  

    // Product search start
    $('#searchproduct').validate({
        
        submitHandler: function(form,e) {
            searchData('products', 'searchproduct', 'productListTableDiv', 'productListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Product search end
	
	
});
function submitSearch(){
    searchData('products', 'searchproduct', 'productListTableDiv', 'productListTable');
}


function addProduct(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addProduct')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/products',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                reloadList('products', 'productListTableDiv', 'productListTable');
            }
            else{
                $("#error-msg").css("display", "block");
                $('#error-msg').text('Please fill form properly');
            }
            setTimeout(function(){
                $("#success-msg").css("display", "none");
                $("#error-msg").css("display", "none");
               // editBulding(response.data.id);
            }, 3000);
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
}

function updateProduct(){
    $('.process-loader-wrapper').show();
    event.preventDefault();

    let formData = new FormData($('#updateproduct')[0]);

   
    let _token = $('input[id="_token_edit"]').val();
    let id = $('#product_id').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/products/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('products', 'productListTableDiv', 'productListTable');
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
function back(){
	$(".box").removeClass('open');
    $("#content-area").removeClass('col-lg-6');
    $("#content-area").addClass('col-lg-12');
}
function showForm(){
    $('.process-loader-wrapper').show();
    $('#edit-form').html('');
    $.ajax({
        type: 'GET',
        url: site_url+'/products/addform',
        success: function(response){
            $('.process-loader-wrapper').hide();
            $('#add-form').html(response.add_product);
            
        }
    });

}
function editShipment(id){
    $('#add-form').html('');
    $('.process-loader-wrapper').show();
    $.ajax({
        type: 'GET',
        url: site_url+'/products/'+id+'/edit',
        success: function(response){
            $('#edit-form').html(response.edit_product);
            $('.process-loader-wrapper').hide();
            var boxWidth = $(".box-inner").width();
            $('#editpanel').show();

            $('#addpanel').hide();
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetProductSearch(){
    $('.process-loader-wrapper').show();
    $('#product_name_search').val('');
    $('#product_sku_search').val('');
    $('#supplier_id_search').val('');
    reloadList('products', 'productListTableDiv', 'productListTable');
}
function saveCat()
{
    if($('#category_name').val()=='')
    {
       $('#category_name').css('border' , '1px solid red');
    } else {
		let formData =  new FormData()
		formData.append('category_name', $('#category_name').val())
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: 'POST',
			url: site_url+'/products/addCategory',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response){
				if(!response.errorStatus){
					$('#category_name').css('border' ,'');
					showForm();
				} else {
					$('#category_name').css('border' , '1px solid red');
					$("#error-cat").css("display", "block");
					$('#error-cat').text(response.errormessage);
				}
			},
			error: function(response){
				console.log(response);
			}
		});
	} 
    	
}
function saveUom()
{
    if($('#uom_name').val()=='')
    {
       $('#uom_name').css('border' , '1px solid red');
    } else {
		let formData =  new FormData()
		formData.append('uom_name', $('#uom_name').val())
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: 'POST',
			url: site_url+'/products/addUom',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response){
				if(!response.errorStatus){
					$('#uom_name').css('border' ,'');
					showForm();
				} else {
					$('#uom_name').css('border' , '1px solid red');
					$("#error-uom").css("display", "block");
					$('#error-uom').text(response.errormessage);
				}
			},
			error: function(response){
				console.log(response);
			}
		});
	} 
    	
}
function saveSupplier()
{
	var error = 0;
	if($('#supplier_number').val()=='')
	{
		$('#supplier_number').css('border' , '1px solid red');
		error = 1;
	} else {
		$('#supplier_number').css('border' , '');
	}
	if($('#supplier_name').val()=='')
	{
		$('#supplier_name').css('border' , '1px solid red');
		error = 1;
	} else {
		$('#supplier_name').css('border' , '');
	}
	if($('#supplier_email').val()=='')
	{
		$('#supplier_email').css('border' , '1px solid red');
		error = 1;
	} else {
		$('#supplier_email').css('border' , '');
	} 
	if($('#supplier_mobile_number').val()=='')
	{
		$('#supplier_mobile_number').css('border' , '1px solid red');
		error = 1;
	} else {
		$('#supplier_mobile_number').css('border' , '');
	} 
	if(error == 0)
	{
		let formData =  new FormData()
		formData.append('supplier_number', $('#supplier_number').val())
		formData.append('supplier_name', $('#supplier_name').val())
		formData.append('supplier_email', $('#supplier_email').val())
		formData.append('supplier_mobile_number', $('#supplier_mobile_number').val())
		$.ajaxSetup({
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: 'POST',
			url: site_url+'/products/addSupplier',
			data: formData,
			contentType: false,
			processData: false,
			success: function(response){
				if(!response.errorStatus){
					$('#supplier_number').css('border' ,'');
					$('#supplier_name').css('border' ,'');
					$('#supplier_email').css('border' ,'');
					$('#supplier_mobile_number').css('border' ,'');
					showForm();
				} else {
					$("#error-supplier").css("display", "block");
					$('#error-supplier').text('Please provide unique value');
				}
			   
			},
			error: function(response){
				console.log(response);
			}
		});
	}
	
}
