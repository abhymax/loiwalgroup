$(function () {
    
    
    // Inventory search start
    $('#searchinventoryList').validate({
       
        submitHandler: function(form,e) {
            $(".box").removeClass('open');
            $("#content-area").removeClass('col-lg-6');
            $("#content-area").addClass('col-lg-12');
            searchData('inventorylist', 'searchinventoryList', 'inventoryListTableDiv', 'inventoryListTable'); //module, formid, divToBeReplaced, tableId
        }
    });
    // Shipper search end

    
});

function viewInventory(id){
	$('#upload-file').html('');
	$('#pod_block').html('');
    $.ajax({
        type: 'GET',
        url: site_url+'/viewinventory/'+id,
        success: function(response){
            let inventoryinfo = response.inventoryinfo;
			
            $('#inv_po_edit').html(inventoryinfo.inv_po);
            $('#inv_container_edit').html(inventoryinfo.inv_container);
            $('#inv_tot_pieces_edit').html(inventoryinfo.inv_tot_pieces);
            $('#inv_weight_edit').html(inventoryinfo.inv_weight);
            $('#inv_date_of_arr_edit').html(inventoryinfo.inv_date_of_arr);
			$('#inv_sku_edit').html(inventoryinfo.inv_sku);
			$('#inv_pallet_edit').html(inventoryinfo.inv_pallet);
            $('#inv_cust_name_edit').html(inventoryinfo.inv_cust_name);
            $('#inv_description_edit').html(inventoryinfo.inv_description);
            $('#inv_tot_piece_left_edit').html(inventoryinfo.inv_tot_piece_left);
            
 
			$('#inv-file').html(response.file_details);
			$('#pod_block').html(response.pod_details);
             
            var boxWidth = $(".box-inner").width();
            
            $('#editpanel').show();
          
            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6');
        }
    });
}

function resetInventorySearch(){
    $('.process-loader-wrapper').show();
    $('#inv_po_search').val('');
    $('#inv_container_search').val('');
    $('#inv_cust_name_search').val('');
    $('#inv_sku_search').val('');
    $('#formdate').val('');
    $('#todate').val('');
    location.reload();
}