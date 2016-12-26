 <?php


if(isset($_POST["data"]))
{
    $data = json_decode($_POST["data"]);
    //var_dump($data);
    foreach($data->data as $mydata)
    {
         $sql = "UPDATE vistacompras SET statusAut='Autorizada' WHERE idCompra=".$mydata->id;
    }
}

       ?>
