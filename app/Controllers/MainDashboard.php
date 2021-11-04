<?php namespace App\Controllers;
use \App\Models\Main_model;

class MainDashboard extends BaseController
{
	public $mainmodel;
	public $email;
	public $session;
	public $db;
	public function __construct(){
		helper(['form','Binary_helper']);
		$this->session     = \Config\Services::session();
		$this->db = \Config\Database::connect();
		$this->email       = \Config\Services::email();
		$validation =  \Config\Services::validation();
		$this->mainmodel  = new Main_model();
		 // error_reporting(0);
	}
	public function index()
	{
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$user_id = session()->get('loggedin_user');
			$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);
			return view('MainDashboard/dashboard', $data);
		}
	}
	public function new_registration(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$user_id = session()->get('loggedin_user');
			$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);
			return view('MainDashboard/new_registration', $data);
		}
	}

	public function register_new_member(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}
		$data  = [];
		$data['validation'] = null;
		if ($this->request->getMethod() == 'post') {
			$rules = [
				'member_name'   => 'required|min_length[3]|max_length[20]',
				'mobile'        => 'required|numeric|exact_length[10]',
				'member_uid'    => 'required|numeric|exact_length[12]',
				'pin'           => 'required',
				'member_email'  => 'required|valid_email|is_unique[users.email]',
				'address'       => 'required',
				'password'      => 'required|min_length[4]|max_length[16]'
			];
			if($this->validate($rules)){
				$user_id = rand(1111111,9999999);
					$userdata = [
						'name'         => $this->request->getVar('member_name',FILTER_SANITIZE_STRING),
						'email'        => $this->request->getVar('member_email'),
						'password'     => $this->request->getVar('password',FILTER_SANITIZE_STRING),
						'mobile'       => $this->request->getVar('mobile',FILTER_SANITIZE_STRING),
						'aadhar_details' => $this->request->getVar('member_uid',FILTER_SANITIZE_STRING),
						'address'      => $this->request->getVar('address',FILTER_SANITIZE_STRING),
						'position'     => $this->request->getVar('position',FILTER_SANITIZE_STRING),
						'sponcer_id'   => $this->request->getVar('sponcer_id',FILTER_SANITIZE_STRING),
						'status'       => 'Active',
						'user_id'      => $user_id,
						'created_date' => date('Y-m-d')
					];
					$insert_data = $this->mainmodel->Insertdata('users',$userdata);
					if ($insert_data) {
						   $to        = $this->request->getVar('member_email');
							$subject   = 'Your are New Memeber For  - MLM Software Solution';
							$message   = 'Hi ' .$this->request->getVar('member_name',FILTER_SANITIZE_STRING).",
							 	<br>Your are New Memeber For  - MLM Software Solution <br> ,Thanks ! Hope your are Enjoy & Start your Talent, Your User id is : ".$user_id. "<br><br> : Your Password is :".$this->request->getVar('password',FILTER_SANITIZE_STRING). " Thanks Your Joining Date :"
							 	.date('Y-m-d h:i:s')."<br>";
							$this->email->setTo($to);
							$this->email->setFrom('khanrayeesq121@gmail.com', 'MLM Software Solution');
							$this->email->setSubject($subject);
							$this->email->setMessage($message);
							$filepath = 'public/assets/images/mlm.png';
							$this->email->attach($filepath);
							if ($this->email->send()) {
						 	$this->session->setTempdata('success', 'New Memeber joined Successfully !',3 );
							}else{
						 	$data = $this->email->printDebugger(['headers']);
						     print_r($data);
						 	// $this->session->setTempdata('error', ' Sorry Unable to Send Mail Please Contact <br> FlexionSoftware Solution by Khan Rayees <br> Mobile: 9554540271');
						}
						
						//Check Pin CallBack Function 
						$this->pin_check($this->request->getVar('pin',FILTER_SANITIZE_STRING));
						//Level Income Distribution CallBack Function

						
						$wallate_details = [
							'user_id'      => $user_id,
							'sponcer_id'   => $this->request->getVar('sponcer_id',FILTER_SANITIZE_STRING),
							'position'     => $this->request->getVar('position',FILTER_SANITIZE_STRING),
							'income_date'  => date('Y-m-d h:i:s')
						];
						$income_details = $this->mainmodel->Insertdata('user_wallate',$wallate_details);
						if ($income_details) {
							//Level Income Distibution Callback function
							 $this->level_income_distribution($this->request->getVar('sponcer_id',FILTER_SANITIZE_STRING));
							 //Placement ID CallBack Function 
							 $users_id   = $user_id;
							 $sponcer_id = $this->request->getVar('sponcer_id',FILTER_SANITIZE_STRING);
							 $position    = $this->request->getVar('position',FILTER_SANITIZE_STRING);
							 $this->placement_id($user_id, $sponcer_id, $position);
						}	
						//return redirect()->to(current_url());
						$this->session->setTempdata('success', 'New Memeber joined Successfully !',3 );
						return redirect()->to(base_url().'/MainDashboard/register_new_member'); 
						
						  
					}else{
						$this->session->setTempdata('error', 'Sorry Unable to Create an Account, Try Again ?',3);
						return redirect()->to(current_url());
					}
			}else{
				$data['validation'] =  $this->validator;
			}
		}
		$user_id = session()->get('loggedin_user');
		$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);
		return view('MainDashboard/new_registration', $data);
	}

	//Pin Check Section Start 
	public function pin_check($pin){
		$args = [
			'status'    => '0',
			'pin_value' => $pin
		];
		$status = $this->mainmodel->fetch_rec_by_args('pin', $args);
		if ($status) {
			$args = [
				'pin_value' => $pin
			];
			$data = [
				'status' => '1'
			];
			$this->mainmodel->update_rec_by_args('pin', $args, $data);
		}else{
			return false;
		}
	}
	//Pin Check Section End

	//Level Income Distribution Section Start 
	public function level_income_distribution($sponcer_id){
		$a = 0;
		$count_income = 0;
		$income = [40,20,10,10,10,10];
		while ($a < 6 && $sponcer_id!=0) {
			$count_income += $income[$a];
			$args = [
				'user_id'  => $sponcer_id
			];
			$data  = [
			 	'level_income'  => $count_income
			];
			// $this->db->query("UPDATE `user_wallate` SET `level_income`=`level_income`+$income[$a]  WHERE `user_id`='$sponcer_id'");
			$this->mainmodel->update_rec_by_args('user_wallate', $args, $data);
			$next_id = $this->find_sponcer_id($sponcer_id);
			$sponcer_id = $next_id;
		}
	}


	//Binary Income Count Callback Function 
	public function binary_income_count($sponcer_id, $suposition){
		if ($suposition == 0) {
			$suposition = "left_count";
		}else{
			$suposition = "right_count";
		}
		
		while ($sponcer_id!=0) {
			$this->db->query("UPDATE `user_wallate` SET `$suposition`=`$suposition`+1  WHERE `user_id`='$sponcer_id'");
			// $this->mainmodel->update_rec_by_args('user_wallate', $args, $position_count);
			$this->is_pair_generate($sponcer_id);
			$suposition = $this->find_postion($sponcer_id);
			$sponcer_id = $this->find_placement_id($sponcer_id);
		}

	}
	//Binary Income Count Callback Function

	//Pair Generate Query Software Engineer Khan Rayees 
	public function is_pair_generate($sponcer_id){
		$query = $this->db->query("SELECT  * FROM `user_wallate` WHERE `user_id`='$sponcer_id'");
		$palcment_data   = $query->getRowArray();
		if ($palcment_data['left_count']==$palcment_data['right_count']) {
			//Fetch Pair Count data that mean user have any pair in this date
			$args = [
				'date'    => date('Y-m-d'),
				'user_id' => $sponcer_id
			];
			$available_pair = $this->mainmodel->fetch_rec_by_pair('pair_count', $args);
			if ($available_pair) {
				$pair_date = date('Y-m-d');
				//Update pair if Pair is already Available Update another pair
				$this->db->query("UPDATE `user_wallate` SET `no_of_pair`=`no_of_pair`+1  WHERE `date`='$pair_date' AND `user_id`='$sponcer_id'");
			}else{
				# Insert data in pair_count 
				$data = [
					'user_id'    => $sponcer_id,
					'no_of_pair' =>'1',
					'date'  => date('Y-m-d')
				]; 
				$this->mainmodel->Insertdata('pair_count', $data);
			}
		}
	}

	//Placement Id 
	public function placement_id($user_id, $sponcer_id, $position){
		$query = $this->db->query("SELECT  * FROM `user_wallate` WHERE `user_id`='$sponcer_id'");
		$spons_data   = $query->getRowArray();
		if ($position == 0) {
			if ($spons_data['left_side']==0) {
				# update placement right side code 
				$this->db->query("UPDATE `user_wallate` SET `left_side`='$user_id' WHERE `user_id`='$sponcer_id'");
				$this->db->query("UPDATE `user_wallate` SET `placement_id`='$sponcer_id' WHERE `user_id`='$user_id'");
				$this->binary_income_count($sponcer_id, $position);
			}else{
				//Call Placement id that mean here left side is not 0
				$this->placement_id($user_id, $spons_data['left_side'], $position);
			}
		}else{
			if ($spons_data['right_side']==0) {
				# update placement right side code 
				$this->db->query("UPDATE `user_wallate` SET `right_side`='$user_id' WHERE `user_id`='$sponcer_id'");
				$this->db->query("UPDATE `user_wallate` SET `placement_id`='$sponcer_id' WHERE `user_id`='$user_id'");
				$this->binary_income_count($sponcer_id, $position);
			}else{
				//Call Placement id that mean here Right side is not 0
				$this->placement_id($user_id, $spons_data['right_side'], $position);
			}
		}
	}
	//Placement Id 

	public function find_sponcer_id($sponcer_id){
		$query = $this->db->query("SELECT  * FROM `user_wallate` WHERE `user_id`='$sponcer_id'");
		$data   = $query->getRowArray();
		//$data   = $query->getResultArray();
		return $data['sponcer_id'];
	}

	public function find_placement_id($sponcer_id){
		$query = $this->db->query("SELECT  * FROM `user_wallate` WHERE `user_id`='$sponcer_id'");
		$data   = $query->getRowArray();
		//$data   = $query->getResultArray();
		return $data['placement_id'];
	}

	public function find_postion($sponcer_id){
		$query = $this->db->query("SELECT *  FROM `user_wallate` WHERE `user_id`='$sponcer_id'");
		$data   = $query->getRowArray();
		$suposition = $data['position'];
		if ($suposition == 0) {
			$suposition = "left_count";
		}else{
			$suposition = "right_count";
		}
		return $suposition;
	}
	//Level Income Distribution Section End


	//Tree DownLine Section Start
	public function tree_downline(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$user_id = session()->get('loggedin_user');
			$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);
			$args = [
				'user_id'  => $data['userdata']->user_id
			];
			$login_user_data = $this->mainmodel->fetch_rec_by_args('user_wallate', $args);
			if ($login_user_data) {
				$user_id_session = [
					'user_id'    =>  $login_user_data[0]->user_id
				];
				$this->session->set('user_session_id',$user_id_session);
			}
			$data['uinfo'] = session()->get('user_session_id');
			return view('MainDashboard/tree_downline', $data);
		}
	} 

	public function show_user_details($agent_id){
		$args = [
			'user_id' => $agent_id
		];
		$data = $this->mainmodel->fetch_rec_by_pair('user_wallate',$args);
		$args = [
			'user_id' => $agent_id
		];
		$userdata = $this->mainmodel->fetch_rec_by_pair('users',$args);
		$table = '<table class="table">
			  <thead>
			    <tr>
			      <th scope="col colspan=3" style="color:red">Name :'.$userdata->name.'</th>
			      <th scope="col colspan=3" style="color:orange">Mobile :'.$userdata->mobile.'</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<tr>
			      <th scope="row">Left Count :</th>
			      <td>'.$data->left_count.'</td>
			    </tr>
			    <tr>
			      <th scope="row">Right Count :</th>
			      <td>'.$data->right_count.'</td>
			    </tr>
			    <tr>
			      <th scope="row">Placement Id :</th>
			      <td>'.$data->placement_id.'</td>
			    </tr>

			    <tr>
			      <th scope="row">Left User :</th>
			      <td>'.$data->right_side.'</td>
			    </tr>
			    <tr>
			      <th scope="row">Right User :</th>
			      <td>'.$data->left_side.'</td>
			    </tr>
			    <tr>
			      <th scope="row">Level Income :</th>
			      <td>'.$data->level_income.'</td>
			    </tr>
			</tbody>
			</table>';
		echo $table;
	}

	public function down_line_user_info(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$user_id = session()->get('loggedin_user');
			$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);
			
			$data['uinfo'] = session()->get('user_session_id');
			// var_dump($data['uinfo']);
			// exit();
			return view('MainDashboard/downline_user_info', $data);
		}
	}
	
	public function level_sponser($args){
		$args = [
			'sponcer_id' => $args
		];
		$data['uinfo']=$this->mainmodel->fetch_rec_by_pair('users', $args);
		$data['login_id'] = session()->get('user_session_id');
		$user_id = session()->get('loggedin_user');
		$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);
		return view('MainDashboard/downline_user_info_data', $data);
	}

