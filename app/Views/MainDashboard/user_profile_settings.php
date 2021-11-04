<?php $validation =  \Config\Services::validation(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Profile Settings</title>
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

<!----Body Section Start  ------>
<!-- ============================================================== -->
<div class="dashboard-wrapper">
 <div class="container-fluid  dashboard-content">
    <!-- ============================================================== -->
    <!-- Session Success & Failure Message  -->
    <!---Php Meassge Show --->
    <div style="margin-left: 20px;margin-right: 10px">
      <?php  if(session()->getTempdata('success')): ?>
            <div class="alert alert-primary" role="alert">
              <?= session()->getTempdata('success'); ?>
            </div>
        <?php endif; ?>
        <?php  if(session()->getTempdata('error')): ?>
            <div class="alert alert-danger" role="alert">
              <?= session()->getTempdata('error'); ?>
            </div>
    <?php endif; ?>
    </div>
     <!---Php Meassge Show --->
    <!-- Session Success & Failure Message  -->

    <div class="row">
        <!-- ============================================================== -->
        <!-- basic form -->
        <!-- ============================================================== -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        	<?= form_open('MainDashboard/change_password'); ?>
            <div class="card">
            	
                <h5 class="card-header"><span class="fa fa-key" style="color: red"></span>&nbsp;Change Password</h5>
                <div class="card-body">
                    <form action="#" id="basicform" data-parsley-validate="">
                        <div class="form-group">
                            <label for="inputUserName">Old Password</label>
                            <input id="inputUserName" type="text" name="old_password" value="<?= set_value('old_password'); ?>" placeholder="Enter Old Password" autocomplete="off" class="form-control">
                        </div>
                        <span style="color: red"><?= display_error($validation,'old_password'); ?></span>
                        <div class="form-group">
                            <label for="inputPassword">Password</label>
                            <input id="inputPassword" type="password"  name="password" value="<?= set_value('password'); ?>" placeholder="New Password" class="form-control">
                        </div>
                        <span style="color: red"><?= display_error($validation,'password'); ?></span>
                        <div class="form-group">
                            <label for="inputRepeatPassword">Repeat Password</label>
                            <input id="inputRepeatPassword" name="confirm_password" value="<?= set_value('confirm_password'); ?>" placeholder="Confirm Password" class="form-control">
                        </div>
                         <span style="color: red"><?= display_error($validation,'confirm_password'); ?></span>
                        <div class="row">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                <label class="be-checkbox custom-control custom-checkbox">
                                    <input type="checkbox" name="checkbox" class="custom-control-input"><span class="custom-control-label">Remember me</span>
                                </label>
                            </div>
                            <span style="color: red"><?= display_error($validation,'checkbox'); ?></span>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <button class="btn btn-space btn-secondary">Cancel</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
        <!-- ============================================================== -->
        <!-- end basic form -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- horizontal form -->
        <!-- ============================================================== -->
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
        	<?= form_open_multipart('MainDashboard/upload_image'); ?>
            <div class="card">
                <h5 class="card-header"><span class="fa fa-image" style="color: red"></span>&nbsp;Upload Image</h5>
                <div class="card-body">
                    <form id="form" data-parsley-validate="" novalidate="">
                        <div class="form-group row">
                            <label for="inputEmail2" class="col-3 col-lg-2 col-form-label text-right">User Image</label>
                            <div class="col-9 col-lg-10">
                                <input  type="file" name="user_avatar" required="" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                    <button class="btn btn-space btn-secondary">Cancel</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
        <!-- ============================================================== -->
        <!-- end horizontal form -->
        <!-- ============================================================== -->
            
</div>
</div>
<!----Body Section End  ------>



<!----Include Footer Section ---->
<?= view('MainDashboard/footer'); ?> 
<!----Include Footer Section ---->

<!----Include Js File ----->
<?= view('custome_file/css_file'); ?>    
<!----Include Js File ----->
</body>
</html>