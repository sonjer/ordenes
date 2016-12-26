<link href="<?php echo base_url(); ?>styles/ui-grid.min.css" rel="stylesheet" type="text/css">

<style>
    .grid { height: 248px; } .ui-grid-filter-container { display: none!important; }
.form-control-inline {
    min-width: 0;
    width: auto;
    display: inline;
}
</style>
<style>
#div1 {
    overflow:scroll;
    height:200px;
    width:1050px;
}

#div1 table {
    width:1050px;
    
}

</style>

    <div  id="requisicionID" ng-app="insumosApp" ng-controller="insumosCtrl" class="white-area-content">
        <!-- INICIO CONTROLLER -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning height">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span> NUEVO REGISTRO DE EGRESO CAJA
                        <div class="db-header-extra">

                        </div>
                    </div>
                    <div class="panel-body">
                       <div class="row">
                     
                         <form method="post" action="add_reg.php">                  
                        <div class="col-xs-3 col-sm-3">
                         <div class="input-group">
                          <div class="input-group-btn">
                           <button type="button" class="btn btn-default dropdown-toggle input-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">CeCo <span class="caret"></span></button>
                           <ul class="dropdown-menu">
                            <li><a href="#">LG000</a></li>
                            <li><a href="#">LG001</a></li>
                            <li><a href="#">LG002</a></li>
                           </ul>
                          </div><!-- /btn-group -->
                         <input type="text" class="form-control input-sm" aria-label="..." name = "Ccostos" value=""  >
                        </div><!-- /input-group -->
                       </div><!-- /.col-xs-2 -->

                        <div class='form-group col-sm-4' id="apellidos_field_box">
                            <label class="control-label col-sm-3" id="fechaNacimiento_display"> FACTURA</label>
                            <div class='col-sm-9' id="apellidos_input_box">
                                <input id='txtapellidos' class='form-control input-sm' name='factura' placeholder="NUMERO DE FACTURA" type='text' value="" maxlength='100' />
                            </div>
                        </div>

                       <div class='form-group col-sm-4' id="apellidos_field_box">
                            <label class="control-label col-sm-3" id="fechaNacimiento_display"> FECHA</label>
                            <div class='col-sm-9' id="apellidos_input_box">
                                <input id='txtapellidos' class='form-control input-sm' name='fecha' placeholder="NUMERO DE FACTURA" type='text' value="" maxlength='100' />
                            </div>
                        </div>                   
                     
                        <div class='form-group col-sm-7' id="NSS_field_box">
                            <label class="control-label col-sm-3" id="NSS_display">PROVEEDOR</label>
                            <div class='col-sm-9' id="NSS_input_box">
                                    <input id='txtLproveedor' class='form-control input-sm' name='proveedor' placeholder="Nombre Proveedor" type='text' value="" maxlength='100' />
                            </div>
                        </div>
                        <div class='form-group col-sm-4 pull-right' id="RFC_field_box">
                            <label class="control-label col-sm-3" id="RFC_display">IMPORTE</label>
                            <div class='col-sm-6' id="RFC_input_box">
                                 <input id='txtLimporte' class='form-control input-sm' name='importe'  type='text' value="" maxlength='100' />
                            </div>
                        </div><br>
                        <div class='form-group col-sm-7 pull-left' id="RFC_field_box">
                            <label class="control-label col-sm-3" id="RFC_display">DESCRIPCION</label>
                            <div class='col-sm-9' id="RFC_input_box">
                                <input id='txtdescripcion' class='form-control input-sm' name='descripcion' placeholder="Descripción" type='text' value="" maxlength='100' />

                            </div>
                        </div>
                        <div class='form-group col-sm-4 pull-right' id="RFC_field_box">
                            <label class="control-label col-sm-3" id="RFC_display">I.V.A</label>
                            <div class='col-sm-6' id="RFC_input_box">
                                 <input id='txtLimporte' class='form-control input-sm' name='iva'  type='text' value="" maxlength='100' />
                            </div>
                        </div>
                        <div class='form-group col-sm-4 pull-right' id="RFC_field_box">
                            <label class="control-label col-sm-3" id="RFC_display">MONTO TOTAL</label>
                            <div class='col-sm-6' id="RFC_input_box">
                                 <input id='txtLimporte' class='form-control input-sm' name='Total'  type='text' value="" maxlength='100' />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-8 pull-center ">
                                <button type="button" ng-click="eliminaUsuario()" class="btn btn-danger btn-sm">Cancelar</button>
                                <button type="submit" name= "enviar" value= "Aceptar informacion"class="btn btn-primary btn-sm">Guardar</button>
                            </div>                                              
                        </div>      
                        </form>                                         
                    </div>
                </div>
            </div>
        </div>        
    </div>
    <div id="div1" >
      <table class="table" cell><tr class="info">
       <td><font face="verdana"><b>CeCost</b></font></td>
       <td><font face="verdana"><b>Factura</b></font></td>
       <td><font face="verdana"><b>Fecha</b></font></td>
       <td><font face="verdana"><b>Proveedor</b></font></td>
       <td><font face="verdana"><b>Descripción</b></font></td>
       <td><font face="verdana"><b>Importe</b></font></td>
       <td><font face="verdana"><b>iva</b></font></td>
       <td><font face="verdana"><b>Total</b></font></td></tr>
     <?php  

      $db_host="localhost";
      $db_user="root";
      $db_password= "";
      $db_name="localicom";
      $db_table_name="detalle_caja_chica";

      $db_connection = mysqli_connect($db_host, $db_user, $db_password, $db_name);
      $sql = "SELECT Ccostos, factura, fecha, proveedor, descripcon, importe, iva, total FROM detalle_caja_chica ";
      $resultado = mysqli_query($db_connection,$sql);
      $numero = 0;
      while($row = mysqli_fetch_array($resultado))
      {
        echo "<tr><td width=\"8%\"><font face=\"verdana\">" .
	        $row["Ccostos"] . "</font></td>";
        echo "<td width=\"15%\"><font face=\"verdana\">" .
	        $row["factura"] . "</font></td>";
        echo "<td width=\"13%\"><font face=\"verdana\">" .
	        $row["fecha"] . "</font></td>";
        echo "<td width=\"20%\"><font face=\"verdana\">" .
	        $row["proveedor"] . "</font></td>";
        echo "<td width=\"25%\"><font face=\"verdana\">" .
	        $row["descripcon"] . "</font></td>";
        echo "<td width=\"8%\"><font face=\"verdana\">$" .
	        $row["importe"] . "</font></td>";
        echo "<td width=\"6%\"><font face=\"verdana\">" .
	        $row["iva"] . "</font></td>";
        echo "<td width=\"8%\"><font face=\"verdana\">$" .
	        $row["total"]. "</font></td></tr>";
        $numero++;
     }
       echo "<tr><td colspan=\"15\"><font face=\"verdana\"><b>Registros: " . $numero . 
         "</b></font></td></tr>";
       mysqli_free_result($resultado);
       mysqli_close($db_connection);
       ?>
      </table>
      </div><br>
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-warning height">
                <div class="panel-heading">
                    <span class="glyphicon glyphicon-user"></span> Datos Generales
                    <div class="db-header-extra">

                    </div>
                </div>
                <div class="panel-body">
                    <?php echo form_open_multipart(site_url("admin/edit_member_pro"), array("class" => "form-horizontal")) ?>

                    <div class='form-group col-sm-12' id="domicilio_field_box">
                        <label class="control-label col-sm-3" id="domicilio_display">SEMANA</label>
                        <div class='col-sm-3' id="domicilio_input_box">
                            <input id='txtdomicilio' class='form-control input-sm' name='semana' type='text' value="" maxlength='200' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="telefono_field_box">
                        <label class="control-label col-sm-3" id="telefono_display">FECHA</label>
                        <div class='col-sm-3' id="telefono_input_box">
                            <input id='txttelefono' class='form-control input-sm' name='fecha' type='text' value="" maxlength='25' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="beneficiarioNombre_field_box">
                        <label class="control-label col-sm-3" id="beneficiarioNombre_display">MONTO CAJA</label>
                        <div class='col-sm-3' id="beneficiarioNombre_input_box">
                            <input id='txtbeneficiarioNombre' class='form-control input-sm' name='monto_de_caja' type='text' value="" maxlength='200' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="beneficiarioParentesco_field_box">
                        <label class="control-label col-sm-3" id="beneficiarioParentesco_display">DIFERENCIA </label>
                        <div class='col-sm-3' id="beneficiarioParentesco_input_box">
                            <input id='txtbeneficiarioParentesco' class='form-control input-sm' name='diferencia' type='text' value="" maxlength='20' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="beneficiarioRFC_field_box">
                        <label class="control-label col-sm-3" id="beneficiarioRFC_display">SOLICITA</label>
                        <div class='col-sm-3' id="beneficiarioRFC_input_box">
                            <input id='txtbeneficiarioRFC' class='form-control input-sm' name='solicita' type='text' value="" maxlength='15' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="idEstatus_field_box">
                        <label class="control-label col-sm-3" id="idEstatus_display">CONSECUTIVO</label>
                        <div class='col-sm-3' id="idEstatus_input_box">
                            <input id='txtidEstatus' class='form-control input-sm' name='consecutivo' type='text' value="" maxlength='10' />
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" ng-click="eliminaUsuario()" class="btn btn-danger btn-sm">Eliminar </button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar</button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>        
    </div>    
