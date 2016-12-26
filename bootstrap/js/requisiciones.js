//	Delaclaracion de objetos

var myObject = [];
var numCc = [];
var $sr;
var insumos;
$( document ).ready(function() { //INICIO JQUERY
		/*Inicializar*/
	  getInsumos();
		getMaxidReq();
		$(".datepicker").datepicker({
					dateFormat : 'dd/mm/yy'
		});
		/* fin Inicializar*/
  /* ****************** ComboBox ******************* */
  	$('#cbClientes').on('change', function() {
 			$("#idCliente").val(this.value);
  	});

		$('#cbCentroCostos').on('change', function() {
		    var jsonResponse = JSON.parse(getConsecutivo(this.value));
				$("#idCentroCostos").val(this.value);
				$("#claveCompuesta").val("REQ-" + this.value + "-" + jsonResponse[0]['CountCc'] + "");
				$("#lblIdRequisiciones").html($("#claveCompuesta").val());
		});
  /* ************************************ FIN ComboBox ************************************* */

	/* ************************************* ABRIR MODAL ************************************************** */
	$("#btnBuscar").click(function() {
	    $('#memberModal').modal();
	});

	$("#btnResetTabla").click(function() {
			print_r(jsonResponse['data'][0]['claveCompuesta']);
	});
	/* ************************************* BOTON AÑADIR PARTIDA **************************************** */
	$('#btnAgregar').click(function(){
		$sr = ($(".jdr1").length + 1);
		$('#table tr:last').after('<tr class = "jdr1">'+
		'<td><input class="form-control claveTable" name="table['+ $sr +'][clave]" value="'+ $("#clave1").val() +'"></td>'+
		'<td class="hidden"><input class="requisicionTxt" name="table['+ $sr +'][idRequisiciones]"></td>'+
		'<td><input class="form-control" value="'+ $("#descripcion1").val() +'"></td>'+
		'<td><input class="form-control unidadTable" value="'+ $("#unidad1").val() +'" disable></td>'+
		'<td><input class="form-control buttonSearch" name="table['+ $sr +'][cantidad]" value="'+ $("#cantidad1").val() +'"></td>'+
		'<td><input class="form-control fechaTable" name="table['+ $sr +'][fecha]" value="'+ dateConvert($("#fecha").val()) +'"></td>'+
		'<td><input class="form-control" name="table['+ $sr +'][comentarios]" value="'+ $("#comentarios").val() +'"></td>'+
		'<td><input name="eliminar" class="btnDelete btn btn-danger buttonSearch" value="X"></td>'+
		'</tr>');
		/*myObject.push(
	    {clave: $("#clave1").val(), descripcion1: $("#descripcion1").val() , unidad1: $("#unidad1").val(), cantidad : $("#cantidad1").val(), fecha : $("#fecha").val(), comentarios : $("#comentarios").val()}
		);*/
		getMaxidReq();
		limpiarInput();
		$('#clave1').focus();
		var jsonResponse = JSON.parse($("#idCentroCostos").val());
		$("#claveCompuesta").val("REQ-" + this.value + "-" + jsonResponse[0]['CountCc'] + "");
	});
	/* ************************************* FIN AÑADIR  *************************************************** */
	/* ************************************* BOTON ELIMINAR PARTIDA **************************************** */
	$('#table').on('click', 'input[name="eliminar"]', function () {
	    $(this).closest('tr').remove();
	});
	/* ****************************************************************************************************** */
	/*	**** GuardarRequisicion **** */
	$('#btnAccion').click(function (){
	//	document.forms["formRequisiciones"].submit() === undefined)
			$.post($("#formRequisiciones").attr("action"), $("#formRequisiciones").serialize(),
				function() {
					$.post($("#formDetalles").attr("action"), $("#formDetalles").serialize(),
						function() {
							//After POST
							$('#formRequisiciones')[0].reset();
							$('#formDetalles')[0].reset();
							limpiarTabla();
							var jsonResponse = JSON.parse(getLastInsertedJson("requisiciones", "idRequisiciones"));
							$("#show").html('Requisicion <a href="'+ urlRequisiciones +'preliminar/' + jsonResponse['data'][0]['claveCompuesta'] + '">'+ jsonResponse['data'][0]['claveCompuesta'] + '</a> Guardada Correctamente');
							$("#message").removeClass("hidden");
						});
				});
	});
	/*	**** FIN: GuardarRequisicion **** */

	$('#formDetalles').on('keypress', function(e) {
	    return e.which !== 13;
	});

	$('#buscarInsumos').on('keypress', function(e) {
			return e.which !== 13;
	});

	$( "#clave1" ).change(function() {
	  myFunction($("#clave1").val());
	});

}); //FIN JQUERY

