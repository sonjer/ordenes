<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class OrdenesCompra extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this -> load -> model("Ordenes_model");

        if (!$this -> user -> loggedin) {
        //    redirect(site_url("login"));
        }

        if ($this->user->info->user_level == 6 || $this->user->info->user_level == 7) {
            $this -> template -> error(lang("error_2"));
        }
    }
    public function compras() {
        $this->template->loadExternal('<script type="text/javascript" src="' . base_url() . 'scripts/compras/ordenes-angular.js" /></script>'.
                                        '<script type="text/javascript" src="' . base_url() . 'bootstrap/js/bootstrap-table.js" /></script>');
        //$data['clientes'] = $this->Ordenes_model->getClientes();
        $this->template->loadContent("compras/compras.php");
    }

    public function comprasVistoBueno() {
        $this->template->loadExternal('<script type="text/javascript" src="' . base_url() . 'scripts/compras/ordenesVisto-angular.js" /></script>'.
                                        '<script type="text/javascript" src="' . base_url() . 'bootstrap/js/bootstrap-table.js" /></script>');
        //$data['clientes'] = $this->Ordenes_model->getClientes();
        $this->template->loadContent("compras/comprasVistoBueno.php");
    }

    public function comprasAut() {
        $this->template->loadExternal('<script type="text/javascript" src="' . base_url() . 'scripts/compras/ordenesAut-angular.js" /></script>'.
                                      '	<script src="' . base_url() . 'bootstrap/js/accounting.min.js"></script>'.
                                        '<script type="text/javascript" src="' . base_url() . 'bootstrap/js/bootstrap-table.js" /></script>');
        //$data['clientes'] = $this->Ordenes_model->getClientes();
        $this->template->loadContent("compras/comprasAut.php");
    }

    /********************************************** SELECCION ********************************************************************/
    function getOrdenCompra($OrdenComp){
        $data['data'] = $this->Ordenes_model->jsonGetOrdenCompra($OrdenComp);
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    function getOrdenCompraVisto($OrdenComp){
        $data['data'] = $this->Ordenes_model->jsonGetOrdenCompraVisto($OrdenComp);
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    function getOrdenCompraAut($OrdenComp){
        $data['data'] = $this->Ordenes_model->jsonGetOrdenCompraAut($OrdenComp);
        $this->output->set_content_type('application/json');
        $this->output->set_output(json_encode($data));
    }

    public function autorizarCompraID($idCompra){
      echo $this->Ordenes_model->autorizarbyID($idCompra);
    }

    public function VistoBuenoCompraID($idCompra){
      echo $this->Ordenes_model->VistoBuenobyID($idCompra);
    }
}
?>
