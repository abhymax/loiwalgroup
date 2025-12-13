$(function() {
	/*$('#addshipment').validate({
       
        submitHandler: function(form,e) {
            addShipment();
        }
    });*/
	/*$('#updateshipment').validate({
        
        submitHandler: function(form,e) {
            updateShipment();
        }
    });*/
    var settings = {
		url: site_url+'/uploadimage',
		method: "POST",
		allowedTypes:"jpeg,JPG,png,PNG,gif,GIF,pdf,msg,MSG",
		fileName: "myfile",
		multiple: true,
		onSuccess:function(files,data,xhr)
		{
			$("#upload-files-pdf").append("<input type='hidden' name='uploaded_files[]' value='"+data+"'/>");
			$("#status").html("<font color='green'>Upload is success</font>");
			
		},
		afterUploadAll:function()
		{
			//alert("all images uploaded!!");
		},
		onError: function(files,status,errMsg)
		{		
			$("#status").html("<font color='red'>Upload is Failed</font>");
		}
	}
	$("#mulitplefileuploader").uploadFile(settings);
});

$('#shipper_id').change(function(){

    var shipper = $('#shipper_id option:selected').text();
    $('#per').val(shipper);
	$('#shipper').val(shipper);
});
function doCalculate()
{
   
	var totald2,discount,grand_total;
	
	totald2 = NumericCheck((NumericCheck($('#handling_due').val())+NumericCheck($('#import_service_fee').val())+NumericCheck($('#documentation_fee').val())+NumericCheck($('#surcharge').val())+NumericCheck($('#pallets').val())+NumericCheck($('#storage_due').val())+NumericCheck($('#delivery_charge').val())));
	
	totald2=parseFloat(totald2);
	
	$('#total').val(totald2.toFixed(2));
    calculateDue();
}

