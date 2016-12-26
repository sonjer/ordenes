var app = angular.module('centroCostosApp', []);
app.controller('centroCostosCtrl', function($scope, $http, comprasFactory) {

	$scope.loadData = function () {
		$('#table2').bootstrapTable('destroy');
		$http.get(urlOrdenes + 'getOrdenCompra/' + comprasFactory.data.OrdenComp).success(function(data, status, headers, config) {
				$('#table2').bootstrapTable({
					data: data['data']
				});
		}).error(function(data, status, headers, config) {	});
	}

	$scope.aprobar = function(obj) {
		$http.get(urlOrdenes + 'autorizarCompraID/' + obj.idCompra).success(function(data) {
			$scope.set_flashdata('Se autorizo la orden de compra correctamente!', 'success');
			$http({
					url : 'http://localhost/correo/mail.php',
					method : "POST",
					data : obj,
			}).success(function(data) {
				print_r(data);
			});
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
app.factory('comprasFactory', function(){
	return {
		data : {
			idCompra : 'idCompra',
			OrdenComp : 'chavelo',
			ClaveProv : 'ClaveProv',
		},
	};
});