</div>
<blockquote>
  <p>Solo se puede eliminar al usuario siempre y cuando no tenga asignado Clientes o CeCo y no haya requisitado.</p>
</blockquote>
<script src="<?php echo base_url(); ?>bootstrap/js/ui-grid.min.js"></script>
 <script src=" https://framework-gb.cdn.gob.mx/assets/scripts/jquery-ui-datepicker.js"></script>
 <script src="<?php echo base_url(); ?>scripts/custom/inputmask.js"></script>
<script>
 /* BUSQUEDA DE CLIENTES Y CECO : REQUISITORES Y RESIDENTES */
function NumAndTwoDecimals(e , field) {
    var val = field.value;
    var re = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)$/g;
    var re1 = /^([0-9]+[\.]?[0-9]?[0-9]?|[0-9]+)/g;
    if (re.test(val)) {
        //do something here

    } else {
        val = re1.exec(val);
        if (val) {
            field.value = val[0];
        } else {
            field.value = "";
        }
    }
}

$('#txtNSS').keyup(function() {
    var $th = $(this);
    $th.val( $th.val().replace(/[^a-zA-Z0-9]/g, function(str) {  return ''; } ) );
});

//$("#txtLugarNacimiento").mask("PEPF910227HVZRRR07");
//$("#txtCURP").inputmask({ mask: function () { /* do stuff */ return ["AAAA999999AAAAAA99"]; }});
$("#txtCURP").inputmask({ mask: "AAAA999999AAAAAA99"});

