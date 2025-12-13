@include('common/admin_inner_header')
@include('common/admin_main_navbar')
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-sm-12">
                <div class="fromWrap">
                 <button type="button" class="btn btn-common btn-blue collapseBtn" data-toggle="collapse" data-target="#demo"><i class="material-icons">search</i></button>
                    <div class="card">
                         <div class="searchFormHeader">
                            <div id="demo" class="collapse">
                             <form id="searchmaterialout" class="form-horizontal searchForm" enctype="multipart/form-data" autocomplete="off">
                                <div class="row clearfix">
                                    <div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="invoice_number_search">Number</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="invoice_number_search" name="invoice_number_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="supplier_id_search">Supplier</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <select class="form-control" name="supplier_id_search" id="supplier_id_search">
														    <option value=''>All</option>
															@foreach($data['suppliers'] as $supplier)
															<option value="{{$supplier->supplier_id}}">{{$supplier->supplier_name}}</option>
															@endforeach
															
														</select>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
									
								</div>
								<div class="row clearfix">
										<div class="col-sm-4">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="date_type_search">Invoice Date</label>
                                            </div>
                                            <div class="col-lg-7 col-md-10 col-sm-8 col-xs-7">
                                                
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <div class="input-daterange input-group">
                                                    <div class="col-md-6">
                                                        <div class="form-line">
                                                        <input type="text" id="fromdate" name="from_date" class="form-control" maxlength="10" placeholder="From" autocomplete="off">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-line">
                                                        <input type="text" id="todate" name="to_date" class="form-control" maxlength="10" placeholder="To" autocomplete="off">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
									<div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-sm-3" style="width: 100%;">
                                                <a class="btn-reset waves-effect" onclick="resetInvoiceSearch()">Reset</a>
                                                <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                                <button class="btn btn-blue btn-common  waves-effect" type="submit" id="addbutton">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="contentInner">
                <div class="col-lg-12 innerCards" id="content-area">
                    <div class="card">
                    <div class="header">
                        <h2>
                            Material Out
                        </h2>
						<a class="btn btn-default btn-common waves-effect pull-right" href="{{url('/')}}/materialout/add">Add Record</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive" id="materialoutListTableDiv">
                            @if(isset($data['invoices']) && !empty($data['invoices']))
                                <table id="materialoutListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Number</th>
                                            <th>Invoice Date</th>
											<th>Dispatch Date</th>
											<th>Supplier</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data['invoices'] as $invoice)
                                            <tr>
                                                <td>
													{{ $invoice['invoice_number'] }}
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($invoice['invoice_date'])->format('d/m/Y')}}
                                                </td>
												<td>
                                                    {{ \Carbon\Carbon::parse($invoice['dispatch_date'])->format('d/m/Y')}}
                                                </td>
												<td>
                                                    {{ $invoice['supplier']['supplier_name'] }}
                                                </td>
												
                                                <td>
                                                    <div>
                                                        <a  href="{{url('/')}}/materialout/view/{{$invoice['id']}}" style="cursor:pointer; text-decoration: none">
                                                            <img src="{{url('/')}}/public/assets/images/view.svg" title="view">
                                                        </a>
														
                                                        <!--<a onclick="deleteConfirm({{$invoice['id']}})" style="cursor:pointer; text-decoration: none">
                                                             <img src="{{url('/')}}/public/assets/images/delete.svg">
                                                        </a>-->
														
                                                    </div>
                                                    <!--<div id="delconfirm_{{$invoice['id']}}" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord({{$invoice['id']}}, 'materialin', 'invoiceListTableDiv', 'invoiceListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv({{$invoice['id']}})">No</a>
                                                            </span>
                                                        </div>
                                                    </div>-->
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                @else
                                    No Record Found
                                @endif
                        </div>
                    </div>
                    </div>
                </div>

              
            </div>
        </div>
    </div>
</section>

@include('common/admin_inner_footer')
<link src="{{url('/')}}/public/assets/css/bootstrap-datetimepicker.css">
<script src="{{url('/')}}/public/assets/js/moment.js"></script>
<script src="{{url('/')}}/public/assets/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
    $(function () {
        navigationActivate();
        $('#invoiceListTable').DataTable({
            "searching": false,
            "bDestroy": true
        });
		$('#fromdate,#todate').datetimepicker({
			useCurrent: false,
			format:'YYYY-MM-DD'
		});
		$('#fromdate').datetimepicker().on('dp.change', function (e) {
            var incrementDay = moment(new Date(e.date));
            incrementDay.add(1, 'days');
            $('#todate').data('DateTimePicker').minDate(incrementDay);
            $(this).data("DateTimePicker").hide();
        });

        $('#todate').datetimepicker().on('dp.change', function (e) {
            var decrementDay = moment(new Date(e.date));
            decrementDay.subtract(1, 'days');
            $('#fromdate').data('DateTimePicker').maxDate(decrementDay);
            $(this).data("DateTimePicker").hide();
        });
    });
    function navigationActivate() {
        $('#materialout').addClass('active');
    }
</script>
