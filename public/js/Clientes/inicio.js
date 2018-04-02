$(document).ready(function () {
	// Cargamos los catálogos de la vista
	$rutas = ajax('../Rutas/obtenerRutas', null);
	$.each($rutas, function (i, item) {
		$('#cve_ruta').append("<option value='" + item.cve_ruta + "'>" + item.ruta + "</option>");
	});
	$estados = ajax('../_Sepomex/estados', null);
	$.each($estados, function (i, item) {
		$('#idEstado').append("<option value='" + item.idEstado + "'>" + item.estado + "</option>");
	});
	$('#idEstado').change(function () {
		$('#idMunicipio').empty();
		$municipios = ajax('../_Sepomex/municipios', { idEstado: $('#idEstado').val()});
		$.each($municipios, function (i, item) {
			$('#idMunicipio').append("<option value='" + item.idMunicipio + "'>" + item.municipio + "</option>");
		});
		$('#idMunicipio').selectpicker('refresh');
	});
	$('.selectpicker').selectpicker('refresh');
	// Configuracion del autocomplete de asentamientos
	$('#asentamiento').autocomplete({
		minLength: 3,
		source: function (request, response) {
			$.ajax({
				url: '../_Sepomex/asentamientos',
				dataType: "json",
				data: {
					idEstado: $('#idEstado').val(),
					idMunicipio: $("#idMunicipio").val(),
					term: $('#asentamiento').val()
				},
				success: function (data) {
					response(data);
				}
			});
		},
		delay: 300,
		select: function (evt, ui) {
			$('#idsepomex').val(ui.item.id);
			$('#tipo').val(ui.item.tipo);
			$('#cp').val(ui.item.cp);
			$('#zona').val(ui.item.zona);
			$('#ciudad').val(ui.item.ciudad);
			$('#tipo').closest('div').removeClass('is-empty');
			$('#cp').closest('div').removeClass('is-empty');
			$('#zona').closest('div').removeClass('is-empty');
			$('#ciudad').closest('div').removeClass('is-empty');
		}
	});
	// Configuracion de la tabla de clientes
	$('#tClientes').bootstrapTable({
		data: obtenerClientes(),
		toolbar: '#toolbar',
		clickToSelect: true,
		pagination: true,
		pageSize: 10,
		pageList: [10, 25, 50],
		classes: 'table-condensed',
		columns: [
			{ field: 'cve_cliente', visible: false },
			{ field: 'idsepomex', visible: false },
			{ field: 'cve_ruta', visible: false },
			{ field: 'estatus', visible: false },
			{ field: 'idEstado', visible: false },
			{ field: 'idMunicipio', visible: false },
			{ field: 'direccion', visible: false },
			{ field: 'ciudad', visible: false },
			{ field: 'zona', visible: false },
			{ field: 'cp', visible: false },
			{ field: 'tipo', visible: false },
			{ field: 'nombre', title: 'Nombre(s)', align: 'left', sortable: true },
			{ field: 'apellidos', title: 'Apellidos', align: 'left', sortable: true },
			{ field: 'telefono', title: 'Teléfono', align: 'left', sortable: true },
			{ field: 'ruta', title: 'Ruta', align: 'left', sortable: true },
			{ field: 'estado', title: 'Estado', align: 'left', sortable: true },
			{ field: 'municipio', title: 'Municipio', align: 'left', sortable: true },
			{ field: 'asentamiento', title: 'Asentamiento', align: 'left', sortable: true },
			{
				title: '', align: 'center', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-warning btn-xs editar' title='Ver/Editar información'>Ver</button> <button type='button' class='btn btn-info btn-xs editar' title='Ver estado de cuenta'>Estado</button>";
				}
			}
		],
		onClickRow: function (row, $element, field) {
			$('#cve_cliente').val(row.cve_cliente);
			$('#idsepomex').val(row.idsepomex);
			$('#nombre').val(row.nombre);
			$('#apellidos').val(row.apellidos);
			$('#cve_ruta').selectpicker('val', row.cve_ruta);
			$('#telefono').val(row.telefono);
			$('#idEstado').selectpicker('val', row.idEstado);
			$('#idMunicipio').empty();
			$municipios = ajax('../_Sepomex/municipios', { idEstado: $('#idEstado').val() });
			$.each($municipios, function (i, item) {
				$('#idMunicipio').append("<option value='" + item.idMunicipio + "'>" + item.municipio + "</option>");
			});
			$('#idMunicipio').selectpicker('refresh');
			$('#idMunicipio').selectpicker('val', row.idMunicipio);
			$('#asentamiento').val(row.asentamiento);
			$('#tipo').val(row.tipo);
			$('#cp').val(row.cp);
			$('#zona').val(row.zona);
			$('#ciudad').val(row.ciudad);
			$('#anotaciones').val(row.anotaciones);
			$('#direccion').val(row.direccion);
			$('#estatus').selectpicker('val', row.estatus);
		}
	});

	// Clic en el boton editar de la tabla de clientes
	$('#tClientes tbody').on('click', 'button.editar', function () {
		$('#fClientes input, textarea').closest('div').removeClass('is-empty');
		$('#mClientes').modal('show');
	});

	// Limpiar el formulario de clientes
	$('#mClientes').on('hidden.bs.modal', function (e) {
		$('#cve_cliente, #idsepomex, #nombre, #apellidos, #telefono, #asentamiento, #tipo, #cp, #zona, #ciudad, #anotaciones, #direccion').val('');
		$('#cve_ruta, #idEstado, #idMunicipio, #estatus').selectpicker('val', '');
		$('#idMunicipio').empty().selectpicker('refresh');
		$('#fClientes input, textarea').closest('div').addClass('is-empty');
	}).on('shown.bs.modal', function (e) {
		if ($.cookie('cve_perfil') != '001') {
			$('#fClientes input, textarea').prop('readonly', true);
			$('#fClientes select').prop('disabled', true);
			$('#fClientes button[type="submit"]').addClass('hidden');
		}
		$('#nombre').focus();
	});

	// Ejecucion del formulario de clientes
	$('#fClientes').submit(function (e) {
		e.preventDefault();
		crudClientes();
	});

});

// Funcion para obtener el catalogo de clientes
function obtenerClientes() {
	return ajax('obtenerClientes', null);
}

// Funcion para editar o dar de alta un cliente
function crudClientes() {
	str = $('#fClientes').serialize();
	$.ajax({
		url: 'crudClientes',
		type: 'POST',
		async: true,
		cache: false,
		dataType: 'json',
		data: str,
		beforeSend: function () {
			swal({
				html: '<h3>Guardando datos, espera...</h3>',
				showConfirmButton: false,
				type: 'info'
			});
		},
		success: function (data) {
			if (data.bandera == false) {
				swal({
					title: "Atiende!",
					html: data.msj,
					buttonsStyling: true,
					confirmButtonClass: "btn btn-warning btn-fill",
					type: 'warning'
				});
				return false
			} else {
				$.notify({
					message: data.msj
				}, {
					type: 'success'
					});
				$('#tClientes').bootstrapTable('load', obtenerClientes());
				$('#mClientes').modal('hide');
				swal.close();
			}
		}
	});
}

