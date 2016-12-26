<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Permisos {

	var $info=array();

	var $version = "1.0";

	public function __construct()
	{
		$CI =& get_instance();
        $CI->load->library('user');
        $idUser = 0;

		if(!empty($CI->user->info->ID)){
				$idUser = $CI->user->info->ID;
		}

		$usuario = $CI->db->select("idModulo, modulo, adicionar, listar, modificar, reportes")
		->where("idUser", $idUser)
		->get("vistaPermisos");

		if($usuario->num_rows() == 0) {
           function convertToObject($array) {
                    $object = new stdClass();
                    foreach ($array as $key => $value) {
                        if (is_array($value)) {
                            $value = convertToObject($value);
                        }
                        $object->$key = $value;
                    }
                    return $object;
                }

                $clasa = array('info' => array('idModulo' => '0'));
                $obj = convertToObject($clasa);

            $this->info = $obj->info;
		} else {
			$this->info = $usuario->row();
		}
	}

	public function getPassword()
	{
		$CI =& get_instance();
        $CI->load->library('user');
		$user = $CI->db->select("users.`password`")
		->where("ID", $CI->user->info->ID)->get("users");
		$user = $user->row();
		return $user->password;
	}

}

?>
