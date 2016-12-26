<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Compras {

	var $info=array();
  var $idPartida;

 public function __construct(){
		$CI =& get_instance();
		$data = $CI->db->select("*")
		->where("idPartida", 62)
		->get("datosCompra");

  		if($data->num_rows() == 0) {
  			$CI->template->error("You are missing the site settings database row.");
  		} else {
  			$this->info = $data->row();
  		}
	}

  public function setIdPartida($id){
    return $id;
  }
  
  public function getStatus($idPartida) {
    $getE1 = $this->getE1($idPartida);
    $getE2 = $this->getE2($idPartida);

    if(($getE1[0]->e1 - $getE2[0]->e2) == 0) :
        return 1;
    elseif (($getE1[0]->e1 - $getE2[0]->e2) == $getE1[0]->e1):
        return 0;
    else:
        return -1;
      endif;
  }

 public function getE1($id) {
    $CI =& get_instance();
    $data = $CI -> db -> query("select SUM(cantidad) as e1 from deta_requisiciones WHERE claveCompuesta in (select claveCompuesta from deta_requisiciones WHERE idDetalle = " . $id . ");");

      if($data->num_rows() == 0) {
        $CI->template->error("You are missing the site settings database row.");
      } else {
          foreach ($data->result() as $row) {
            $datos[] = $row;
          }
          return $datos;     
      }
  }

   public function getE2($id) {
    $CI =& get_instance();
    $data = $CI -> db -> query("select COALESCE(SUM(cantComprada), 0) as e2 FROM vistaDatosCompra WHERE claveCompuesta in (select claveCompuesta from deta_requisiciones WHERE idDetalle = " . $id . ");");

      if($data->num_rows() == 0) {
        $CI->template->error("You are missing the site settings database row.");
      } else {
          foreach ($data->result() as $row) {
            $datos[] = $row;
          }
          return $datos;     
      }
  }

function chabelo($data) {
    if (is_object($data)) {
        $data = get_object_vars($data);
    }
        return $data;
}

function arrayCastRecursive($array){
    if (is_array($array)) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->arrayCastRecursive($value);
            }
            if ($value instanceof stdClass) {
                $array[$key] = $this->arrayCastRecursive((array)$value);
            }
        }
    }
    if ($array instanceof stdClass) {
        return $this->arrayCastRecursive((array)$array);
    }
    return $array;
}         

}
?>