//Tree DownLine Section End
	//User Profile Settings 
	public function user_profile_settings(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$user_id = session()->get('loggedin_user');
			$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);
			return view('MainDashboard/user_profile_settings', $data);
		}
		
	}

	public function change_password(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$data = [];
			$user_id = session()->get('loggedin_user');
			$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);
			if ($this->request->getMethod() == 'post') {
				$rules = [
					'old_password'   => 'required',
					'checkbox'   => 'required',
					'password'   => 'required|min_length[4]|max_length[16]',
					'confirm_password'  => 'required|matches[password]',
				];
				if ($this->validate($rules)) {
					$opwd = $this->request->getVar('old_password');
					$npwd = $this->request->getVar('password');
					$pass_verify = $this->user_password_verify($data['userdata']->user_id, $opwd);
					if ($pass_verify) {
						$status = $this->mainmodel->updatePassword('users',$npwd,session()->get('loggedin_user'));
						if ($status) {
							$this->session->setTempdata('success', 'Congratulation ! Password Changed Successfully!', 3);
							return redirect()->to(current_url());
						}else{
							$this->session->setTempdata('error', 'Sorry Unable to Update Password Try Again!', 3);
							return redirect()->to(current_url());
						}
					}else{
						$this->session->setTempdata('error', 'Old Password DoesNot Matched with DB Password', 3);
					}
					
						
				}else{
					$data['validation']  = $this->validator;
				}
			}
		}
		return view('MainDashboard/user_profile_settings', $data);
	}

	public function user_password_verify($user_id, $opw){
		$args = [
			'user_id'  => $user_id,
			'password' => $opw
		];
		$result = $this->mainmodel->fetch_rec_by_pair('users', $args);
		if ($result == true) {
			return true;
		}else{
			return false;
		}
	}

	public function upload_image(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$user_id = session()->get('loggedin_user');
			$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);

			$args = [
				'user_id'  => $data['userdata']->user_id
			];
			$img = $this->request->getFile('user_avatar');
			if ($img->isValid() &&  !$img->hasMoved()) {
				$newName = $img->getRandomName();
				$img->move('./public/uploads/user_image', $newName); 
	            $avatar_img = $img->getName();
	            $userdata = [
					'profile'   =>  $avatar_img
				];
				$status = $this->mainmodel->update_rec_by_args('users',$args, $userdata);
				if ($status == true) {
					$this->session->setTempdata('success', 'Congratulation ! User Avatar Uploded Successfully !', 3);
				}else{
					$this->session->setTempdata('error', 'Sorry ! Unable to Add  Doctor  Try Again ?', 3);
				}  
				return redirect()->to(base_url().'/MainDashboard/user_profile_settings');

			}else{
				echo $image->getErrorString(). " " .$image->getError();
			}
			return view('MainDashboard/user_profile_settings', $data);
		}
	}

	public function view_account(){
		if (!(session()->has('loggedin_user'))) {
			return redirect()->to(base_url()."/Login");
		}else{
			$user_id = session()->get('loggedin_user');
			$data['userdata'] = $this->mainmodel->get_logged_in_user_data($user_id);
			return view('MainDashboard/view_account', $data);
		}
	}
	//User Profile Settings 


	public function Logout(){
		if (session()->has('loggedin_user')) {
			$login_activity_id = session()->get('loggedin_user');
			$this->mainmodel->updateLogoutTime($login_activity_id);
		}
		session()->destroy();
		return redirect()->to(base_url()."/Login");
	}



	
}
