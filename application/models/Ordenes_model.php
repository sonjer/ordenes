<?php
class Ordenes_Model extends CI_Model {
  /*
  Seleccionar Todos los elementos de una tabla
  */

  /********************************************** SELECCION ********************************************************************/

  /************************** ORDEN COMPRA **************************************************************************/
  public function jsonGetOrdenCompra($OrdenComp) {
    //$this->output->enable_profiler(TRUE);
    if($OrdenComp == 'chavelo') :
      $q = $this -> db -> query("SELECT * FROM Ocompras");
      else :
        $q = $this -> db -> query("SELECT * FROM Ocompras where OrdenComp = ?", $OrdenComp);
      endif;

      if ($q -> num_rows() > 0) {
        foreach ($q->result() as $row) {
          $data[] = $row;
        }
        return $data;
      }
    }
    /********************************************** SELECCION ********************************************************************/

    /************************** ORDEN COMPRAS VISTO BUENO **************************************************************************/
    public function jsonGetOrdenCompraVisto($OrdenComp) {
      //$this->output->enable_profiler(TRUE);
      if($OrdenComp == 'chavelo2') :
        $q = $this -> db -> query("SELECT * FROM VistoBueno");
        else :
          $q = $this -> db -> query("SELECT * FROM VistoBueno where OrdenComp = ?", $OrdenComp);
        endif;

        if ($q -> num_rows() > 0) {
          foreach ($q->result() as $row) {
            $data[] = $row;
          }
          return $data;
        }
      }

      /********************************************** SELECCION ********************************************************************/

      /************************** ORDEN COMPRAS VISTO BUENO **************************************************************************/
      public function jsonGetOrdenCompraAut($OrdenComp) {
        //$this->output->enable_profiler(TRUE);
        if($OrdenComp == 'chavelo3') :
          $q = $this -> db -> query("SELECT * FROM AutOrden");
          else :
            $q = $this -> db -> query("SELECT * FROM AutOrden where OrdenComp = ?", $OrdenComp);
          endif;

          if ($q -> num_rows() > 0) {
            foreach ($q->result() as $row) {
              $data[] = $row;
            }
            return $data;
          }
        }
    /********************************************** AUTORIZACION DE ORDEN DE  COMPRA ********************************************************************/

    function autorizarbyID($idCompra){
     $this->output->enable_profiler(TRUE);
      if($this -> db -> query("update ordenescompra SET NumUser = ". $this->user->info->ID .", statusAut = 'Autorizada', FechHoraAut = now() WHERE idCompra = ?;", $idCompra)){
        return 'actualizado';
      }
    }
    /********************************************** VISTO BUENO DE ORDEN DE  COMPRA ********************************************************************/

        function VistoBuenobyID($idCompra){
         $this->output->enable_profiler(TRUE);
          if($this -> db -> query("update ordenescompra SET UserVisBueno = ". $this->user->info->ID .", VistoBueno = 'OK' WHERE idCompra = ?;", $idCompra)){
            return 'actualizado';
          }
        }
  }
  ?>
