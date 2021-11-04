<?php 
	function fetch_right_left_user($side, $agent_id){
		$db = \Config\Database::connect();
		if ($side == 0) {
        	$pos = 'left_side';
        }else{
        	$pos = 'right_side';
        }
        $query = $db->query("SELECT  * FROM `user_wallate` WHERE `user_id`='$agent_id'");
		$data   = $query->getRowArray();
		if ($agent_id!=0) {
			return $data[$pos];
		}else{
			return 0;
		}
		// return $data[$pos];
	}

	function get_user_details($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('user_id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function fetch_level_sponcer_data($tablename, $args){
		$db = \Config\Database::connect();
		$builder = $db->table($tablename);
		$builder->select('*');
		$result = $builder->where('sponcer_id', $args)
                  ->get();
		if (count($result->getResultArray())> 0) {
			return $result->getResult();
		}else{
			return false;
		}
	}

	function check_my_down_line($user_id,$login_id){
		$db = \Config\Database::connect();
		$query = $db->query("SELECT *  FROM `users` WHERE `user_id`='$user_id'");
		$data   = $query->getRowArray();
		$sponcer_id = $data['sponcer_id'];
		while ($sponcer_id!=0) {
			if ($sponcer_id== $login_id) {
				return true;
			}else{
				$query = $db->query("SELECT *  FROM `users` WHERE `user_id`='$sponcer_id'");
				$data   = $query->getRowArray();
				$sponcer_id = $data['sponcer_id'];
			}
		}
		if ($sponcer_id==0) {
			return false;
		}
	}



?>