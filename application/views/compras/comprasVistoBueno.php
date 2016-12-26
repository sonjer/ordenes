<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="<?php echo base_url(); ?>styles/ui-grid.min.css" rel="stylesheet" type="text/css">
<link href="<?php echo base_url(); ?>bootstrap/css/bootstrap-table.css" rel="stylesheet" type="text/css">

<style>.ui-grid-filter-container { display: none!important; }</style>
<div  id="requisicionID" ng-app="centroCostosApp" ng-controller="centroCostosCtrl" class="white-area-content">
	<!-- INICIO CONTROLLER -->
	<div id="msj"></div>
		<div class="row">
		<div class="col-md-12">
			<div class="panel panel-warning height">

					  <div class="panel-heading">
					  	<span class="glyphicon glyphicon-user"></span> LISTA DE ORDENES DE COMPRAS
				     </div>
					<div class="alert alert-info" role="alert">
					  <b><script type="text/javascript" > var meses = new Array ("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); var diasSemana = new Array("Domingo","Lunes","Martes","Miércoles","Jueves","Viernes","Sábado"); var f=new Date(); document.write(diasSemana[f.getDay()] + " " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear()); </script><b><br>
					  <script type="text/javascript" > function startTime(){ today=new Date(); h=today.getHours(); m=today.getMinutes(); s=today.getSeconds(); m=checkTime(m); s=checkTime(s); document.getElementById('reloj').innerHTML=h+":"+m+":"+s; t=setTimeout('startTime()',500);} function checkTime(i) {if (i<10) {i="0" + i;}return i;} window.onload=function(){startTime();} </script>
					  <b><div id="reloj" ></div><b>
					  </a>
					</div>
					<h4 align="center">SELECCIONE UNA ORDEN DE COMPRA PARA DAR VISTO BUENO</h4>

             <div class="panel-body">
					  	<table
							    id="table2"
								ng-init="loadData()"
								data-height="430"
								data-detail-view="true"
                                data-detail-formatter="detailFormatter"
								data-click-to-select="true"
								data-search="true">
						  <thead>
						    <tr>

									<th data-field="statusAut" data-checkbox="true" data-formatter="stateFormatter"></th>
									<th data-field="CveSuc">CLIENTE</th>
									<th data-field="NoOrden">ORDEN-COMP</th>
									<th data-field="NomProv">PROVEEDOR</th>
									<th class="col-sm-2" data-field="TotalPed" data-formatter="formatMoney">TOTAL COMP.</th>
									<th data-field="FalltaPed">FECHA PEDIDO</th>
									<th data-field="UserVisBueno" >USUARIO</th>
									<th data-field="VistoBueno">VO-BO</th>


						    </tr>
						    </thead>
					    	</table>
			</div>
		</div>
	</div>
</div>
		</div>
	<!-- FIN CONTROLLER -->
	<script src="<?php echo base_url(); ?>bootstrap/js/ui-grid.min.js"></script>
	<script>
			$('#table2').on('check.bs.table', function (e, row) {
			angular.element($('#requisicionID')).scope().aprobarVistoBueno(row);
	});
	  function stateFormatter(value, row, index) {
         if (value === 'Autorizada') {
             return {
                 disabled: true,
                 checked: true
             }
         }
         return value;
     }
	</script>
<script>
function formatMoney(number, places, symbol, thousand, decimal) {
	number = number || 0;
	places = !isNaN(places = Math.abs(places)) ? places : 2;
	symbol = "$";
	thousand = thousand || ",";
	decimal = decimal || ".";
	var negative = number < 0 ? "-" : "",
	    i = parseInt(number = Math.abs(+number || 0).toFixed(places), 10) + "",
	    j = (j = i.length) > 3 ? j % 3 : 0;
	return symbol + negative + (j ? i.substr(0, j) + thousand : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + thousand) + (places ? decimal + Math.abs(number - i).toFixed(places).slice(2) : "");
}

</script>
<script>
	function detailFormatter(index, row) {
			var html = [];
			$.each(row, function (key, value) {
					html.push('<td><b>' + key + ':</b> ' + value + '</td>');
			});
			return html.join('');
	}
</script>
