<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model("user_model");
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
	}

	public function index($username="")
	{
		$this->template->loadData("activeLink",
			array("settings" => array("general" => 1)));

		if(empty($username)) $this->template->error(lang("error_51"));

			$user = $this->user_model->get_user_by_username($username);
		if($user->num_rows() == 0) $this->template->error(lang("error_52"));
			$user = $user->row();

		if($user->user_level == -1) $this->template->error(lang("error_53"));

			$groups = $this->user_model->get_user_groups($user->ID);
			$permisos = $this->user_model->get_user_permisos($user->ID);

		$this->template->loadContent("profile/index.php", array(
			"user" => $user,
			"groups" => $groups,
			"permisos" => $permisos
			)
		);
	}

}

?>
