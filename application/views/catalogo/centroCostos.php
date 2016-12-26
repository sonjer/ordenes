<link href="<?php echo base_url(); ?>styles/ui-grid.min.css" rel="stylesheet" type="text/css">
<style>.ui-grid-filter-container { display: none!important; }</style>
<div  id="requisicionID" ng-app="centroCostosApp" ng-controller="centroCostosCtrl" class="white-area-content">
	<!-- INICIO CONTROLLER -->
	<div id="msj"></div>
	<div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning height">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-user"></span> Busqueda de CentroCostos
						<div class="db-header-extra">
							<strong  ng-click="openModal()"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-plus"></span></strong>
						</div>
					</div>
					<div class="panel-body">
							<div class="form-group float-label-control col-sm-2">
								<label for="">Clave:</label>
								<input type="text" class="form-control input-sm" onkeyup="javascript:this.value=this.value.toUpperCase();" ng-model="gridApi.grid.columns[0].filters[0].term" required>
							</div>
							<div class="form-group float-label-control col-sm-5">
								<label for="">Descripcion:</label>
								<input type="text" class="form-control input-sm" maxlength="145" onkeyup="javascript:this.value=this.value.toUpperCase();" ng-model="gridApi.grid.columns[1].filters[0].term" required>
							</div>
							<div class="form-group float-label-control col-sm-5">
								<label for="">Centro Costos:</label>
								<select class="form-control input-sm" ng-model="gridApi.grid.columns[2].filters[0].term">
									<option value="">Selecciona</option>
									<?php foreach($clientes->result() as $u) : ?>
									<option value="<?php echo $u->idCliente ?>"><?php echo $u->idCliente .' - '. $u->nombre ?></option>
									<?php endforeach; ?>
								</select>
							</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
					<div id="grid1" ui-grid-selection ng-init="loadData()" external-scopes="gridHandlers" ui-grid="usuarios" class="grid"></div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="memberModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="myModalLabel"><strong>{{titulo}}</strong></h4>
				</div>
				<form class="form-horizontal" ng-submit="asignaDatos()">
				<div class="modal-body">
					
					<div class="form-group">
						<label for="email-in" class="col-md-3 label-heading">Clave</label>
						<div class="col-md-9">
							<input type="text" id="idCentroCostos" class="form-control input-sm" ng-model="ceco.idCentroCostos" required>
						</div>
					</div>
					<div class="form-group">
						<label for="username-in" class="col-md-3 label-heading">Descripción</label>
						<div class="col-md-9">
                            <input type="text" class="form-control input-sm" ng-model="ceco.descripcion" required>
						</div>
					</div>
					<div class="form-group">
					<label for="name-in" class="col-md-3 label-heading">Cliente</label>
						<div class="col-md-9">
							<select class="form-control input-sm" ng-model="ceco.IdCliente" required>
								<option value="">Selecciona</option>
								<?php foreach($clientes->result() as $u) : ?>
								<option value="<?php echo $u->idCliente ?>"><?php echo $u->idCliente .' - '. $u->nombre ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
				<div id="modal-footer" class="modal-footer">
				</div>
				</form>
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