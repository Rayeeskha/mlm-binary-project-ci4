<?php 
namespace App\models;
use CodeIgniter\Model;
class Login_model extends Model
{
	public function verifyusers($username,$password){
		$builder = $this->db->table('users');
		$builder->select('user_id,name,password,mobile,position,sponcer_id');
		$builder->where('user_id', $username);
		$builder->where('password', $password);
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRowArray();
		}else{
			return false;
		}
	}

	public function saveLoginInfo($data){
		$builder = $this->db->table('login_activity');
		$builder->insert($data);
		if ($this->db->affectedRows() == 1) {
			return $this->db->insertID();
		}else{
			return false;
		}
	}



}