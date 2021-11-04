<?php 
namespace App\models;
use CodeIgniter\Model;

class Main_model extends Model
{
	public function get_logged_in_user_data($id){
		$builder = $this->db->table('users');
		$builder->where('user_id', $id);
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRow();
		}else{
			return false;
		}
	}

	public function Insertdata($tablename,$data){
		$builder = $this->db->table($tablename);
		$res = $builder->insert($data);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function Insertdata_return_id($tablename,$data){
	 	$builder = $this->db->table($tablename);
	 	$res = $builder->insert($data);
	 	if ($this->db->affectedRows() == 1) {
	 		return $this->primaryKey = $this->db->insertID();
	 	}else{
			return false;
	 	}
	}

	public function fetch_rec_by_args($tablename, $args){
		$builder = $this->db->table($tablename);
		$builder->select('*');
		$result = $builder->where($args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	public function fetch_rec_by_pair($tablename, $args){
		$builder = $this->db->table($tablename);
		$builder->where($args);
		$result = $builder->get();
		if (count($result->getResultArray()) == 1) {
			return $result->getRow();
		}else{
			return false;
		}
	}

	public function fetch_sponser_id($tablename, $args){
		$builder = $this->db->table($tablename);
		$builder->select('*');
		$builder->where($args);
		$query = $builder->get();
      	$result = $query->getResult();
      	if(is_array($result) && count($result) > 0) {
		    return $result;
		}else{
			return false;
		}
    }

	public function update_rec_by_args($tablename, $args, $data){
		$builder = $this->db->table($tablename);
		$builder->where($args);
		$builder->update($data);
		if ($this->db->affectedRows() == 1) {
			return true;
		}else{
			return false;
		}
	}

	public function updatePassword($tablename,$npwd, $id){
		$builder = $this->db->table($tablename);
		$builder->where('user_id',$id);
		$builder->update(['password'=> $npwd]);
		if ($this->db->affectedRows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function updateLogoutTime($id){
		$builder = $this->db->table('login_activity');
		$builder->where('id',$id);
		$builder->update(['logout_time'=> date('Y-m-d h:i:s')]);
		if ($this->db->affectedRows() > 0) {
			return true;
		}else{
			return false;
		}
	}

	public function fetch_rec_by_args_using_join($user_id){
		 $sql = "SELECT `users.user_id`,  `user_wallate.user_id` 
            FROM (
                SELECT user_wallate.* FROM user_wallate
            UNION
                SELECT users.* FROM users
                ) as users
            LEFT JOIN users ON `users.user_id`= `user_wallate.user_id`  
            WHERE $user_id IS NOT NULL
            ";
    $result = $this->db->query($sql);

    return $result->getResultArray();
	}

}