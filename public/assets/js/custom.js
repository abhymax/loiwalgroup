$(function () {
    // Slide panel start //
    /*var boxWidth = $(".box-inner").width();
    $(".slide-left").click(function(){
        closePanel();
    });
    $(".slide-right").click(function(){
        $(".box").animate({
            width: '50%'
        });
        $('#addpanel').show();
        $('#editpanel').hide();
        $(".box").addClass('col-lg-6');
        $("#content-area").removeClass('col-lg-12');
        $("#content-area").addClass('col-lg-6');
    });*/
	// Slide panel start //
    var boxWidth = $(".box-inner").width();
    $(".slide-left").click(function(){
        closePanel();
    });
    $(".slide-right").click(function(){
        $('.active_table_row').removeClass('active_table_row');
        if($('.box ').hasClass( "open" )== false){
            /*$(".box").animate({
                right: '50%'
            });*/

            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6 closse');
        }
        $('#addpanel').show();
        $('#editpanel').hide();
		$('#langeditpanel').hide();
		$('#updlangpanel').hide();
		$('#viewpanel').hide();
		$('#mailpanel').hide();
    });
    $(".slide-right-a").click(function(){
        $('.active_table_row').removeClass('active_table_row');
        if($('.box ').hasClass( "open" )== false){
            /*$(".box").animate({
                right: '50%'
            });*/

            $(".box").addClass('open');
            $("#content-area").removeClass('col-lg-12');
            $("#content-area").addClass('col-lg-6 closse');
        }
        $('#addpanel').hide();
        $('#editpanel').hide();
		$('#langeditpanel').hide();
		$('#updlangpanel').show();
		$('#viewpanel').hide();
		$('#mailpanel').hide();
    });
    // Slide panel end //
    // Slide panel end //
});

/* Admin Logout */
$('#admin-logout').on('click',function(event){
    event.preventDefault();
    $.ajax({
        type: 'GET',
        url: site_url+'/logout',
        success: function(response){

            window.location.href = site_url+'/login';
        },
        error: function(response){
            console.log(response);
        }
    })
});

/* Inventory Admin Logout */
$('#inventory-admin-logout').on('click',function(event){
    event.preventDefault();
    $.ajax({
        type: 'GET',
        url: site_url+'/inventory-logout',
        success: function(response){

            window.location.href = site_url+'/inventorylogin';
        },
        error: function(response){
            console.log(response);
        }
    })
});

function reloadList(getURL, divToBeReplaced, tableId){

    $.ajax({
        type: 'GET',
        url: site_url+'/'+getURL,
        success: function(response){
            console.log(response);
            $('#'+divToBeReplaced).html(response);
            if(getURL == 'shipment'){
                $('#'+tableId).DataTable({
                            
                    "searching": false,
                    "pageLength": 50,
                    "aaSorting": [],
					'columnDefs': [ {
						'targets': [6,7], /* column index */
						'orderable': false, /* true or false */
					}]
                });
            } else {
                $('#'+tableId).DataTable({
                            
                    "searching": false,
                    "aaSorting": []
                });
            }
            closePanel();
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log('Error fetching ajax list');
        }
    });
}

function deleteConfirm(id)
{
    var divwidth = $(".slidediv-inner").width();
    $('.slidediv').animate({
        width: 0
    });
    $('#delconfirm_'+id).animate({
        width: divwidth
    });
}
function deleteConfirmImg(id)
{
    var divwidth = $(".slidediv-inner").width();
    $('.slidediv').animate({
        width: 0
    });
    $('#delconfirmimg_'+id).animate({
        width: divwidth
    });
}
function closedeldiv(id)
{
    $('#delconfirm_'+id).animate({
        width: 0
    });
	$('#delconfirmimg_'+id).animate({
        width: 0
    });
}
function delrecord(id,modulelink,div,list)
{
    $('.process-loader-wrapper').show();
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'DELETE',
        url: modulelink+'/' + id,
        success: function(data) {
            $('.process-loader-wrapper').hide();
            reloadList(modulelink, div, list);
            closePanel();
            //$('.item' + data['id']).remove();
        }
    });
}

/*function closePanel(){
    $(".box").animate({
        width: 0
    });
    $(".box").removeClass('col-lg-6');

    setTimeout(function(){
        $("#content-area").removeClass('col-lg-6');
        $("#content-area").addClass('col-lg-12');
    }, 300);
}*/
function closePanel(){
    $('.active_table_row').removeClass('active_table_row');
	$(".box").removeClass('open');
    /*$(".box").animate({
       width: 0
    });*/


    //setTimeout(function(){
        //$(".box").removeClass('col-lg-6');
		$(".box").removeClass('open');
        $("#content-area").removeClass('col-lg-6');
        $("#content-area").addClass('col-lg-12');
    //}, 400);
}

function searchData(module, formid, divToBeReplaced, tableId){
    $('.process-loader-wrapper').show();
    event.preventDefault();
    let formData = new FormData($('#'+formid)[0]);
    $.ajax({
        type: 'POST',
        url: site_url+'/'+module+'/search',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response){
            $('#'+divToBeReplaced).html(response);
            if(module == 'shipment'){
                $('#'+tableId).DataTable({
                            
                    "searching": false,
                    "bDestroy": true,
                    "pageLength": 50,
                    "aaSorting": [],
					'columnDefs': [ {
						'targets': [6,7], /* column index */
						'orderable': false, /* true or false */
					}]
                });
            } else {
                $('#'+tableId).DataTable({
                            
                    "searching": false,
                    "bDestroy": true,
                    "aaSorting": []
                });
            }
            $('.process-loader-wrapper').hide();
        },
        error: function(response){
            console.log(response);
        }
    });
}
