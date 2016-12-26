<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<link href="<?php echo base_url(); ?>styles/ui-grid.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.css">
    <link rel="stylesheet" href="//localhost/intranet/assets/examples.css">
    <script src="//localhost/intranet/assets/jquery.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="//localhost/intranet/assets/bootstrap-table/src/bootstrap-table.js"></script>
    <script src="//localhost/intranet/ga.js"></script>
</head>
<body >
<div class="alert alert-default" role="alert">
<b><script type="text/javascript" > var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); var f=new Date(); document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()); </script><b><br>
<script type="text/javascript" > function startTime(){ today=new Date(); h=today.getHours(); m=today.getMinutes(); s=today.getSeconds(); m=checkTime(m); s=checkTime(s); document.getElementById('reloj').innerHTML=h+":"+m+":"+s; t=setTimeout('startTime()',500);} function checkTime(i) {if (i<10) {i="0" + i;}return i;} window.onload=function(){startTime();} </script> 
<b><div id="reloj" ></div><b>
</a>
<style>.ui-grid-filter-container { display: none!important; }</style>
<div  id="requisicionID" ng-app="centroCostosApp" ng-controller="centroCostosCtrl" class="white-area-content">
	<!-- INICIO CONTROLLER -->
	
        <h4>ORDENES DE COMPRA POR AUTORIZAR</h4>
        <button type="submit" name= "enviar" value= "Aceptar informacion"class="btn btn-primary btn-sm">Autorizar Seleccionados</button><br>
     
		<div class="row">
			<div class="col-md-12">
					<div id="grid1" ui-grid-selection ng-init="loadData()" external-scopes="gridHandlers" ui-grid="usuarios" class="grid"></div>
			</div>
		</div>
	</div>

	<!-- FIN CONTROLLER -->
	<script src="<?php echo base_url(); ?>bootstrap/js/ui-grid.min.js"></script>
	<script>
	function eliminarRegistro(){
          angular.element($('#requisicionID')).scope().eliminar();
	 }	 
	</script>
	<script>
    function stateFormatter(value, row, index) {
        if (index === 2) {
            return {
                disabled: true
            };
        }
        if (index === 5) {
            return {
                disabled: true,
                checked: true
            }
        }
        return value;
    }
</script>
	</body>
</html>