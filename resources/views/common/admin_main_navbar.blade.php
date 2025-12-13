<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
	<!-- User Info -->
	<div class="user-info">
		<!--<div class="image">
			@if(Session::get('profile_image_link') != '')
				<img src="{{ url('public/'.Session::get('profile_image_link')) }}" width="48" height="48" alt="User">
			@else
				<img src="{{url('/')}}/public/assets/images/user.png" width="48" height="48" alt="User" />
			@endif
		</div>-->
		<div class="info-container">
			<div class="logo">
            <a href="javascript:void(0);"><img src="{{url('/')}}/public/assets/images/logo.png"></a>
        	</div>
			
		</div>
	</div>
	<!-- #User Info -->
	<!-- Menu -->
	<div class="menu">
		<ul class="list">
			<!--<li class="header">MAIN NAVIGATION</li>-->
			<li id="dashboard">
				<a href="{{url('/')}}/dashboard">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/dashboardIcon.png">
                        </div>
					<span>Dashboard</span>
				</a>
			</li>
			<li id="myprofile"> 
				<a href="{{url('/')}}/my-profile">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/update-profile.png">
                        </div>
					<span>Update Profile</span>
				</a>
			</li>
			<li id="warehouse">
				<a href="{{url('/')}}/warehouses">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/sid-warehouses.png">
                    </div>
					<span>Warehouses</span>
				</a>
			</li>
			<li id="supplier">
				<a href="{{url('/')}}/suppliers">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/sid-leadership.png">
                    </div>
					<span>Principals</span>
				</a>
			</li>
			<li id="uom">
				<a href="{{url('/')}}/uom">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/img-measurement.png">
                    </div>
					<span>Unit of Measurement</span>
				</a>
			</li>
			<li id="category">
				<a href="{{url('/')}}/categories">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/sid-categories.png">
                    </div>
					<span>Categories</span>
				</a>
			</li>
			<li id="product">
				<a href="{{url('/')}}/products">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/sid-product.png">
                    </div>
					<span>Products</span>
				</a>
			</li>
			<li id="materialin">
				<a href="{{url('/')}}/materialin">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/sid-material-in.png">
                    </div>
					<span>Material In</span>
				</a>
			</li>
			<li id="materialout">
				<a href="{{url('/')}}/materialout">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/sid-material-out.png">
                    </div>
					<span>Material Out</span>
				</a>
			</li>
			<li id="stocktransfer">
				<a href="{{url('/')}}/stocktransfer">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/sid-stock-transfer.png">
                    </div>
					<span>Stock Transfer</span>
				</a>
			</li>
			<li id="misreport">
				<a href="{{url('/')}}/misreport">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/sid-dispatch-report.png">
                    </div>
					<span>Dispatch Report</span>
				</a>
			</li>
			<li id="inwardreport">
				<a href="{{url('/')}}/inwardreport">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/sid-stock-transfer-report.png">
                    </div>
					<span>Stock Transfer Report</span>
				</a>
			</li>
			
			<!--<li id="shipmentmenu">
				<a href="javascript:void(0);" class="menu-toggle waves-effect waves-block">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/shipment-icon.png">
                        </div>
					<span>Shipment</span>
				</a>
				<ul id="shipmentmenuul" class="ml-menu" style="display: none;">
                    <li id="shipment">
                        <a href="{{url('/')}}/shipment" class=" waves-effect waves-block">
                            <span>Shipments</span>
                        </a>
                    </li>
					<li id="shipmentrate">
                        <a href="{{url('/')}}/shipmentrate" class=" waves-effect waves-block">
                            <span>Shipment Rate</span>
                        </a>
                    </li>
                </ul>
			</li>
			
			<li id="shipper"> 
				<a href="{{url('/')}}/shipper">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/shipper-icon.png">
                        </div>
					<span>Shippers</span>
				</a>
			</li>
			<li id="inventory">
				<a href="{{url('/')}}/inventory">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/inventory-icon.png">
                        </div>
					<span>Inventories</span>
				</a>
			</li>
			
			<li id="deliveryquote"> 
				<a href="{{url('/')}}/deliveryquote">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/delivery-quotes-icon.png">
                        </div>
					<span>Delivery Quotes</span>
				</a>
			</li>
			<li id="cms">
				<a href="{{url('/')}}/cms">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/content-icon.png">
                        </div>
					<span>Content</span>
				</a>
			</li>
			<li id="block">
				<a href="{{url('/')}}/contentblock">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/content-block-icon.png">
                        </div>
					<span>Content Blocks</span>
				</a>
			</li>
			<li id="banners">
				<a href="{{url('/')}}/banners">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/banner-icon.png">
                        </div>
					<span>Banners</span>
				</a>
			</li>
			<li id="news">
				<a href="{{url('/')}}/news">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/news-icon.png">
                        </div>
					<span>News</span>
				</a>
			</li>-->
			<!--<li id="newsletter">
				<a href="{{url('/')}}/subscriber">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/newsletter-icon.png">
                        </div>
					<span>Newsletter</span>
				</a>
			</li>-->

	    	@if(Session::get('is_admin') == 'Y')
			<li id="adminusersmenu">
				<a href="{{url('/')}}/adminusers">
					<div class="icon">
                             <img src="{{url('/')}}/public/assets/images/userIcon.png">
                        </div>
					<span>Subadmin</span>
				</a>
			</li>
			@endif
			<li id="settings">
				<a href="{{url('/')}}/settings">
					<div class="icon">
                        <img src="{{url('/')}}/public/assets/images/setting-icon.png">
                    </div>
					<span>Settings</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- #Menu -->
</aside>
<!-- #END# Left Sidebar -->