function NumericCheck(vVal)
{	
	
	if(vVal!="")
	{
		var vVal=parseFloat(vVal);
		if(isNaN(vVal))
		{
			return 0;
		}
		else
		{
			return parseFloat(vVal);
			
		}
	}
	else
	{
		return 0;
	}
}
function override_click(chk)
{
    if(chk.checked==true)
    {
        $('#storage_due').attr('readonly',false);
    }
    else
    {
        $('#storage_due').attr('readonly',true);
    }
}
function doCalstorage()
{	
	
	if($('#storage_due').attr('readonly')==false){
		return false;
	}

	var arr3= new Array(3);
	var mon3;
	var go_date = $('#go_date').val();
		arr3=go_date.split("-") ;
		switch(arr3[1])
		{
			case "01": mon3="jan";
						break;
			case "02": mon3="feb";
						break;
			case "03": mon3="mar";
						break;
			case "04": mon3="apr";
						break;
			case "05": mon3="may";
						break;
			case "06": mon3="jun";
						break;
			case "07": mon3="jul";
						break;
			case "08": mon3="aug";
						break;
			case "09": mon3="sep";
						break;
			case "10": mon3="oct";
						break;
			case "11": mon3="nov";
						break;
			case "12": mon3="dec";
						break;
			
		}
	var go_format=mon3+","+arr3[2]+","+arr3[0];
	var flag=1;
	 
	var go_sec = Date.parse(go_format);
	
	var cur_date=new Date($('#serverdate').val());
	var cur_sec = Date.parse(cur_date);
	if((go_sec<cur_sec) && !($('#customs_release').is(':checked')))
	{
		flag=2;
    }
	
	
	//var d = Date.parse("Jul 8, 2005")
	if($('#storage_date').val()!="" || parseFloat($('#weight').val())>1500.00)
	{
		var arr1 = new Array(3);
		var arr2 = new Array(3);
		var mon;
		var mon2;

	 	var dss=$('#storage_date').val();
		arr1=dss.split("-") ;
		//alert("sssdue=>"+arr1[0]+arr1[1]+arr1[2]);
		switch(arr1[1])
		{
			case "01": mon="jan";
						break;
			case "02": mon="feb";
						break;
			case "03": mon="mar";
						break;
			case "04": mon="apr";
						break;
			case "05": mon="may";
						break;
			case "06": mon="jun";
						break;
			case "07": mon="jul";
						break;
			case "08": mon="aug";
						break;
			case "09": mon="sep";
						break;
			case "10": mon="oct";
						break;
			case "11": mon="nov";
						break;
			case "12": mon="dec";
						break;
			
		}

		if($('#storage_end_date').val()!="" && $('#storage_end_date').val()!="0000-00-00" )
		{
			
			var dsg=$('#storage_end_date').val();
			
			arr2=dsg.split("-") ;
			switch(arr2[1])
			{
				case "01": mon2="jan";
							break;
				case "02": mon2="feb";
							break;
				case "03": mon2="mar";
							break;
				case "04": mon2="apr";
							break;
				case "05": mon2="may";
							break;
				case "06": mon2="jun";
							break;
				case "07": mon2="jul";
							break;
				case "08": mon2="aug";
							break;
				case "09": mon2="sep";
							break;
				case "10": mon2="oct";
							break;
				case "11": mon2="nov";
							break;
				case "12": mon2="dec";
							break;
			
			}
			
			var dg_format=mon2+","+arr2[2]+","+arr2[0];
			
		}
		else
		{
			var  dg_format=new Date($('#serverdate').val());
		}
		
		if(parseFloat($('#weight').val())>2400.00)          
		{	
			var weight=parseFloat($('#weight').val());
			if(flag==2){
				var dol_lb=2*(parseFloat(weight)*.025);                        
			}
			else {
				var dol_lb=(parseFloat(weight)*.025);
			}
			
		}
		else
		{
			if(flag==2)
				var dol_lb=120;
			else
				var dol_lb=60;
		}
		
		////day
		var ds_format=mon+","+arr1[2]+","+arr1[0];
		
		var ds = Date.parse(ds_format);
		var dg = Date.parse(dg_format);
		
		var dd=parseInt(dg)-parseInt(ds);//parseInt("10") 
		var dd_day=((((parseInt(dd)/1000)/3600)/24)+1);
		
		var st_ob = new Date(ds_format) ;//"March 21, 1992"
		var st_day_name = st_ob.getDay(  );
		//console.log(st_day_name);
		
		if(parseFloat(dd_day)>0)
		{
            var ww_days=parseInt(dd_day);
         	var dol=(parseInt(ww_days)*parseFloat(dol_lb));
			if(isNaN(dol))
				dol=0;
			var dol2d=parseFloat(dol);
            $('#storage_due').val(dol2d.toFixed(2));
	
		}
		else
		{
			$('#storage_due').val(0);
		}
	}
	else
	{
		$('#storage_due').val(0);
    }
	
}
function doCalperday()
{	
	
	var arr3= new Array(3);
	var mon3;
	var go_date=$('#go_date').val();
		arr3=go_date.split("-") ;
		switch(arr3[1])
		{
			case "01": mon3="jan";
						break;
			case "02": mon3="feb";
						break;
			case "03": mon3="mar";
						break;
			case "04": mon3="apr";
						break;
			case "05": mon3="may";
						break;
			case "06": mon3="jun";
						break;
			case "07": mon3="jul";
						break;
			case "08": mon3="aug";
						break;
			case "09": mon3="sep";
						break;
			case "10": mon3="oct";
						break;
			case "11": mon3="nov";
						break;
			case "12": mon3="dec";
						break;
			
		}
		
	var go_format=mon3+","+arr3[2]+","+arr3[0];
	var flag=1;
	
	//alert("sssduego_date"+document.form1.go_date.value);
	var go_sec = Date.parse(go_format);
	var cur_date=new Date($('#serverdate').val());
	
	
	var cur_sec = Date.parse(cur_date);
	
	if((go_sec<cur_sec) && !($('#customs_release').is(':checked')))
	{
		
		 flag=2;
		
	}
	
	
	if(parseFloat($('#weight').val())>2400.00)	 
	{
		var weight=parseFloat($('#weight').val());
		var dol_lb=(parseFloat(weight)*.025);                           
		if(flag==2)
			dol_lb=2*parseFloat(dol_lb);
		
		var dol_lb2=parseFloat(dol_lb);
		$('#storage_per_day').val(dol_lb2.toFixed(2));
		
	}
	else
	{
		if(flag==2)
		{
		
			$('#storage_per_day').val(120.00);		
		}
		else
		{
			$('#storage_per_day').val(60.00);      
			
		}
	}
	if(!$('#storage_override').is(':checked'))
	{
		doCalstorage();
	}
	doCalculate();
}
function numbersonly(myfield, e, dec)
{
	var key;
	var keychar;
	if (window.event)
	key = window.event.keyCode;
	else if (e)
	key = e.which;
	else
	return true;
	keychar = String.fromCharCode(key);	
	// control keys
	if ((key==null) || (key==0) || (key==8) || 
	(key==9) || (key==13) || (key==27))
	return true;
	// numbers
	else if ((("0123456789").indexOf(keychar) > -1))
	return true;
	// decimal point jump
	else if (dec && (keychar == "."))
	{
	myfield.form.elements[dec].focus();
	return false;
	}
	else
	return false;
}

