<?php echo $__env->make('common/admin_inner_header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?> 
<?php echo $__env->make('common/admin_main_navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<section class="content">
    <div class="container-fluid">
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-sm-12 shipper-wrap">
                <div class="fromWrap">
                 <button type="button" class="btn btn-common btn-blue collapseBtn" data-toggle="collapse" data-target="#demo"><i class="material-icons">search</i></button>
                    <div class="card">
                         <div class="searchFormHeader">
                            <div id="demo" class="collapse">
                             <form id="searchcategory" class="form-horizontal searchForm" autocomplete="off">
                                <div class="row clearfix">

                                    <div class="col-sm-4">
                                        <div class="row clearfix">
                                            <div class="col-lg-4 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                                <label for="category_name_search">Category Name</label>
                                            </div>
                                            <div class="col-lg-8 col-md-10 col-sm-8 col-xs-7">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <input type="text" id="category_name_search" name="category_name_search" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <a class="btn-reset waves-effect" onclick="resetCategorySearch()">Reset</a>
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <button class="btn btn-blue btn-common  waves-effect" type="submit" id="addbutton">Search</button>
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
                            Categories
                        </h2>
						<a class="btn btn-default btn-common waves-effect pull-right slide-right">Add Category</a>
                    </div>
                    <div class="body">
                        <div class="table-responsive" id="categoryListTableDiv">
                            <?php if(isset($data['categories']) && !empty($data['categories'])): ?>
                                <table id="categoryListTable" class="table table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Description</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $data['categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($category['category_name']); ?>

                                                  
                                                </td>
                                                <td>
                                                    <?php echo e($category['category_description']); ?>

                                                  
                                                </td>
												
                                                <td>
                                                    <div>
                                                        <a onclick="editCategory(<?php echo e($category['category_id']); ?>)" style="cursor:pointer; text-decoration: none">
                                                            <img src="<?php echo e(url('/')); ?>/public/assets/images/edit.svg">
                                                        </a>
														<?php if($category['product_count']<=0): ?>
                                                        <a onclick="deleteConfirm(<?php echo e($category['category_id']); ?>)" style="cursor:pointer; text-decoration: none">
                                                            <!--<i class="material-icons">delete</i>-->
                                                             <img src="<?php echo e(url('/')); ?>/public/assets/images/delete.svg">
                                                        </a>
														<?php endif; ?>
                                                    </div>
                                                    <div id="delconfirm_<?php echo e($category['category_id']); ?>" class="slidediv">
                                                        <div class="slidediv-inner">
                                                            <span class="label">
                                                                Would you like to delete?
                                                                <a href="javascript:;" onclick="delrecord(<?php echo e($category['category_id']); ?>, 'categories', 'categoryListTableDiv', 'categoryListTable')">Yes</a> | <a href="javascript:;" onclick="closedeldiv(<?php echo e($category['category_id']); ?>)">No</a>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                                <?php else: ?>
                                    No Record Found
                                <?php endif; ?>
                        </div>
                    </div>
                    </div>
                </div>

                <div class="box col-lg-6 right-panel-big" style="width:100% !important;">
                    <div class="card innerCards">
                        <div id="addpanel">
                            <div class="header">
                                <h2>
                                    Add Category
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body">
                                <form id="addCategory" class="form-horizontal" autocomplete="off">
                                    <div class="formwrap">
										<div class="row clearfix">
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="category_name">Category Name<span class="col-pink">*</span></label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<input type="text" id="category_name" name="category_name" class="form-control" maxlength="30">
													</div>
												</div>
											</div>
											<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
												<label for="category_description">Description </label>
											</div>
											<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
												<div class="form-group">
													<div class="form-line">
														<textarea id="category_description" name="category_description" class="form-control" maxlength="350"></textarea>
													</div>
												</div>
											</div>
											
										</div>
										
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-12">
                                        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>"/>
                                        <button class="btn btn-blue btn-common waves-effect" type="submit" id="addbutton">Save</button>
                                        <span class="font-bold col-pink" id="error-msg"></span>
                                        <span class="font-bold col-teal" id="success-msg"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div id="editpanel">
                            <div class="header">
                                <h2>
                                    Edit Category
                                </h2>
                                <a href="javascript:;" class="slide-left closeIcon"><i class="material-icons pull-right">clear</i></a>
                            </div>
                            <div class="body">
                                <form id="updatecategory" class="form-horizontal" autocomplete="off">
									<div class="formwrap">
										<div class="row clearfix">
												<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
													<label for="category_name">Category Name<span class="col-pink">*</span></label>
												</div>
												<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
													<div class="form-group">
														<div class="form-line">
															<input type="text" id="category_name_edit" name="category_name" class="form-control" maxlength="30">
														</div>
													</div>
												</div>
												<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
													<label for="category_description">Description </label>
												</div>
												<div class="col-lg-4 col-md-10 col-sm-8 col-xs-7">
													<div class="form-group">
														<div class="form-line">
															<textarea id="category_description_edit" name="category_description" class="form-control" maxlength="350"></textarea>
														</div>
													</div>
												</div>
												
												
										</div>
									
									 
                                    </div>
                                    <input type="hidden" id="_token_edit" name="_token" value="<?php echo csrf_token(); ?>"/>
                                    <input type="hidden" name="category_id" id="category_id" value=""/>

                                    <div class="row clearfix">
                                        <div class="col-lg-12">
                                        <button class="btn btn-blue btn-common waves-effect" type="submit" id="editbutton">Update</button>
                                        <span class="font-bold" id="success-msg-edit" style="display:none"></span>
                                        <span class="font-bold" id="error-msg-edit" style="display:none"></span>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php echo $__env->make('common/admin_inner_footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<script type="text/javascript">
    $(function () {
        navigationActivate();
        $('#categoryListTable').DataTable({
            "searching": false,
            "bDestroy": true
        });
    });
    function navigationActivate() {
        $('#category').addClass('active');
    }
</script>
<?php /**PATH /home/j7lo9g5r3sz/public_html/portal.loiwalgroup.com/resources/views/category/category_list.blade.php ENDPATH**/ ?>