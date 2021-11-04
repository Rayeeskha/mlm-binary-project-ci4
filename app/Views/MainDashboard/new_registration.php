<?php $validation = \config\services::validation(); ?>
<!DOCTYPE html>
<html>
<head>
	<title>New Member Register</title>
	<!--------Include Css file ----->
    <?= view('custome_file/css_file'); ?> 
    <!--------Include Css file ----->
</head>
<body>
<!----Navbar file Include ---->
<?= view('MainDashboard/navbar'); ?> 	
<!----Navbar file Include ---->

<!-----Left Side Bar Section Include ---->
<?= view('MainDashboard/left_sidebar'); ?> 
<!-----Left Side Bar Section Include -->

<!-----Body Section Start --->
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

                 <!-- pageheader -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="page-header">
                            <h2 class="pageheader-title">New Member Register </h2>
                            <div class="page-breadcrumb">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                       <li class="breadcrumb-item active" aria-current="page">New Member Registeration</li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
               <div class="row">
                        <!-- ============================================================== -->
                        <!-- valifation types -->
                        <!-- ============================================================== -->
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">New Member Registeration</h5>
                                <div class="card-body">
                                    <?= form_open('MainDashboard/register_new_member'); ?>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Sponcer Id</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="text" name="sponcer_id" value="<?= $userdata->user_id; ?>" class="form-control">
                                                <input type="hidden" name="login_user_sponcer"  value="<?= $userdata->sponcer_id; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Member Name</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="text" name="member_name" value="<?= set_value('member_name'); ?>" placeholder="Member Name" class="form-control">
                                            </div>
                                            <span style="color: red"><?= display_error($validation,'member_name'); ?></span>
                                        </div>
                                        <div class="form-group btn-group btn-group-toggle" data-toggle="buttons" style="margin-left: 25%">
                                            <input type="hidden" name="login_user_position" value="<?= $userdata->position; ?>">
                                        	<label class="btn btn-primary active">
                                        		<input type="radio" name="position" id="option1" value="0" checked>Left
                                        	</label>
                                        	<label class="btn btn-primary">
                                        		<input type="radio" name="position" id="option2" value="1">Right
                                        	</label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Mobile Number</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="number" name="mobile" value="<?= set_value('mobile'); ?>" placeholder="Member Mobile Number" class="form-control">
                                            </div>
                                            <span style="color: red"><?= display_error($validation,'mobile'); ?></span>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">PIN</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="text" name="pin" value="<?= set_value('pin'); ?>" placeholder="Enter Memeber PIN" class="form-control">
                                            </div>
                                            <span style="color: red"><?= display_error($validation,'pin'); ?></span>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Member UID</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="text" name="member_uid" value="<?= set_value('member_uid'); ?>" placeholder="Member Aadhar Details" class="form-control">
                                            </div>
                                            <span style="color: red"><?= display_error($validation,'member_uid'); ?></span>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Member Address</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="text" name="address" value="<?= set_value('address'); ?>" placeholder="Member Address" class="form-control">
                                            </div>
                                            <span style="color: red"><?= display_error($validation,'address'); ?></span>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Member Email</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="email" name="member_email" value="<?= set_value('member_email'); ?>" placeholder="Member Email id" class="form-control">
                                            </div>
                                            <span style="color: red"><?= display_error($validation,'member_email'); ?></span>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-12 col-sm-3 col-form-label text-sm-right">Member Password</label>
                                            <div class="col-12 col-sm-8 col-lg-6">
                                                <input type="text" name="password" value="<?= set_value('password'); ?>" placeholder="Secret password" class="form-control">
                                            </div>
                                            <span style="color: red"><?= display_error($validation,'password'); ?></span>
                                        </div>
                                       <div class="form-group row text-center">
                                            <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                                <button type="submit" class="btn btn-space btn-primary">Submit</button>
                                                <button class="btn btn-space btn-secondary">Cancel</button>
                                            </div>
                                        </div>
                                    <?= form_close(); ?>
                                </div>
                            </div>
                        </div>
                        <!-- ============================================================== -->
                       
                        <!-- ============================================================== -->
                    </div>
           
            </div>
<!-----Body Section End--->
<!----Include Footer Section ---->
<?= view('MainDashboard/footer'); ?> 
<!----Include Footer Section ---->

<!----Include Js File ----->
<?= view('custome_file/js_file'); ?>    
<!----Include Js File ----->


</body>
</html>