function calculateHandling(handling_minimum,handling_multiply_by){
	var weight = parseFloat($('#weight').val());
	if(weight<=1111){
		$('#handling_due').val(handling_minimum);
	}
	if(weight>1111){
		$('#handling_due').val((weight * handling_multiply_by).toFixed(2));
	}
	doCalculate();
	doCalperday();
}
function chkClick(fld,dtfld)
{
	var d = new Date();	
	var current_date = d.getFullYear()+'-'+("0" + (d.getMonth() + 1)).slice(-2)+'-'+("0" + d.getDate()).slice(-2);
	var current_time = ("00" + d.getHours()).substr(-2)+':'+("00" + d.getMinutes()).substr(-2);
	if($(fld).is(":checked")) {
	    $('#'+dtfld).val(current_date);
		if($(fld).attr('id')=='customs_release') {
	     	$('#customrelease_time').val(current_time);
		}
	} else {
		$('#'+dtfld).val('');
		if($(fld).attr('id')=='customs_release') {
	    	$('#customrelease_time').val('');
		}
	}
}
function addmoreblock()
{
	var cur_block=parseInt($('#block_count').val());
	var new_block_id=cur_block;
	var payment_info=parseInt(new_block_id)+1;
	
	$('#table_block').append('<tr id="tr_block_'+new_block_id+'"><td>Payment Info'+parseInt(payment_info)+'</td><td><input type="text" name="payee_'+new_block_id+'" value="" /></td><td><input type="text" name="order_number_'+new_block_id+'" value=""/></td><td><input type="text" name="payment_method_'+new_block_id+'" value=""  /></td><td><input type="text" name="paid_amount_'+new_block_id+'"  id="paid_amount_'+new_block_id+'" value="" class="paid_amount" onKeyPress="return numbersonly(this, event)" onChange="calculateDue()"/></td><td><input type="text" name="payment_note_'+new_block_id+'" value="" /></td><td><input type="text" class="payment_info_date"  name="payment_date_'+new_block_id+'" value="" /></td><td><input type="hidden" value="" name="payment_details_id_'+new_block_id+'" id="payment_details_id_'+new_block_id+'" /><a href="javascript:;" onclick="deleteConfirm(\''+new_block_id+'\');"><img src="public/assets/images/delete.svg" style="width: 20px;"></a><div id="delconfirm_'+new_block_id+'" class="slidediv"><div class="slidediv-inner"><span class="label">Would you like to delete?<a href="javascript:;" onclick="delinfo(\''+new_block_id+'\');">Yes</a> | <a href="javascript:;" onclick="closedeldiv(\''+new_block_id+'\')">No</a>	</span></div></div></td></tr>');
	
	$('#block_count').val(new_block_id+1);
	$('.payment_info_date').datetimepicker({
	    useCurrent: false,
		format:'YYYY-MM-DD'
	});
}
function delinfo(blockid)
{
	var details_id=$('#payment_details_id_'+blockid).val();
	var del_val=$('#paid_amount_'+blockid).val();
	$('.process-loader-wrapper').show();
    event.preventDefault();
	if(details_id!=''){
		$.ajax({
			type: 'GET',
			url: site_url+'/shipment/delpayment/'+details_id,
			success: function(response){
				if(!response.errorStatus){
					$('.process-loader-wrapper').hide();
					$('#tr_block_'+blockid).remove();
					var cur_block=parseInt($('#block_count').val());
					$('#block_count').val(cur_block-1);
					calculateDue();
				}
				
			}
		});
	} else {
		$('.process-loader-wrapper').hide();
		$('#tr_block_'+blockid).remove();
		var cur_block=parseInt($('#block_count').val());
		$('#block_count').val(cur_block-1);
		calculateDue();
	}
	
}
function delimg(imgid)
{
    $('.process-loader-wrapper').show();
    event.preventDefault();
	
		$.ajax({
			type: 'GET',
			url: site_url+'/delshipmentfile/'+imgid,
			success: function(response){
				if(!response.errorStatus){
					$('.process-loader-wrapper').hide();
					$('#shipment_image_'+imgid).remove();
					//var cur_block=parseInt($('#block_count').val());
					//$('#block_count').val(cur_block-1);
					//calculateDue();
				}
				
			}
		});
	
}

