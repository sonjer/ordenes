<?php
  //if(isset($_POST["data"])) {
    $obj = json_decode(file_get_contents("php://input"));
    print_r($obj);
    // var_dump($data);
/*
    foreach($data->data as $mydata) {

      $idCompra = $mydata->idCompra;
      $CveSuc = $mydata->CveSuc;
      $NoOrden = $mydata->NoOrden;
      echo $idCompra." ".$CveSuc." ".$NoOrden;

    }
*/
  //  echo json_encode($data);
  //}
