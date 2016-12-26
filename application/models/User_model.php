<?php

class User_Model extends CI_Model
{

	public function getUser($email, $pass)
	{
		return $this->db->select("ID")
		->where("email", $email)->where("password", $pass)->get("users");
	}

	public function get_user_by_id($userid)
	{
		return $this->db->where("ID", $userid)->get("users");
	}

	public function get_user_by_username($username)
	{
		return $this->db->where("username", $username)->get("users");
	}

	public function delete_user($id)
	{
		$this->db->where("ID", $id)->delete("users");
	}

	public function get_new_members($limit)
	{
		return $this->db->select("email, username, joined")
		->order_by("ID", "DESC")->limit($limit)->get("users");
	}

	public function get_registered_users_date($month, $year)
	{
		$s= $this->db->where("joined_date", $month . "-" . $year)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_oauth_count($provider)
	{
		$s= $this->db->where("oauth_provider", $provider)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_total_members_count()
	{
		$s= $this->db->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_active_today_count()
	{
		$s= $this->db->where("online_timestamp >", time() - 3600*24)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_new_today_count()
	{
		$s= $this->db->where("joined >", time() - 3600*24)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_online_count()
	{
		$s= $this->db->where("online_timestamp >", time() - 60*15)->select("COUNT(*) as num")->get("users");
		$r = $s->row();
		if(isset($r->num)) return $r->num;
		return 0;
	}

	public function get_members($page, $col, $sort)
	{
		if($col !== 0) {
			$this->db->order_by($col, $sort);
		} else {
			$this->db->order_by("users.ID", "DESC");
		}

		return $this->db->select("users.username, users.email, users.first_name,
			users.last_name, users.ID, users.joined, users.oauth_provider,
			users.user_level")
		->limit(20, $page)
		->get("users");
	}

	public function get_members_by_search($search) {
		return $this->db->select("users.username, users.first_name,
			users.last_name, users.ID, users.joined, users.oauth_provider,
			users.user_level")
		->limit(20)
		->like("users.username", $search)
		->get("users");
	}

	public function search_by_username($search)
	{
		return $this->db->select("users.username, users.email, users.first_name,
			users.last_name, users.ID, users.joined, users.oauth_provider,
			users.user_level")
		->limit(20)
		->like("users.username", $search)
		->get("users");
	}

	public function search_by_email($search)
	{
		return $this->db->select("users.username, users.email, users.first_name,
			users.last_name, users.ID, users.joined, users.oauth_provider,
			users.user_level")
		->limit(20)
		->like("users.email", $search)
		->get("users");
	}

	public function search_by_first_name($search)
	{
		return $this->db->select("users.username, users.email, users.first_name,
			users.last_name, users.ID, users.joined, users.oauth_provider,
			users.user_level")
		->limit(20)
		->like("users.first_name", $search)
		->get("users");
	}

	public function search_by_last_name($search)
	{
		return $this->db->select("users.username, users.email, users.first_name,
			users.last_name, users.ID, users.joined, users.oauth_provider,
			users.user_level")
		->limit(20)
		->like("users.last_name", $search)
		->get("users");
	}

	public function update_user($userid, $data) {
		$this->db->where("ID", $userid)->update("users", $data);
	}

	public function check_block_ip()
	{
		$s = $this->db->where("IP", $_SERVER['REMOTE_ADDR'])->get("ip_block");
		if($s->num_rows() == 0) return false;
		return true;
	}

	public function get_user_groups($userid)
	{
		return $this -> db -> query("SELECT ccuser.idCentroCostos, descripcion FROM user_ccost_users ccuser INNER JOIN centroCostos ON(centroCostos.idCentroCostos = ccuser.idCentroCostos ) WHERE idUsuario = " . $userid);
	}

	public function get_user_permisos($userid)
	{
		return $this->db->where("idUser", $userid)->get("vistapermisos");
	}

	public function check_user_in_group($userid, $groupid)
	{	//SELECT * FROM `user_group_users` WHERE `userid` = '1' AND `groupid` = 3
	//$s = $this->db->where("userid", $userid)->where("groupid", $groupid)->get("user_group_users"
		$s = $this->db->where("userid", $userid)->where("groupid", $groupid)->get("user_group_usuarios");
		if($s->num_rows() == 0) return 0;
		return 1;
	}

	public function get_default_groups()
	{
		return $this->db->where("default", 1)->get("user_groups");
	}

	public function add_user_to_group($userid, $groupid)
	{
		$this->db->insert("user_group_users", array("userid" => $userid, "groupid" => $groupid));
	}


}

?>