function addDiv(id)
{
	$('#delconfirm_'+id).addClass('del-img');
}
function removeDiv(id)
{
	$('#delconfirm_'+id).removeClass('del-img');
}
/*function calculate_total(value_amt)
{	
	
	if(value_amt.value!='')
	{
	
	var amount= $('#total_amt_hide').val();
	if(amount=='')
	{
		amount=0;
	}
	var deduct_amount= $('#balance_amt_hide').val();
	total_amt=parseFloat(value_amt.value)+parseFloat(amount);
	balance_amt=parseFloat(deduct_amount)-parseFloat(value_amt.value);
	
	total_amt=total_amt.toFixed(2);
	balance_amt=balance_amt.toFixed(2);
	
	
	
		j('#total_amt_hide').val(total_amt);
		j('#balance_amt_hide').val(balance_amt);
	
		j('#total_amt').val(total_amt);
		j('#balance_amt').val(balance_amt);
	}	
}
function calculate_reset_total(value_amt)
{
	if(value_amt.value!='')
	{
	amount= $('#total_amt').val();
	if(amount=='')
	{
		amount=0;
	}
	deduct_amount= $('#balance_amt').val();
	total_amt=parseFloat(amount)-parseFloat(value_amt.value);
	balance_amt=parseFloat(deduct_amount)+parseFloat(value_amt.value);
	
	total_amt=total_amt.toFixed(2);
	balance_amt=balance_amt.toFixed(2);
	
	//var str_total='<input type="text" value="+total_amt+" name="total_amt" id="total_amt" />';
			
		j('#total_amt_hide').val(total_amt);
		j('#balance_amt_hide').val(balance_amt);
	}
}*/

function calculateDue()
{
    var pamt = document.getElementsByClassName("paid_amount");
	var total_paid = 0.00;
	for(var i=0; i<pamt.length; i++)
	{
		if($("#paid_amount_"+i).val()!='')
		{
		    var amt =  $("#paid_amount_"+i).val();
			
			total_paid = parseFloat(total_paid)+parseFloat(amt);
			total_paid = total_paid.toFixed(2);
		}
	}
	
	var grand_total = $("#total").val();
	var due_amt = parseFloat(grand_total) - parseFloat(total_paid);
	
	$("#grand_total").val(due_amt.toFixed(2));
	$('#total_amt').val(total_paid);
}
function openWindow(id){
	var width  = 800;
	var height = 400;
	var left   = (screen.width  - width)/2;
	var top    = (screen.height - height)/2;
	var params = 'width='+width+', height='+height;
	params += ', top='+top+', left='+left;
	params += ', directories=no';
	params += ', location=no';
	params += ', menubar=no';
	params += ', resizable=no';
	params += ', scrollbars=yes';
	params += ', status=no';
	params += ', toolbar=no';
	newwin=window.open(site_url+'/shipment/printbarcode/'+id,'Print Barcode', params);
	if (window.focus) {newwin.focus()}
	return false;
	
}