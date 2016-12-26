<link href="<?php echo base_url(); ?>styles/ui-grid.min.css" rel="stylesheet" type="text/css">

<style>
    .grid { height: 248px; } .ui-grid-filter-container { display: none!important; }
.form-control-inline {
    min-width: 0;
    width: auto;
    display: inline;
}
</style>
    <div  id="requisicionID" ng-app="insumosApp" ng-controller="insumosCtrl" class="white-area-content">
        <!-- INICIO CONTROLLER -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-warning height">
                    <div class="panel-heading">
                        <span class="glyphicon glyphicon-user"></span> Datos Generales
                        <div class="db-header-extra">

                        </div>
                    </div>
                    <div class="panel-body">
                       <div class="row">
                        <?php echo form_open_multipart(site_url("admin/edit_member_pro"), array("class" => "form-horizontal")) ?>
                        
                        <div class='form-group col-sm-4' id="nombres_field_box">
                            <div class='col-sm-12' id="nombres_input_box">
                                <input id='txtnombres' class='form-control input-sm' name='nombres' placeholder="Nombres" type='text' value="" maxlength='50' />
                            </div>
                        </div>

                        <div class='form-group col-sm-4' id="apellidos_field_box">
                            <div class='col-sm-12' id="apellidos_input_box">
                                <input id='txtapellidos' class='form-control input-sm' name='apellidos' placeholder="Apellidos" type='text' value="" maxlength='100' />
                            </div>
                        </div>

                        <div class='form-group col-sm-4' id="fechaNacimiento_field_box">
                        <label class="control-label col-sm-5" id="fechaNacimiento_display"> Nacimiento</label>
                            <div class='col-sm-7' id="fechaNacimiento_input_box">
                                <input id='txtfechaNacimiento' name='fechaNacimiento' type='text' value='' maxlength='10' class='datepicker-input form-control  input-sm' />
                            </div>
                        </div>                        

                        <div class='form-group col-sm-4' id="CURP_field_box">
                            <label class="control-label col-sm-3" id="CURP_display">CURP</label>
                            <div class='col-sm-9' id="CURP_input_box">
                                <input id='txtCURP' class='form-control input-sm' ng-model="txtCURP" name='CURP' type='text' value="" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength='18' />
                            </div>
                        </div>

                        <div class='form-group col-sm-4' id="NSS_field_box">
                            <label class="control-label col-sm-2" id="NSS_display">NSS</label>
                            <div class='col-sm-10' id="NSS_input_box">
                                <input id='txtNSS' class='form-control input-sm' name='NSS' onkeyup="javascript:this.value=this.value.toUpperCase();" type='text' value="" maxlength='12' />
                            </div>
                        </div>

                        <div class='input-group col-sm-4' id="RFC_field_box">
                            <label class="control-label col-sm-2" id="RFC_display">R.F.C</label>
                            <span class="input-group-addon" id="basic-addon3">{{txtCURP.substr(9)}}</span>
                            <div class='col-sm-5' id="RFC_input_box">
                                <input id='txtRFC' class='form-control input-sm' name='RFC' onkeyup="javascript:this.value=this.value.toUpperCase();" type='text' value="" maxlength='15' />
                            </div>
                        </div>
                        <div class='form-group col-sm-7 pull-left' id="RFC_field_box">
                            <label class="control-label col-sm-4" id="RFC_display">Lugar de Nacimiento</label>
                            <div class='col-sm-8' id="RFC_input_box">
                                <input id='txtLugarNacimiento' class='form-control input-sm' name='LugarNacimiento' placeholder="Lugar de Nacimiento" type='text' value="" maxlength='100' />

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <button type="button" ng-click="eliminaUsuario()" class="btn btn-danger btn-sm">Cancelar</button>
                                <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
                            </div>                                              
                        </div>                                                
                        <?php echo form_close() ?>
                    </div>
                </div>
            </div>
        </div>        
    </div>

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
                        <label class="control-label col-sm-2" id="domicilio_display">Domicilio</label>
                        <div class='col-sm-6' id="domicilio_input_box">
                            <input id='txtdomicilio' class='form-control input-sm' name='domicilio' type='text' value="" maxlength='200' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="telefono_field_box">
                        <label class="control-label col-sm-2" id="telefono_display">Telefono</label>
                        <div class='col-sm-6' id="telefono_input_box">
                            <input id='txttelefono' class='form-control input-sm' name='telefono' type='text' value="" maxlength='25' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="beneficiarioNombre_field_box">
                        <label class="control-label col-sm-2" id="beneficiarioNombre_display">BeneficiarioNombre</label>
                        <div class='col-sm-6' id="beneficiarioNombre_input_box">
                            <input id='txtbeneficiarioNombre' class='form-control input-sm' name='beneficiarioNombre' type='text' value="" maxlength='200' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="beneficiarioParentesco_field_box">
                        <label class="control-label col-sm-2" id="beneficiarioParentesco_display">BeneficiarioParentesco</label>
                        <div class='col-sm-6' id="beneficiarioParentesco_input_box">
                            <input id='txtbeneficiarioParentesco' class='form-control input-sm' name='beneficiarioParentesco' type='text' value="" maxlength='20' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="beneficiarioRFC_field_box">
                        <label class="control-label col-sm-2" id="beneficiarioRFC_display">BeneficiarioRFC</label>
                        <div class='col-sm-6' id="beneficiarioRFC_input_box">
                            <input id='txtbeneficiarioRFC' class='form-control input-sm' name='beneficiarioRFC' type='text' value="" maxlength='15' />
                        </div>
                    </div>

                    <div class='form-group col-sm-12' id="idEstatus_field_box">
                        <label class="control-label col-sm-2" id="idEstatus_display">IdEstatus</label>
                        <div class='col-sm-6' id="idEstatus_input_box">
                            <input id='txtidEstatus' class='form-control input-sm' name='idEstatus' type='text' value="" maxlength='1' />
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" ng-click="eliminaUsuario()" class="btn btn-danger btn-sm">Eliminar Usuario</button>
                        <button type="submit" class="btn btn-primary btn-sm">Guardar Cambios</button>
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
    var chrCaracter  = "0123456789ABCDEFGHIJKLMNÑOPQRSTUVWXYZ";

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
        alert("La curp: " + curp + " no es valida, verifiqué ");
        return false;
        
    }
    
    if(!(parseInt(lngDigito)==parseInt(digVer)))
    {
        alert("La curp: " + curp + " no es valida, revisé el Digito Verificador (" +  lngDigito + ")");
        return false;
    }
    return true;
}
</script>