/************************* FUNCIONES **********************************/
function dateConvert(date){
	var d=new Date(date.split("/").reverse().join("-"));
	var dd = d.getDate()+1;
	var mm = d.getMonth()+1;
	var yy = d.getFullYear();
	return yy + "/" + mm + "/" + dd;
}

function loadCostosInfo(id){
	$("#clave1").val(id);
}

function limpiarClaveInsumo(id){
	$("#clave1").val('');
}
/*
Funcion filtar en la lista de insumos
*/

/*
	Funcion: busca un insumo y consulta su descripcion y su unidad de medida
*/
function myFunction(id) {
	var url;
	var insumo = [];
	var length;
	url = urlRequisiciones + 'getWhere/' + id;
	 $.getJSON(url, function (data) {
		 $.each(data, function (i) {
			 insumo.push(data[i])
		 })
		 if (insumo == 0){
				 $("#clave1").val('');
				 $("#descripcion1").val('');
				 $("#unidad1").val('');
				 $('#clave1').focus();
		}else{
				$("#descripcion1").val(insumo[0][0]['descripcion']);
				$("#unidad1").val(insumo[0][0]['unidad']);
				$('#cantidad1').focus();
		}
	 })
	 .fail(function(){
			 	 $("#clave1").val('');
				 $("#descripcion1").val('');
				 $("#unidad1").val('');
				 $('#clave1').focus();
	 });
}

function modalClose(){
	$('#memberModal').modal('toggle');
}

function getMaxidReq(){
	 $.getJSON(urlRequisiciones +'getMaxidReq', function (data) {
		$(".requisicionTxt").val( (parseInt(data[0]['idRequisiciones'])/*+ 1*/) );
	 });
}

function getInsumos() {
	insumos = "";
	 $.getJSON(urlRequisiciones +'getDataJson/insumos', function (data) {
				insumos = data['data'];
	 });
}

getLastInsertedJson = function(table, data_id){
	var result = $.ajax({
		type : "POST",
		url : urlRequisiciones + 'getLastInsertedJson/'+ table +'/' + data_id,
		param: '{}',
		 contentType: "application/json; charset=utf-8",
		 dataType: "json",
		async: false,
		 success: function (data) {
	 }
	}).responseText;
	return result;
}

getConsecutivo = function (idCentroC){
    var result = $.ajax({
        type: "POST",
        url: urlRequisiciones +'getConsecutivo/'+ idCentroC,
       param: '{}',
        contentType: "application/json; charset=utf-8",
        dataType: "json",
       async: false,
        success: function (data) {
      //    return data[0]['CountCc'];
      }
    }) .responseText ;
    return  result;
}

function limpiarTabla() {
		$("#contenido").empty();
}

function limpiarInput() {
		$('#clave1').val('');
		$('#descripcion1').val('');
		$('#unidad1').val('');
		$('#cantidad1').val('');
		$('#fecha').val('');
		$('#comentarios').val('');
		$('#obra').focus();
}

function print_r(printthis, returnoutput) {
	var output = '';

	if ($.isArray(printthis) || typeof (printthis) == 'object') {
		for (var i in printthis) {
			output += i + ' : ' + print_r(printthis[i], true) + '\n';
		}
	} else {
		output += printthis;
	}
	if (returnoutput && returnoutput == true) {
		return output;
	} else {
		alert(output);
	}
}
