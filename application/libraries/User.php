<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class User 
{

	var $info=array();
	var $loggedin=false;
	var $u=null;
	var $p=null;
	var $oauth_provider = null;
	var $oauth_id = null;
	var $oauth_token = null;
	var $oauth_secret = null;

	public function __construct() 
	{
		$CI =& get_instance();
		$config = $CI->config->item("cookieprefix");
		$this->u = $CI->input->cookie($config . "un", TRUE);
		$this->p = $CI->input->cookie($config . "tkn", TRUE);

		$this->oauth_provider = $CI->input->cookie($config . "provider", TRUE);
		$this->oauth_id = $CI->input->cookie($config . "oauthid", TRUE);
		$this->oauth_token = $CI->input->cookie($config . "oauthtoken", TRUE);
		$this->oauth_secret = $CI->input->cookie($config . "oauthsecret", TRUE);
 		
 		$user = null; 
 		
 		// Twitter
		if($this->oauth_provider === "twitter") {
			if($this->oauth_provider && $this->oauth_id &&
			  $this->oauth_token && $this->oauth_secret) {
			 	$user = $CI->db->select(
				 	"users.`ID`, users.`username`, users.`email`, 
				users.`user_level`, users.first_name, 
				users.last_name, users.`online_timestamp`, users.avatar,
				users.email_notification, users.aboutme"
				 )
				 ->where("oauth_provider", $this->oauth_provider)
				 ->where("oauth_id", $this->oauth_id)
				 ->where("oauth_token", $this->oauth_token)
				 ->where("oauth_secret", $this->oauth_secret)
				 ->get("users"); 
			}
		}

		// Facebook
		if($this->oauth_provider === "facebook") {
			if($this->oauth_provider && $this->oauth_id &&
			  $this->oauth_token) {
			 	$user = $CI->db->select(
				 	"users.`ID`, users.`username`, users.`email`, 
				users.`user_level`, users.first_name, 
				users.last_name, users.`online_timestamp`, users.avatar,
				users.email_notification, users.aboutme"
				 )
				 ->where("oauth_provider", $this->oauth_provider)
				 ->where("oauth_id", $this->oauth_id)
				 ->where("oauth_token", $this->oauth_token)
				 ->get("users"); 
			}
		}

		// Google
		if($this->oauth_provider === "google") {
			if($this->oauth_provider && $this->oauth_id &&
			  $this->oauth_token) {
			 	$user = $CI->db->select(
				 	"users.`ID`, users.`username`, users.`email`, 
				users.`user_level`, users.first_name, 
				users.last_name, users.`online_timestamp`, users.avatar,
				users.email_notification, users.aboutme"
				 )
				 ->where("oauth_provider", $this->oauth_provider)
				 ->where("oauth_id", $this->oauth_id)
				 ->where("oauth_token", $this->oauth_token)
				 ->get("users"); 
			}
		}

		if ($this->u && $this->p && empty($this->oauth_provider)) {
			$user = $CI->db->select(
				" users.`ID`, users.`username`, users.`email`, 
				users.`user_level`, users.first_name, 
				users.last_name, users.`online_timestamp`, users.avatar,
				users.email_notification, users.aboutme"
			)
			->where("email", $this->u)->where("token", $this->p)
			->get("users");
		}

		if($user !== null) {
			if ($user->num_rows() == 0) {
				$this->loggedin=false;
			} else {
				$this->loggedin=true;
				$this->info = $user->row();

				if( (empty($this->info->username) || empty($this->info->email)) && ($CI->router->fetch_class() != "register")) {
					redirect(site_url("register/add_username"));
				}

				if($this->info->online_timestamp < time() - 60*5) {
					$this->update_online_timestamp($this->info->ID);
				}

				if ($this->info->user_level == -1) {
					$CI->load->helper("cookie");
					$this->loggedin = false;
					$CI->session->set_flashdata("globalmsg", 
						"This account has been deactivated and can no longer be used.");
					delete_cookie($config . "un");
					delete_cookie($config . "tkn");
					redirect(site_url("login/banned"));
				}
			}
		}
	}

	public function getPassword() 
	{
		$CI =& get_instance();
		$user = $CI->db->select("users.`password`")
		->where("ID", $this->info->ID)->get("users");
		$user = $user->row();
		return $user->password;
	}

	public function getUserLevel() 
	{
		$CI =& get_instance();
		$user = $CI->db->select("users.`user_level`")
		->where("ID", $this->info->ID)->get("users");
		$user = $user->row();
		return $user->user_level;
	}

	public function update_online_timestamp($userid) 
	{
		$CI =& get_instance();
		$CI->db->where("ID", $userid)->update("users", array(
			"online_timestamp" => time()
			)
		);
	}

}

?>
