var myObject = {};

$(document).ready(function() {

	$("body").on('click', '.btn-add-more', function(e) {
		e.preventDefault();
		var $sr = ($(".jdr1").length + 1);
		var rowid = Math.random();
		var $html = '<tr class="jdr1" id="' + rowid + '">' + '<td><span class="btn btn-sm btn-default">' + $sr + '</span><input type="hidden" name="count[]" value="' + Math.floor((Math.random() * 10000) + 1) + '"></td>' + '<td><input type="text" name="jdate[]" placeholder="Date" class="form-control input-sm datepicker"></td>' + '<td><input type="text" name="jtype[]" placeholder="Travel by" class="form-control input-sm"></td>' + '<td><input type="text" name="jpassanger[]" placeholder="Paasenger count" class="form-control input-sm"></td>' + '<td><input type="text" name="jfrom[]" placeholder="Depart from" class="form-control input-sm"></td>' + '<td><input type="text" name="jto[]" placeholder="Destination" class="form-control input-sm"></td>' + '<td><input type="text" name="jamount[]" placeholder="Amount" class="form-control input-sm"></td>' + '</tr>';
		$("#table-details").append($html);
	});

	$("body").on('click', '.btn-remove-detail-row', function(e) {
		e.preventDefault();
		if ($("#table-details tr:last-child").attr('id') != 'row1') {
			$("#table-details tr:last-child").remove();
		}

	});

	$("body").on('focus', ' .datepicker', function() {
		$(this).datepicker({
			dateFormat : "yy-mm-dd"
		});
	});

	/*
	 $('#btnBuscar').click(function () {

	 $.getJSON('http://localhost/requisiciones/requisiciones/getJson', function (data) {

	 alert(data['insumos'][3].descripcion);
	 $('#memberModal').modal();
	 });
	 });
	 */

	$("#frm_submit").on('submit', function(e) {
		e.preventDefault();
		$.ajax({
			url : '<?php echo base_url() ?>welcome/batchInsert',
			type : 'POST',
			data : $("#frm_submit").serialize()
		}).always(function(response) {
			var r = (response.trim());
			if (r == 1) {
				$(".alert-success").show();
			} else {
				$(".alert-danger").show();
			}
		});
	});

	$(".datepicker").datepicker({
		dateFormat : 'dd/mm/yy'
	});

	$("#tecnico").autocomplete({
		source : "<?php echo base_url(); ?>index.php/os/autoCompleteUsuario",
		minLength : 1,
		select : function(event, ui) {

			$("#usuarios_id").val(ui.item.id);
		}
	});

	$('#example').DataTable({
		"scrollY" : "200px",
		"scrollCollapse" : true,
		"paging" : false
	});

	var monkeyList = new List('test-list', {
		valueNames : ['name'],
		page : 5,
		plugins : [ListPagination({})]
	});

	$("#btnBuscar").click(function() {

		$('#memberModal').modal();
		callInsumos.loadData();
	});

	/*FIN JQUERY*/
});

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
