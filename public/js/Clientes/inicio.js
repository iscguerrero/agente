$(document).ready(function () {
	$cve_cliente = $cliente = '';
	// Cargamos los catálogos de la vista
	$rutas = ajax('../Rutas/obtenerRutas', null);
	$.each($rutas, function (i, item) {
		$('#cve_ruta').append("<option value='" + item.cve_ruta + "'>" + item.ruta + "</option>");
		$('#_cve_ruta').append("<option value='" + item.cve_ruta + "'>" + item.ruta + "</option>");
	});
	$('#_cve_ruta').append("<option value=''>Todas</option>");
	$estados = ajax('../_Sepomex/estados', null);
	$.each($estados, function (i, item) {
		$('#idEstado').append("<option value='" + item.idEstado + "'>" + item.estado + "</option>");
	});
	$('#idEstado').change(function () {
		$('#idMunicipio').empty();
		$municipios = ajax('../_Sepomex/municipios', { idEstado: $('#idEstado').val() });
		$.each($municipios, function (i, item) {
			$('#idMunicipio').append("<option value='" + item.idMunicipio + "'>" + item.municipio + "</option>");
		});
		$('#idMunicipio').selectpicker('refresh');
		$('#idsepomex, #tipo, #cp, #zona, #ciudad, #asentamiento').val('');
	});
	$('#idMunicipio').change(function () {
		$('#idsepomex, #tipo, #cp, #zona, #ciudad, #asentamiento').val('');
	});
	$articulos = ajax('../Articulos/obtenerArticulos', null);
	$.each($articulos, function (i, item) {
		$('#cve_articulo').append("<option value='" + item.cve_articulo + "'>" + item.articulo + "</option>");
		$('#_cve_articulo').append("<option value='" + item.cve_articulo + "'>" + item.articulo + "</option>");
	});
	// Cargar el catálogo de clientes al seleccionar una ruta
	$('#_cve_ruta').change(function () {
		$('#tClientes').bootstrapTable('load', obtenerClientes());
	});
	// Obtenemos el precio del articulo seleccionado
	$('#cve_articulo').change(function () {
		$articulo = ajax('../Articulos/obtenerArticulo', { cve_articulo: $('#cve_articulo').val() });
		$('#precio_venta').val($articulo.precio_venta).closest('div');
	});
	$('#_cve_articulo').change(function () {
		$articulo = ajax('../Articulos/obtenerArticulo', { cve_articulo: $('#_cve_articulo').val() });
		$('#_precio_venta').val($articulo.precio_venta).closest('div');
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
		}
	});
	// Configuracion de la tabla de clientes
	$('#tClientes').bootstrapTable({
		data: [],
		toolbar: '#toolbar',
		search: true,
		showColumns: true,
		clickToSelect: true,
		pagination: false,
		showToggle: true,
		icons: {
			paginationSwitchDown: 'glyphicon-collapse-down icon-chevron-down',
			paginationSwitchUp: 'glyphicon-collapse-up icon-chevron-up',
			refresh: 'glyphicon-refresh icon-refresh',
			toggle: 'fa fa-list-alt',
			columns: 'fa fa-list',
			detailOpen: 'glyphicon-plus icon-plus',
			detailClose: 'glyphicon-minus icon-minus'
		},
		classes: 'table table-hover',
		columns: [
			{radio: true},
			{ field: 'ruta', title: 'Ruta', halign: 'left', align: 'left', sortable: true },
			{
				field: 'nombre', title: 'Cliente', halign: 'left', align: 'left', sortable: true, formatter: function (value, row, index) {
					_value = row.apellidos + ' ' + row.nombre;
					if (row.clase == 'danger') {
						_value = "<strong style='color: #EB5E28'>" + row.apellidos + ' ' + row.nombre + '</strong>';
					} else if (row.clase == 'warning') {
						_value = "<strong style='color: #F3BB45'>" + row.apellidos + ' ' + row.nombre + '</strong>';
					} else if (row.clase == 'success') {
						_value = "<strong style='color: #7A9E9F'>" + row.apellidos + ' ' + row.nombre + '</strong>';
					}
					return _value;
				}
			},
			{
				field: 'clase', title: 'Reputación', halign: 'center', align: 'center', sortable: true, formatter: function (value, row, index) {
					_value = '';
					switch (value) {
						case 'danger':
							_value = "<strong style='color: #EB5E28'>mala</strong>";
							break;
						case 'warning':
							_value = "<strong style='color: #F3BB45'>regular</strong>";
							break;
						case 'success':
							_value = "<strong style='color: #7A9E9F'>buena</strong>";
							break;
						default:
							break;
					}
					return _value;
				}
			},
			{ field: 'telefono', title: 'Teléfono', halign: 'left', align: 'left', visible: false },
			{ field: 'estado', title: 'Estado', halign: 'left', align: 'left', visible: false, visible: false },
			{ field: 'municipio', title: 'Municipio', halign: 'left', align: 'left', sortable: true, visible: false },
			{ field: 'asentamiento', title: 'Asentamiento', halign: 'left', align: 'left', sortable: true },
			{ field: 'direccion', title: 'Dirección', halign: 'left', align: 'left', sortable: true },
			{
				field: 'periodicidad', title: 'Periodo', halign: 'left', align: 'left', formatter: function (value, row, index) {
					_value = '';
					switch (value) {
						case 'A':
							_value = 'Semanal';
							break;
						case 'B':
							_value = 'Quincenal';
							break;
						case 'C':
							_value = 'Mensual';
							break;
						case 'D':
							_value = 'Bimestral';
							break;
						default:
							_value = 'N/A';
							break;
					}
					return _value + '($' + formato_numero(row.importe_abono, 1, '.', ',') + ')';
				}
			},
			{
				field: 'articulos', title: 'Articulo(s)', halign: 'left', align: 'left', formatter: function (value, row, index) {
					if (row.articulos.length > 0)
						return row.articulos.join();
					else
						return '';
				}
			},
			{
				field: 'venta', title: 'Venta', halign: 'right', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 1, '.', ',');
				}
			},
			{
				field: 'fecha_ultimo_abono', title: 'Último abono', align: 'right', formatter: function (value, row, index) {
					return value + ' ($' + formato_numero(row.importe_ultimo_abono, 2, '.', ',') + ')(' + row.dias + ')';
				}
			},
			{
				field: 'saldo', title: 'Saldo', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 1, '.', ',');
				}
			},
			{ field: 'cve_cliente', visible: false },
			{ field: 'estatus', visible: false },
			{ field: 'idEstado', visible: false },
			{ field: 'idMunicipio', visible: false },
			{ field: 'ciudad', visible: false },
			{ field: 'zona', visible: false },
			{ field: 'cp', visible: false },
			{ field: 'tipo', visible: false },
			{ field: 'apellidos', visible: false },
			{ field: 'idsepomex', visible: false },
			{ field: 'cve_ruta', visible: false },
		],
		onClickRow: function (row, $element, field) {
			$cve_cliente = row.cve_cliente;
			$cliente = row.nombre + ' ' + row.apellidos;
			$('#cve_cliente').val(row.cve_cliente);
			$('#_cve_cliente').val(row.cve_cliente);
			$('#__cve_cliente').val(row.cve_cliente);
			$('#importe').val(row.importe_abono);
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
			$('#periodicidad').selectpicker('val', row.periodicidad);
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
	// Limpiar el formulario de clientes
	$('#mClientes').on('hidden.bs.modal', function (e) {
		$('#fClientes input, textarea').val('');
		$('#cve_ruta, #idEstado, #idMunicipio, #estatus, #periodicidad, #_cve_articulo').selectpicker('val', '');
		$('#idMunicipio').empty().selectpicker('refresh');
		$('#tClientes').bootstrapTable('uncheckAll');
	}).on('shown.bs.modal', function (e) {
		if ($.cookie('cve_perfil') != '001') {
			$('#fClientes input, textarea').prop('readonly', true);
			$('#fClientes select').prop('disabled', true);
		}
		if ($('#cve_ruta').val() == '') {
			$('#cve_ruta').selectpicker('val', $('#_cve_ruta').val());
		}
		if ($('#cve_cliente').val() == '') {
			$('#_cve_articulo').prop('disabled', false);
			$('#_precio_venta, #_importe_abono').prop('readonly', false)
		} else {
			$('#_cve_articulo').prop('disabled', true);
			$('#_precio_venta, #_importe_abono').prop('readonly', true);
		}
		$('#nombre').focus();
	});
	// Limpiar el formulario de ventas
	$('#mVentas').on('hidden.bs.modal', function (e) {
		$('#tClientes').bootstrapTable('uncheckAll');
		$('#fVentas input, textarea').val('');
		$('#fPagos input, textarea').val('');
		$('#cve_articulo').selectpicker('val', '');
	});
	// Limpiar el formulario de pagos
	$('#mPagos').on('hidden.bs.modal', function (e) {
		$('#tClientes').bootstrapTable('uncheckAll');
		$('#fVentas input, textarea').val('');
		$('#fPagos input, textarea').val('');
		$('#es_nota_de_credito').prop('checked', false);
	});
	// Abrir el modal para dar de alta un nuevo cliente
	$('#btnAlta').click(function () {
		$('#fClientes input, textarea').val('');
		$('#cve_ruta, #idEstado, #idMunicipio, #estatus, #periodicidad').selectpicker('val', '');
		$('#idMunicipio').empty().selectpicker('refresh');
		$('#mClientes').modal('show');
	});
	// Abrir el modal para editar la información del cliente
	$('#btnVer').click(function () {
		if ($('#cve_cliente').val() == '') {
			swal({
				html: '<h3>Selecciona un cliente del reporte para visualizar</h3>',
				showConfirmButton: false,
				type: 'warning'
			});
		} else {
			$('#mClientes').modal('show');
		}
	});
	// Abrir el estado de cuenta del cliente
	$('#btnEstado').click(function () {
		if ($('#cve_cliente').val() == '') {
			swal({
				html: '<h3>Selecciona un cliente del reporte para visualizar el estado de cuenta</h3>',
				showConfirmButton: false,
				type: 'warning'
			});
		} else { 
			$.cookie('cve_cliente', $cve_cliente, { path: '/' });
			$.cookie('cliente', $cliente, { path: '/' });
			window.location.href = '../Cobranza/Inicio';
		}
	});
	// Abrir el modal para registrar un nuevo pago
	$('#btnPago').click(function () {
		if ($('#__cve_cliente').val() == '') {
			swal({
				html: '<h3>Selecciona un cliente del reporte para registrar pago</h3>',
				showConfirmButton: false,
				type: 'warning'
			});
		} else {
			$('#mPagos').modal('show');
		}
	});
	// Abrir el modal para registrar una nueva venta
	$('#btnVenta').click(function () {
		if ($('#_cve_cliente').val() == '') {
			swal({
				html: '<h3>Selecciona un cliente del reporte para registrar venta</h3>',
				showConfirmButton: false,
				type: 'warning'
			});
		} else {
			$('#mVentas').modal('show');
		}
	});
	// Ejecucion del formulario de clientes
	$('#fClientes').submit(function (e) {
		e.preventDefault();
		crudClientes();
	});
	// Ejecucion del formulario de pagos
	$('#fPagos').submit(function (e) {
		e.preventDefault();
		crudPagos();
	});
	// Ejecucion del formulario de ventas
	$('#fVentas').submit(function (e) {
		e.preventDefault();
		crudVentas();
	});
});
// Funcion para obtener el catalogo de clientes
function obtenerClientes() {
	return ajax('obtenerClientes', { cve_ruta: $('#_cve_ruta').val() });
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
// Funcion para dar de alta una nueva venta
function crudVentas() {
	str = $('#fVentas').serialize();
	$.ajax({
		url: '../Cobranza/crudVentas',
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
				$('#mVentas').modal('hide');
				swal.close();
			}
		}
	});
}
// Funcion para dar de alta un nuevo pago
function crudPagos() {
	str = $('#fPagos').serialize();
	$.ajax({
		url: '../Cobranza/crudPagos',
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
				$('#mPagos').modal('hide');
				swal.close();
			}
		}
	});
}