$("#txtCURP").blur(function(){
    var $th = $(this);
    var validation = validaCURP2($th.val());
    if(validation == false ){

    }
});

function validaCURP2(curp){
    var segRaiz = "";
    var digVer  = "";
    var lngSuma      = 0.0;
    var lngDigito    = 0.0;
    var strDigitoVer = "";
    var intFactor    = new Array(17);
    var chrCaracter  = "0123456789ABCDEFGHIJKLMN�OPQRSTUVWXYZ";

    segRaiz = curp.substring(0,17);
    digVer  = curp.substring(17,18);
    
    for(var i=0; i<17; i++)
    {
        for(var j=0;j<37; j++)
        {
            if(segRaiz.substring(i,i+1)==chrCaracter.substring(j,j+1))
            {               
                intFactor[i]=j;
            }
        }
    }
    
    for(var k = 0; k < 17; k++)
    {
        lngSuma= lngSuma + ((intFactor[k]) * (18 - k));
    }
    
    lngDigito= (10 - (lngSuma % 10));
    
    if(lngDigito==10)
    {
        lngDigito=0;
    }

    var reg = /[A-Z]{4}\d{6}[HM][A-Z]{2}[B-DF-HJ-NP-TV-Z]{3}[A-Z0-9][0-9]/;
    if(curp.search(reg))
    {
        alert("La curp: " + curp + " no es valida, verifiqu� ");
        return false;
        
    }
    
    if(!(parseInt(lngDigito)==parseInt(digVer)))
    {
        alert("La curp: " + curp + " no es valida, revis� el Digito Verificador (" +  lngDigito + ")");
        return false;
    }
    return true;
}
</script>