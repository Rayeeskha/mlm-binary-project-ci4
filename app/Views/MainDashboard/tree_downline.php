<!DOCTYPE html>
<html>
<head>
	<title>Tree for DownLine Page</title>
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
<!-----Left Side Bar Section Include ---->

<!----Body Section Start ------>
<div class="dashboard-wrapper">
    <div class="container-fluid  dashboard-content">	
		<div class="row">
            <!-- ============================================================== -->
            <!-- top selling products  -->
            <!-- ============================================================== -->
            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 card bg-light p-0">
                <div class="card">
                	<h5 class="card-header">Your Down Line Tree Structure</h5>
                    <div class="card-body">
                    	
                    	<?php 
                    
                    		$user_id = [$uinfo];
                    		   // var_dump($user_id);
                    		$i=0;
                        for ($i; $i <=2; $i++):
                            $temp_id_index=0;
                    		$divide = pow(2,$i);
                    	?>
                    		<div class="row  p-3">
                    		<?php for($d=0;$d< $divide; $d++): ?>
                    				<div class="col-<?php echo 12/$divide; ?>  p-3 text-center">
                                       <img src="<?php echo (implode(',', (array) $user_id[$d])!=0)?(base_url().'/public/assets/images/trre.png'):(base_url().'/public/assets/images/binar.png') ?>" class="img-fluid" alt="img" style="width: 50px;border-radius: 100%">
                                       <a href="#!"><p id="<?= implode(',', (array) $user_id[$d]) ?>" 
                                            onclick="<?= (implode(',', (array) $user_id[$d])!=0)?"show_user_details(this)":"" ?>   "><?= $print_id =  implode(',', (array) $user_id[$d]);?></p></a>
                    				</div>
                    			<!-----That Loop working for (Khan Rayees Software Engineer) which user downline for login user ---->
                    			<?php 

                                for($p=0; $p<2; $p++):
                    				$temp_id[$temp_id_index] = fetch_right_left_user($p,$print_id);
                    				// var_dump($temp_id[$temp_id_index]);
                    				$temp_id_index++;
                    			?>
                    			<?php endfor;  ?>
                            <?php endfor; 
                            $user_id = $temp_id;
                            // var_dump($user_id);
                            ?>     
                    		</div>
						<?php endfor; ?>
                    </div>
                </div>
            </div>

        	 <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                <!-- ============================================================== -->
                <!-- social source  -->
                 <!-- ============================================================== -->
                <div class="card">
                    <h5 class="card-header"> Sales By Social Source</h5>
                    <div class="card-body p-0">
                        <ul class="social-sales list-group list-group-flush">
                            <li class="list-group-item social-sales-content"><span class="social-sales-icon-circle facebook-bgcolor mr-2"><i class="fab fa-facebook-f"></i></span><span class="social-sales-name">Facebook</span><span class="social-sales-count text-dark">120 Sales</span>
                            </li>
                            <li class="list-group-item social-sales-content"><span class="social-sales-icon-circle twitter-bgcolor mr-2"><i class="fab fa-twitter"></i></span><span class="social-sales-name">Twitter</span><span class="social-sales-count text-dark">99 Sales</span>
                            </li>
                            <li class="list-group-item social-sales-content"><span class="social-sales-icon-circle instagram-bgcolor mr-2"><i class="fab fa-instagram"></i></span><span class="social-sales-name">Instagram</span><span class="social-sales-count text-dark">76 Sales</span>
                            </li>
                            <li class="list-group-item social-sales-content"><span class="social-sales-icon-circle pinterest-bgcolor mr-2"><i class="fab fa-pinterest-p"></i></span><span class="social-sales-name">Pinterest</span><span class="social-sales-count text-dark">56 Sales</span>
                            </li>
                            <li class="list-group-item social-sales-content"><span class="social-sales-icon-circle googleplus-bgcolor mr-2"><i class="fab fa-google-plus-g"></i></span><span class="social-sales-name">Google Plus</span><span class="social-sales-count text-dark">36 Sales</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- end social source  -->
                <!-- ============================================================== -->
            </div>
        </div>
    </div>
</div>
<!----Body Section End ------>

<!-----User Details Modal Start ---->
<!-- Modal -->
<div id="user_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal_title">Modal Header</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="agent_details_show_modal">
        <p></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-----User Details Modal End ---->





<!----Include Footer Section ---->
<?= view('MainDashboard/footer'); ?> 
<!----Include Footer Section ---->

<!----Include Js File ----->
<?= view('custome_file/js_file'); ?>    
<!----Include Js File ----->
 

 <script type="text/javascript">
     function show_user_details(a){
       $('#user_modal').modal('show');
       let agent_id = $(a).attr('id');
       $('#modal_title').html(agent_id);
       $.ajax({
        url:'<?= site_url('MainDashboard/show_user_details'); ?>/'+agent_id,
        type:'POST',
        data:{agent_id:agent_id},
        beforeSend:function(response){
            
        },
        success:function(response){
            // $('#preloader').modal('close');
            $('#agent_details_show_modal').html(response);
               
        },
        error:function(){
            
            lert('Error! Admin Login Account');
        }
       });
     }
 </script>

</body>
</html>