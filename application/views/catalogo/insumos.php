<link href="<?php echo base_url(); ?>styles/ui-grid.min.css" rel="stylesheet" type="text/css">
<style>.ui-grid-filter-container { display: none!important; }</style>
<div  id="requisicionID" ng-app="centroCostosApp" ng-controller="centroCostosCtrl2" class="white-area-content">
	<!-- INICIO CONTROLLER -->
	<div id="msj"></div>
	<div>
		<div class="row">
			<div class="col-md-12">
				<div class="panel panel-warning height">
					<div class="panel-heading">
						<span class="glyphicon glyphicon-user"></span> Busqueda de Insumos
						<div class="db-header-extra">
							<strong  ng-click="openModal()"><span class="glyphicon glyphicon-user"></span><span class="glyphicon glyphicon-plus"></span></strong>
						</div>
					</div>
					<div class="panel-body">
							<div class="form-group float-label-control col-sm-2">
								<label for="">Clave:</label>
								<input type="text" class="form-control input-sm" onkeyup="javascript:this.value=this.value.toUpperCase();" ng-model="gridApi.grid.columns[4].filters[0].term" required>
							</div>
							<div class="form-group float-label-control col-sm-4">
								<label for="">Descripcion:</label>
								<input type="text" class="form-control input-sm" maxlength="145" onkeyup="javascript:this.value=this.value.toUpperCase();" ng-model="gridApi.grid.columns[5].filters[0].term" required>
							</div>
							<div class="form-group float-label-control col-sm-2">
								<label for="">Unidad:</label>
								<select class="form-control input-sm" ng-model="gridApi.grid.columns[6].filters[0].term">
									<option value="">Seleccionar</option>
									<?php foreach($unidad->result() as $u) : ?>
									<option value="<?php echo $u->unidad ?>"><?php echo $u->unidad ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group float-label-control col-sm-2">
								<label for="">Tipo:</label>
								<select class="form-control input-sm" ng-model="gridApi.grid.columns[0].filters[0].term">
									<option value="">Seleccionar</option>
									<?php foreach($Tipo->result() as $u) : ?>
									<option value="<?php echo $u->idTipo ?>"><?php echo $u->idTipo .' - '. $u->DescTipo?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group float-label-control col-sm-2">
								<label for="">Clase:</label>
								<select class="form-control input-sm" ng-model="gridApi.grid.columns[1].filters[0].term">
									<option value="">Seleccionar</option>
									<?php foreach($Clase->result() as $u) : ?>
									<option value="<?php echo $u->idClase ?>"><?php echo $u->idClase .' - '. $u->DescClase?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group float-label-control col-sm-2">
								<label for="">Grupo:</label>
								<select class="form-control input-sm" ng-model="gridApi.grid.columns[2].filters[0].term">
									<option value="">Seleccionar</option>
									<?php foreach($Grupo->result() as $u) : ?>
									<option value="<?php echo $u->idGrupo ?>"><?php echo $u->idGrupo .' - '. $u->DescGrupo?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="form-group float-label-control col-sm-2">
								<label for="">Subg:</label>
								<select class="form-control input-sm" ng-model="gridApi.grid.columns[3].filters[0].term">
									<option value="">Seleccionar</option>
									<?php foreach($Subg->result() as $u) : ?>
									<option value="<?php echo $u->idSubg ?>"><?php echo $u->idSubg .' - '. $u->DescSubg?></option>
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
							<input type="text" id="idInsumo" class="form-control input-sm" ng-model="insumo.idInsumo" required>
						</div>
					</div>
					<div class="form-group">
						<label for="username-in" class="col-md-3 label-heading">Descripción</label>
						<div class="col-md-9">
                            <input type="text" class="form-control input-sm" ng-model="insumo.descripcion" required>
						</div>
					</div>

					<div class="form-group">
					    <label for="name-in" class="col-md-3 label-heading">unidad</label>
						<div class="col-md-9">
                            <input type="text" class="form-control input-sm" ng-model="insumo.unidad" required>
						</div>
					</div>
						<div class="form-group">
					    <label for="name-in" class="col-md-3 label-heading">Clase</label>
						<div class="col-md-9">
                            <input type="text" class="form-control input-sm" ng-model="insumo.Clase" required>
						</div>
					</div>
						<div class="form-group">
					    <label for="name-in" class="col-md-3 label-heading">Grupo</label>
						<div class="col-md-9">
                            <input type="text" class="form-control input-sm" ng-model="insumo.Grupo" required>
						</div>
					</div>
						<div class="form-group">
					    <label for="name-in" class="col-md-3 label-heading">SubgRU</label>
						<div class="col-md-3">
                            <input type="text" class="form-control input-sm" ng-model="insumo.Subg" required>
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