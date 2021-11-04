<?php 
namespace App\Controllers;
use CodeIgniter\Controller;	
use \App\Models\Login_model;

class Login extends BaseController
{
	public $session;
	public function __construct(){
		helper('form');
		$this->loginModel = new Login_model();
		$this->session   = session();
		$this->email = \Config\Services::email();
		
	}
	public function index()
	{
		$data = [];
			if ($this->request->getMethod() == 'post') {
				$rules = [
				    'username'  => [
					'rules'  => 'required',
					'errors'    => [
						'required' => 'Name is Manidatory'
					],
				],
				
				'checkbox'  => [
					'rules'   => 'required',
					'errors'  => [
						'required'     => 'Please Select Remember me !',
					],
				],
				'password'  => [
					'rules'   => 'required|min_length[6]|max_length[16]',
					'errors'  => [
						'required'  => 'Password is Required',
					],
				],
			
			];
				if ($this->validate($rules)) {
					$username     = $this->request->getVar('username');
					$password  = $this->request->getVar('password');
					
					$throttler = \Config\Services::throttler();
					$allow     = $throttler->check("login", 4, MINUTE);
					if ($allow) {
						$userdata = $this->loginModel->verifyusers($username, $password);
						if ($userdata) {
							$loginInfo  = [
								'user_id'       => $userdata['user_id'],
								'username'      => $userdata['name'],
								'sponcer_id'    => $userdata['sponcer_id'],
								'browser'       => $this->getUserAgent(),
								'ip'            => $this->request->getIPAddress(),
								'login_time'    => date('Y-m-d h:i:s'),
								'login_date'    => date('Y-m-d')   
							];
							$login_activity_id = $this->loginModel->saveLoginInfo($loginInfo);
							if ($login_activity_id) {
								$this->session->set('loggedin_info', $login_activity_id);
							}else{

							}
							$this->session->set('loggedin_user', $userdata['user_id']);
							return redirect()->to(base_url().'/MainDashboard');
						}else{
							$data['error']  = 'Username & Password don Not Matched ! Please Enter Valid Username & Password';
						}
						
					}else{
						$data['error']  = 'Max No. of failed Login Attempt, Try Again a Few Minutes';
					}
				}else{
					
					$data['validation']  = $this->validator;
				}
			}
		return view('Login/index', $data);
	}


	public function getUserAgent(){
		$agent = $this->request->getUserAgent(); //predefine method
		if ($agent->isBrowser()) {
			$currentAgent  = $agent->getBrowser();
		}else if ($agent->isRobot()) {
			$currentAgent  = $this->agent->robot();
		}else if ($agent->isMobile()) {
			$currentAgent  = $agent->getMobile();
		}else{
			$currentAgent  = 'Unidentified User Agent';
		}
		return $currentAgent;
	}

	//--------------------------------------------------------------------

}
