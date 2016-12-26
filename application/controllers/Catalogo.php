<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Catalogo extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this -> load -> model("catalogo_model");

        if (!$this -> user -> loggedin) {
        //    redirect(site_url("login"));
        }

        if ($this->user->info->user_level == 6 || $this->user->info->user_level == 7) {
            $this -> template -> error(lang("error_2"));
        }
    }

    public function centroCostos() {
        $this -> template -> loadData("activeLink", array("catalogo" => array("centroCostos" => 1)));
        $this->template->loadExternal('<script type="text/javascript" src="' . base_url() . 'scripts/catalogo/ceco-angular.js" /></script>'.
                                      '<script type="text/javascript" src="' . base_url() . 'bootstrap/js/angular-ui-router.min.js" /></script>');
        $data['clientes'] = $this->catalogo_model->getClientes();
        $this->template->loadContent("catalogo/centroCostos.php", $data);
    }
    public function Insumos() {
        $this -> template -> loadData("activeLink", array("catalogo" => array("insumos" => 1)));
        $this->template->loadExternal('<script type="text/javascript" src="' . base_url() . 'scripts/catalogo/insumos-angular.js" /></script>'.
                                      '<script type="text/javascript" src="' . base_url() . 'bootstrap/js/angular-ui-router.min.js" /></script>');
        $data['unidad'] = $this->catalogo_model->getInsumos();
        $data['Tipo'] = $this->catalogo_model->getTiposProd();
        $data['Clase'] = $this->catalogo_model->getClaseProd();
        $data['Grupo'] = $this->catalogo_model->getGrupoProd();
        $data['Subg'] = $this->catalogo_model->getSubgProd();
        $this->template->loadContent("catalogo/insumos.php", $data);
    }

    /********************************************** SELECCION ********************************************************************/
    function getCentroCostos($idCentroCostos){
        $data['data'] = $this->catalogo_model->jsonGetCentroCostos($idCentroCostos);
         $this->output->set_content_type('application/json');
         $this->output->set_output(json_encode($data));
    }

    public function getRowCentroCostos($idCentroCostos) {
        $data = $this -> catalogo_model -> jsonGetRowCentroCostos($idCentroCostos);
        return $data['0'];
     //  $this -> output -> set_content_type('application/json');
      //  $this -> output -> set_output(json_encode($data['0'], JSON_FORCE_OBJECT));
    }
    /********************************************** SELECCION INSUMOS ********************************************************************/
    function getInsumos($idInsumo){
        $data['data'] = $this->catalogo_model->jsonGetInsumos($idInsumo);
         $this->output->set_content_type('application/json');
         $this->output->set_output(json_encode($data));
    }

    public function getRowInsumos($idInsumo) {
        $data = $this -> catalogo_model -> jsonGetRowInsumos($idInsumo);
        return $data['0'];
     //  $this -> output -> set_content_type('application/json');
      //  $this -> output -> set_output(json_encode($data['0'], JSON_FORCE_OBJECT));
    }
    /********************************************** INSERCION / ACTUALIZACION  ********************************************************************/
    public function saveAcceso(){
        if ($this->user->info->user_level == 5){
            $obj = json_decode(file_get_contents("php://input"));
            $data = $this->getRowCentroCostos($obj->idCentroCostos);
            print_r($obj);
       if (empty($data)) {
             echo $this->catalogo_model->insertCentroCostos($obj);
         } else {
             echo $this->catalogo_model->updateCentroCostos($obj);
         }
     }
     else{
        $this->template->error(lang("error_2"));
    }
}

/*************************INSERCION / ACTUALIZACION INSUMOS **********************************/
    public function saveAccesoInsumo(){
        if ($this->user->info->user_level == 5){
            $obj = json_decode(file_get_contents("php://input"));
            $data = $this->getRowInsumos($obj->idInsumo);
            //print_r($obj);
       if (empty($data)) {
             echo $this->catalogo_model->insertInsumos($obj);
         } else {
             echo $this->catalogo_model->updateInsumos($obj);
         }
     }
     else{
        $this->template->error(lang("error_2"));
    }
}


/********************************************** ELIMINAR ********************************************************************/

public function eliminaCentroCostos(){
    if ($this->user->info->user_level == 5){
        $entry_id = urldecode($this -> uri -> segment(3));
        echo $this->catalogo_model->deleteCentroCostos($entry_id);
    }
    else{
        $this->template->error(lang("error_2"));
    }
}


/********************************************** ELIMINAR INSUMOS********************************************************************/

public function eliminaInsumos(){
    if ($this->user->info->user_level == 5){
        $entry_id = urldecode($this -> uri -> segment(3));
        echo $this->catalogo_model->deleteInsumos($entry_id);
    }
    else{
        $this->template->error(lang("error_2"));
    }
}


}
?>
