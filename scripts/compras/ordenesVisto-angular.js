var app = angular.module('centroCostosApp', []);
app.controller('centroCostosCtrl', function($scope, $http, comprasFactory2) {

	$scope.loadData = function () {
		$('#table2').bootstrapTable('destroy');
		$http.get(urlOrdenes + 'getOrdenCompraVisto/' + comprasFactory2.data.OrdenComp).success(function(data, status, headers, config) {
				$('#table2').bootstrapTable({
					data: data['data']
				});
		}).error(function(data, status, headers, config) {	});
	}

	$scope.aprobarVistoBueno = function(obj) {
		$http.get(urlOrdenes + 'VistoBuenoCompraID/' + obj.idCompra).success(function(data) {
			$scope.set_flashdata('Se dio Visto Bueno a  la orden de compra !', 'success');
      $scope.loadData();
		});
	};

	$scope.set_flashdata = function(message, priority){
			$("#msj").html('<div id="msjAlert" class="alert alert-'+ priority +' alert-dismissable">' + '<button type="button" class="close" ' + 'data-dismiss="alert" aria-hidden="true">' + '&times;' + '</button><strong>'+ message +'</strong></div>');
			$("#msjAlert").fadeTo(1000, 200).slideUp(200, function(){
			$("#msjAlert").slideUp(200);
			$scope.loadData(); });
	}

});//Fin Controlador

/****************************************************************************************************/

/************************************* UI ROUTER ***************************************************/
app.factory('comprasFactory2', function(){
	return {
		data : {
			idCompra : 'idCompra',
			OrdenComp : 'chavelo2',
			ClaveProv : 'ClaveProv',
		},
	};
});
