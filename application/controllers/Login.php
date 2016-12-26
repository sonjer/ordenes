<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Login extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		$this->load->model("login_model");
		$this->load->model("user_model");
		$this->load->model("home_model");
		$this->load->model("register_model");
	}

	public function index()
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->user_model->check_block_ip()) {
			$this->template->error(lang("error_26"));
		}
		if ($this->user->loggedin) {
			$this->template->error(lang("error_27"));
		}
		$this->template->loadContent("login/index.php", array());
	}

	public function pro() 
	{	
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		if ($this->user_model->check_block_ip()) {
			$this->template->error(lang("error_26"));
		}

		$config = $this->config->item("cookieprefix");
		if ($this->user->loggedin) {
			$this->template->error(lang("error_27"));
		}

		
		$email = $this->input->post("email", true);
		$pass = $this->common->nohtml($this->input->post("pass", true));
		$remember = $this->input->post("remember", true);

		if (empty($email) || empty($pass)) {
			$this->template->error(lang("error_28"));
		}

		$login = $this->login_model->getUserByEmail($email);
		if ($login->num_rows() == 0) {
			$this->template->error(lang("error_29"));
		}
		$r = $login->row();
		$userid = $r->ID;

		$phpass = new PasswordHash(12, false);
    	if (!$phpass->CheckPassword($pass, $r->password)) {
    		$this->template->error(lang("error_29"));
    	}

		// Generate a token
		$token = rand(1,100000) . $email;
		$token = md5(sha1($token));

		// Store it
		$this->login_model->updateUserToken($userid, $token);

		// Create Cookies
		if ($remember == 1) {
			$ttl = 3600*24*31;
		} else {
			$ttl = 3600*24*31;
		}

		setcookie($config . "un", $email, time()+$ttl, "/");
		setcookie($config . "tkn", $token, time()+$ttl, "/");

		redirect(base_url());
	}



	public function logout($hash) 
	{
		$this->template->set_error_view("error/login_error.php");
		$config = $this->config->item("cookieprefix");
		$this->load->helper("cookie");
		if ($hash != $this->security->get_csrf_hash() ) {
			$this->template->error(lang("error_6"));
		}
		delete_cookie($config. "un");
		delete_cookie($config. "tkn");
		delete_cookie($config. "provider");
		delete_cookie($config. "oauthid");
		delete_cookie($config. "oauthtoken");
		delete_cookie($config. "oauthsecret");
		$this->session->sess_destroy();
		redirect(base_url());
	}

	public function resetpw($token,$userid) 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		$userid = intval($userid);
		// Check
		$user = $this->login_model->getResetUser($token, $userid);
		if ($user->num_rows() == 0) {
			$this->template->error(lang("error_42"));
		}

		$r=$user->row();
		if ($r->timestamp +3600*24*7 < time()) {
			$this->template->error(lang("error_43"));
		}

		$this->template->loadContent("login/resetpw.php", 
			array(
				"token" => $token,
				 "userid" => $userid
			)
		);

	}

	public function resetpw_pro($token, $userid) 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		$userid = intval($userid);
		// Check
		$user = $this->login_model->getResetUser($token, $userid);
		if ($user->num_rows() == 0) {
			$this->template->error(lang("error_42"));
		}
		$r=$user->row();
		if ($r->timestamp +3600*24*7 < time()) {
			$this->template->error(lang("error_43"));
		}

		$npassword = $this->common->nohtml(
			$this->input->post("npassword", true)
		);
		$npassword2 = $this->common->nohtml(
			$this->input->post("npassword2", true)
		);

		if ($npassword != $npassword2) {
			$this->template->error(lang("error_44"));
		}

		if (empty($npassword)) {
			$this->template->error(lang("error_45"));
		}

		$password = $this->common->encrypt($npassword);

		$this->login_model->updatePassword($userid, $password);
		$this->login_model->deleteReset($token);
		$this->session->set_flashdata("globalmsg", lang("success_18"));
		redirect(site_url("login"));
	}

	public function forgotpw() 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		$this->template->loadContent("login/forgotpw.php", array());
	}

	public function forgotpw_pro() 
	{	
		$this->template->set_layout("layout/login_layout.php");
		$this->template->set_error_view("error/login_error.php");
		$email = $this->input->post("email", true);

		$log = $this->login_model->getResetLog($_SERVER['REMOTE_ADDR']);
		if ($log->num_rows() > 0) {
			$log = $log->row();
			if ($log->timestamp+ 60*15 > time()) {
				$this->template->error(
					lang("error_46")
				);
			}
		}

		$this->login_model->addToResetLog($_SERVER['REMOTE_ADDR']);

		// Check for email
		$user = $this->login_model->getUserEmail($email);
		if ($user->num_rows() == 0) {
			$this->template->error(
				lang("error_47")
			);
		}
		$user = $user->row();

		$token = rand(10000000,100000000000000000)
		. "HUFI9e9dvcwjecw8392klle@O(*388*&&£^^$$$";

		$token = sha1(md5($token));

		$this->login_model->resetPW($user->ID, $token);

		// Send Email
		$email_template = $this->home_model->get_email_template(1);
		if($email_template->num_rows() == 0) {
			$this->template->error(lang("error_48"));
		}
		$email_template = $email_template->row();

		$email_template->message = $this->common->replace_keywords(array(
			"[NAME]" => $user->name,
			"[SITE_URL]" => site_url(),
			"[EMAIL_LINK]" => 
				site_url("login/resetpw/" . $token . "/" . $user->ID),
			"[SITE_NAME]" =>  $this->settings->info->site_name
			),
		$email_template->message);

		$this->common->send_email($email_template->title,
			 $email_template->message, $email);

		$this->session->set_flashdata("globalmsg", lang("success_19"));
		redirect(site_url("login/forgotpw"));
	}

	public function banned() 
	{
		$this->template->set_error_view("error/login_error.php");
		$this->template->set_layout("layout/login_layout.php");
		$this->template->loadContent("login/banned.php", array());
	}


}

?>