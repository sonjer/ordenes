
<!DOCTYPE html>
<html>
<head>

    <title>ICOM INGENIERÍA</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="//localhost/intranet/assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="//localhost/intranet/assets/examples.css">
    <script src="//localhost/intranet/assets/jquery.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="//localhost/intranet/ga.js"></script>
</head>
<body >
<div class="alert alert-info" role="alert">
<b><script type="text/javascript" > var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); var f=new Date(); document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()); </script><b><br>
<script type="text/javascript" > function startTime(){ today=new Date(); h=today.getHours(); m=today.getMinutes(); s=today.getSeconds(); m=checkTime(m); s=checkTime(s); document.getElementById('reloj').innerHTML=h+":"+m+":"+s; t=setTimeout('startTime()',500);} function checkTime(i) {if (i<10) {i="0" + i;}return i;} window.onload=function(){startTime();} </script>
<b><div id="reloj" ></div><b>
</a>
</div>
 <form >
    <div class="container">
        <h4>LISTADO DE ORDENES DE COMPRA</h4>
        <button type="submit" id= "acpt" name= "enviar" class="btn btn-primary btn-sm">Autorizar Seleccionados</button><br>
        <table id="table"
               data-toggle="table"
               data-height="430"
               data-click-to-select="true"
               data-search="true">


            <thead>
            <tr>
                <th data-field="id" data-checkbox="true"></th>
                <th data-field="idCompra">IDCOMP</th>
                <th data-field="CveSuc">CLIENTE</th>
                <th data-field="CeCo" >CeCo</th>
                <th data-field="OrdenComp">#ORDEN</th>
                <th data-field="NomProv">PROVEEDOR</th>
                <th data-field="SubtPed" >SUBTOTAL</th>
                <th data-field="TotalPed" >TOTAL</th>
                <th data-field="StatusPart" >STATUS PART.</th>
                <th data-field="FalltaPed">FECHA PEDIDO</th>
                <th data-field="NumUser" >USUARIO</th>
                <th data-field="statusAut">STATUS AUT.</th>
                <th data-field="FechHoraAut">FECHA Y HORA AUT.</th>
            </tr>
            </thead>
            <?php
      $db_host="localhost";
      $db_user="root";
      $db_password= "";
      $db_name="localicom";
      $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
      $sql = "SELECT idCompra, CveSuc, Ceco,OrdenComp, NomProv, SubtPed, TotalPed, StatusPart, FalltaPed, NumUser, statusAut, FechHoraAut from ordenescompra";
      $resultado = mysqli_query($db_connection,$sql);

      while($row = mysqli_fetch_array($resultado))
      {

        echo "<tr><td width=\"8%\"></td>";
        echo utf8_encode("<td width=\"8%\">" . $row["idCompra"] . "</td>");
        echo utf8_encode("<td width=\"15%\">" .$row["CveSuc"] . "</td>");
        echo utf8_encode("<td width=\"8%\">" . $row["Ceco"] . "</td>");
        echo utf8_encode("<td width=\"15%\">" . $row["OrdenComp"] . "</td>");
        echo utf8_encode("<td width=\"15%\">" . $row["NomProv"] . "</td>");
        echo utf8_encode("<td width=\"8%\">$" .$row["SubtPed"] . "</td>");
        echo utf8_encode("<td width=\"8%\">$" .$row["TotalPed"] . "</td>");
        echo utf8_encode("<td width=\"6%\">" . $row["StatusPart"] . "</td>");
        echo utf8_encode("<td width=\"15%\">" . $row["FalltaPed"] . "</td>");
        echo utf8_encode("<td width=\"8%\">" . $row["NumUser"] . "</td>");
        echo utf8_encode("<td width=\"6%\">" .$row["statusAut"] . "</td>");
        echo utf8_encode("<td width=\"8%\">" . $row["FechHoraAut"]. "</td></tr>");

     }

       mysqli_free_result($resultado);
       mysqli_close($db_connection);
       ?>
        </table>

    </div>
    </form>
    <script type="text/javascript">
    $(document).ready(function(){
            var checkedRows = new Array();
            //Cuando se da clic al checkbox este selecciona las propiedades de la tabla..
            $('#table').on('check.bs.table', function (e, row) {
                  checkedRows.push({id: row.idCompra});
                  console.log(checkedRows);
                });

                $('#table').on('uncheck.bs.table', function (e, row) {
                  $.each(checkedRows, function(index, value) {
                    if (value.id === row.id) {
                      checkedRows.splice(index,1);

                    }
                  });
                  console.log(checkedRows);
                });
//Aqui es donde actualizas tu tabla asignale un id al botón
$('#acpt').on("click",function(e){
         var array = {data: checkedRows};
         var paramJSON = JSON.stringify(array);


         console.log(array);
          $.ajax({
                method: 'POST',
                url: 'http://localhost/correo2/mail.php',
                data: { data: paramJSON },
                cache:false })
                .done(function( msg ) {
                console.log(msg);


              });
              e.preventDefault();
        });

});

</script>
</body>
</html>
