<!DOCTYPE html>
<html>
<head>
    <title>View Account Details</title>
	<!--------Include Css file ----->
    <?= view('custome_file/js_file'); ?> 
    <!--------Include Css file ----->
</head>
<body>
<!----Navbar file Include ---->
<?= view('MainDashboard/navbar'); ?> 	
<!----Navbar file Include ---->	
<!-----Left Side Bar Section Include ---->
<?= view('MainDashboard/left_sidebar'); ?> 
<!-----Left Side Bar Section Include ---->

<!----------Body Section Start  ---------->
 <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <!-- ============================================================== -->
              <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                   <div class="card card-fluid">
                        <div class="card-img-top">
                        	<img src="<?= base_url('public/assets/images/mlm.png') ?>" alt="" class=" img-fluid" style="width: 100%;height: 200px;">
                        	
                        </div>
                                <!-- .card-body -->
                        <div class="card-body text-center">
                                    <!-- .user-avatar -->
                        <a href="user-profile.html" class="user-avatar user-avatar-floated user-avatar-xl">
                        	<?php if($userdata->profile): ?>
                            	<img src="<?= base_url('public/uploads/user_image/'.$userdata->profile); ?>" alt="User Avatar" class="rounded-circle user-avatar-xl">
                            <?php else: ?>
                            	<img src="<?= base_url('public/assets/images/binar.png'); ?>" alt="User Avatar" class="rounded-circle user-avatar-xl">
                            <?php endif; ?>
                            
                         </a>
                                    <!-- /.user-avatar -->
                        <h3 class="card-title mb-2">
                        	<a href="#!"><?= $userdata->name; ?></a>
                        </h3>
                        <h6 class="card-subtitle text-muted mb-3"> <a href="mailto:<?= $userdata->email; ?>"><?= $userdata->email; ?></a> </h6>
                        <h6 class="card-subtitle text-muted mb-3"> <a href="tel:<?= $userdata->mobile; ?>"><?= $userdata->mobile; ?></a> </h6>
                            <!-- grid row -->
                            <div class="row">
                                <!-- grid column -->
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
                                    <!-- .metric -->
                                    <div class="metric">
                                    	<?php 
                                    		$get_details = fetch_level_sponcer_data('users',$userdata->user_id);
                                    		if ($get_details): 
                                    	?>
                                    	<h6 class="metric-value"><?= count($get_details); ?></h6>
                                    	<p class="metric-label">Your Sponcer Users </p>
                                    	<?php else: ?>
                                        <h6 class="metric-value">0</h6>
                                        <p class="metric-label">Your Sponcer Users </p>
                                    <?php endif; ?>
                                            
                                    </div>
                                    <!-- /.metric -->
                                </div>
                                    <!-- /grid column -->
                                    <!-- grid column -->
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
                                    <!-- .metric -->
                                    <?php 
                                    	$get_users = get_user_details('user_wallate', $userdata->user_id);

                                    ?>
                                    <div class="metric">
                                       <h6 class="metric-value"><?= $get_users[0]->left_side; ?> </h6>
                                            <p class="metric-label"> Left Users </p>
                                    </div>
                                        <!-- /.metric -->
                                </div>
                                   <!-- /grid column -->
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
                                    <!-- .metric -->
                                    <div class="metric">
                                        <?php if($get_users[0]->position ==0): ?>
                                        		 <h6 class="metric-value" style="color: orange">Right</h6>
                                        	<?php else: ?>
                                        		<h6 class="metric-value" red>Left</h6>
                                        <?php endif; ?> 

                                    
                                        <p class="metric-label">Your Position</p>
                                    </div>
                                            <!-- /.metric -->
                                </div>

                                    <!-- grid column -->
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
                                    <!-- .metric -->
                                    <div class="metric">
                                        <h6 class="metric-value"> <?= $get_users[0]->right_side; ?> </h6>
                                        <p class="metric-label"> Right Users </p>
                                    </div>
                                            <!-- /.metric -->
                                </div>
                                   <!-- /grid column -->
                                   <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
                                    <!-- .metric -->
                                    <div class="metric">
                                        <h6 class="metric-value"> <?= $get_users[0]->right_count; ?> </h6>
                                        <p class="metric-label">Total Right Users ID </p>
                                    </div>
                                            <!-- /.metric -->
                                </div>
                                <div class="col-xl-2 col-lg-2 col-md-4 col-sm-12 col-12">
                                    <!-- .metric -->
                                    <div class="metric">
                                        <h6 class="metric-value"> <?= $get_users[0]->left_count; ?> </h6>
                                        <p class="metric-label">Total Left  Users ID </p>
                                    </div>
                                            <!-- /.metric -->
                                </div>
                            </div>
                                    <!-- /grid row -->
                        </div>
                                <!-- /.card-body -->
                    </div>
                </div>
			</div>
    </div>
<!----------Body Section End    ---------->



<!----Include Footer Section ---->
<?= view('MainDashboard/footer'); ?> 
<!----Include Footer Section ---->

<!----Include Js File ----->
<?= view('custome_file/css_file'); ?>    
<!----Include Js File ----->
</body>
</html>