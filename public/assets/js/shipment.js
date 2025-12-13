$(function () {

    
    
    // Building update end

    // Shipper search start
    $('#searchshipment').validate({
        
        submitHandler: function(form,e) {
            searchData('shipment', 'searchshipment', 'shipmentListTableDiv', 'shipmentListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Shipper search end
	
	$('.removeAll').on('click', function(e) {
		var studentIdArr = [];
		$(".checkbox:checked").each(function() {
			studentIdArr.push($(this).attr('data-id'));
		});
		if (studentIdArr.length <= 0) {
			alert("Choose min one item to remove.");
		} else {
			if (confirm("Would you like to delete selected shipments?")) {
				var stuId = studentIdArr.join(",");
				$.ajax({
					url: site_url+'/delete-all-shipment',
					type: 'DELETE',
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					data: 'ids=' + stuId,
					dataType: 'json',
					success: function(response){
						if(!response.errorStatus){
							$(".checkbox:checked").each(function() {
								$(this).parents("tr").remove();
							});
							reloadList('shipment', 'shipmentListTableDiv', 'shipmentListTable');
						} else {
							alert('Error occured.');
						}
					},
					error: function(data) {
						alert(data.responseText);
					}
				});
			}
		}
	});
});
function submitSearch(){
    searchData('shipment', 'searchshipment', 'shipmentListTableDiv', 'shipmentListTable'); 
}

function addShipment(){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#addshipment')[0]);
	$.ajaxSetup({
	  headers: {
		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	  }
	});
    $.ajax({
        type: 'POST',
        url: site_url+'/shipment',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg").css("display", "block");
                $('#success-msg').text(response.successmessage);
                reloadList('shipment', 'shipmentListTableDiv', 'shipmentListTable');
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

function updateShipment(){
    $('.process-loader-wrapper').show();
    event.preventDefault();

    let formData = new FormData($('#updateshipment')[0]);

    /*let name = $('#name_edit').val();
    let street = $('#street_edit').val();
    let city = $('#city_edit').val();
    let postal_code = $('#postal_code_edit').val();
    let state_id = $('#state_id_edit').val();*/

    let _token = $('input[id="_token_edit"]').val();
    let id = $('#shipment_id').val();
    $.ajax({
        type: 'POST',
        url: site_url+'/shipment/update/'+id,
        data: formData,
        contentType: false,
        processData: false,
        dataType: 'json',
        success: function(response){
            if(!response.errorStatus){
                $("#success-msg-edit").css("display", "block");
                $('#success-msg-edit').text(response.successmessage);
                reloadList('shipment', 'shipmentListTableDiv', 'shipmentListTable');
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
        url: site_url+'/shipment/addform',
        success: function(response){
            $('.process-loader-wrapper').hide();
            $('#add-form').html(response.add_shipment);
            
        }
    });

}
function editShipment(id){
    $('#add-form').html('');
    $('.process-loader-wrapper').show();
    $.ajax({
        type: 'GET',
        url: site_url+'/shipment/'+id+'/edit',
        success: function(response){
            $('#edit-form').html(response.edit_shipment);
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

function resetShipmentSearch(){
    $('.process-loader-wrapper').show();
    $('#ship_it_search').val('');
    $('#ship_load_search').val('');
    $('#ship_lot_search').val('');
    $('#ship_hbl_search').val('');
    $('#shipper_id_search').val('');
    $('#is_paid_search').val('');
    $('#from_date').val('');
    $('#to_date').val('');
    $("input[name=search_year][value=all]").prop('checked', true);
    reloadList('shipment', 'shipmentListTableDiv', 'shipmentListTable');
}

