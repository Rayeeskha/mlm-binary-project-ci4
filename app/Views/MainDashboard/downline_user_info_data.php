<!DOCTYPE html>
<html>
<head>
	<title>Self Level User Info</title>
	<!--------Include Css file ----->
    <?= view('custome_file/css_file'); ?> 
    <!--------Include Css file ----->
    >
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/vendor/datatables/css/dataTables.bootstrap4.css') ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/vendor/datatables/css/buttons.bootstrap4.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/vendor/datatables/css/select.bootstrap4.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('public/assets/vendor/datatables/css/fixedHeader.bootstrap4.css'); ?>">
</head>
<body>
<!----Navbar file Include ---->
<?= view('MainDashboard/navbar'); ?> 	
<!----Navbar file Include ---->

<!-----Left Side Bar Section Include ---->
<?= view('MainDashboard/left_sidebar'); ?> 
<!-----Left Side Bar Section Include -->

<!------Body Section Start ------>
<!-- ============================================================== -->
    <div class="dashboard-wrapper">
        <div class="container-fluid  dashboard-content">
            <!-- ============================================================== -->
                 <div class="row">
                    <!-- ============================================================== -->
                    <!-- data table  -->
                     <!-- ============================================================== -->
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card">
                            <h5 class="card-header">Down Line User Details</h5>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered first">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Mobile</th>
                                                <th>Email</th>
                                                <th></th>
                                                <th>Start date</th>
                                                <th>DownLine</th>
                                            </tr>
                                        </thead>
                                        
                                        
                                        <?php 
                                           if($uinfo && $login_id):
                                                $check_down = check_my_down_line($uinfo,$login_id);
                                                count($check_down);
                                                foreach($check_down as $get_data):
                                        ?>
                                    <tbody>
                                            <tr>
                                                <td><?= $get_data->name; ?></td>
                                                <td><a href="tel:<?= $get_data->mobile; ?>"><?= $get_data->mobile; ?></a></td>
                                                <td><a href="mailto:<?= $get_data->email; ?>"><?= $get_data->email; ?></a></td>
                                                <td></td>
                                                <td><?= date('D, M d Y', strtotime($get_data->created_date)); ?></td>
                                                <td><a href="<?= base_url('MainDashboard/level_sponser/'.$get_data->user_id); ?>">Downline</a></td>
                                            </tr>
                                            
                                          
                                        </tbody>
                                         <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7">
                                                <h6 style="color: red; text-align: center;">Record Not Found</h6>
                                            </td>
                                        </tr>
                                    <?php endif; ?> 
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                </div>
        </div>
    </div>

<!------Body Section End ------>


<!----Include Footer Section ---->
<?= view('MainDashboard/footer'); ?> 
<!----Include Footer Section ---->

<!----Include Js File ----->
<?= view('custome_file/js_file'); ?>    
<!----Include Js File ----->
 <!-- Optional JavaScript -->
    
    <script src="<?= base_url('public/assets/vendor/multi-select/js/jquery.multi-select.js') ?>"></script>
   
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="<?= base_url('public/assets/vendor/datatables/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
   
    <script src="<?= base_url('public/assets/vendor/datatables/js/data-table.js'); ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script>
    pt>



</body>
</html>