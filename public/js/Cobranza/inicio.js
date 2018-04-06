$(document).ready(function () {
	$itemVenta = '';
	$itemPago = '';
	// Ocultamos los filtros de cliente en caso de que se haya definido la cookie del cliente
	if (typeof $.cookie('cve_cliente') != 'undefined') {
		$('#cliente, #_cliente, #__cliente').closest('div').hide();
		$('#title').html('Estado de cuenta de ' + $.cookie('cliente'));
		$('#tVentas, #tPagos').bootstrapTable('hideColumn', 'cliente');
	}

	// Autocomplete de los campos del nombre de cliente
	$('#cliente').autocomplete({
		minLength: 3,
		source: '../Clientes/autocomplete',
		select: function (evt, ui) {
			$('#cve_cliente').val(ui.item.cve_cliente);
		}
	});
	$('#_cliente').autocomplete({
		minLength: 3,
		source: '../Clientes/autocomplete',
		select: function (evt, ui) {
			$('#_cve_cliente').val(ui.item.cve_cliente);
		}
	});
	$('#__cliente').autocomplete({
		minLength: 3,
		source: '../Clientes/autocomplete',
		select: function (evt, ui) {
			$('#__cve_cliente').val(ui.item.cve_cliente);
		}
	});
	// Cargamos los catálogos de la vista
	$articulos = ajax('../Articulos/obtenerArticulos', null);
	$.each($articulos, function (i, item) {
		$('#cve_articulo').append("<option value='" + item.cve_articulo + "'>" + item.articulo + "</option>");
	});
	$('.selectpicker').selectpicker('refresh');
	// Obtenemos el precio del articulo seleccionado
	$('#cve_articulo').change(function () {
		$articulo = ajax('../Articulos/obtenerArticulo', { cve_articulo: $('#cve_articulo').val() });
		$('#precio_venta').val($articulo.precio_venta).closest('div').removeClass('is-empty');
	});

	// Configuracion de la tabla de ventas
	$('#tVentas').bootstrapTable({
		data: [],
		clickToSelect: true,
		pagination: false,
		columns: [
			{ field: 'cve_venta', title: 'Folio', align: 'center' },
			{ field: 'cve_cliente', visible: false },
			{ field: 'cve_articulo', visible: false },
			{ field: 'importe_abono', visible: false },
			{ field: 'estatus', visible: false },
			{ field: 'cliente', title: 'Cliente', align: 'left' },
			{
				field: 'articulo', title: 'Artículo', align: 'left', formatter: function (value, row, index) {
					if (row.cve_articulo == 1) {
						value = "<font style='color: #EB5E28'>" + value + "<font>";
					}
					return value
				}
			},
			{ field: 'fecha_venta', title: 'Venta', align: 'center' },
			{ field: 'fecha_ultimo_pago', title: 'Último pago', align: 'center' },
			{
				field: 'precio_venta', title: 'Precio de venta', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			},
			{
				field: 'saldo', title: 'Saldo', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			}
		],
		onClickRow: function (row, $element, field) {
			$itemVenta = row.cve_venta;
		}
	});

	// Configuracion de la tabla de pagos
	$('#tPagos').bootstrapTable({
		data: [],
		clickToSelect: true,
		pagination: false,
		columns: [
			{ field: 'cve_pago', title: 'Folio', align: 'center' },
			{ field: 'cve_cliente', visible: false },
			{ field: 'estatus', visible: false },
			{ field: 'es_nota_de_credito', visible: false },
			{ field: 'cliente', title: 'Cliente', align: 'left' },
			{ field: 'fecha', title: 'Fecha', align: 'center' },
			{
				field: 'aplicaciones', title: 'Aplicaciones', align: 'left', formatter: function (value, row, index) {
					value = value.join(', ');
					if (row.es_nota_de_credito == 1) {
						value = "<font style='color: #EB5E28'>NC " + value + "<font>";
					}
					return value
				}
			},
			{
				field: 'importe', title: 'Importe', align: 'right', formatter: function (value, row, index) {
					return formato_numero(value, 2, '.', ',');
				}
			}
		],
		onClickRow: function (row, $element, field) {
			$itemPago = row.cve_pago;
		}
	});

	// Limpiar el formulario de ventas
	$('#mVentas').on('hidden.bs.modal', function (e) {
		$('#fVentas input').val('');
		$('#cve_articulo').selectpicker('val', '');
	}).on('shown.bs.modal', function (e) {
		if (typeof $.cookie('cve_cliente') != 'undefined') {
			$('#cve_cliente').val($.cookie('cve_cliente'));
		} else {
			$('#cliente').focus();
		}
	});

	// Limpiar el formulario de pagos
	$('#mPagos').on('hidden.bs.modal', function (e) {
		$('#fPagos input, textarea').val('');
		$('#es_nota_de_credito').prop('checked', false);
	}).on('shown.bs.modal', function (e) {
		if (typeof $.cookie('cve_cliente') != 'undefined') {
			$('#_cve_cliente').val($.cookie('cve_cliente'));
		} else {
			$('#_cliente').focus();
		}
	});

	// Limpiar el formulario de filtros
	$('#mFiltros').on('shown.bs.modal', function (e) {
		if (typeof $.cookie('cve_cliente') != 'undefined') {
			$('#__cve_cliente').val($.cookie('cve_cliente'));
		} else {
			$('#__cliente').focus();
		}
	});

	// Ejecucion del formulario de ventas
	$('#fVentas').submit(function (e) {
		e.preventDefault();
		crudVentas();
	});

	// Ejecucion del formulario de pagos
	$('#fPagos').submit(function (e) {
		e.preventDefault();
		crudPagos();
	});

	// Ejecucion del formulario de filtros
	$('#fFiltros').submit(function (e) {
		e.preventDefault();
		renderReporte();
		$('#mFiltros').modal('hide');
	});

});

// Codigo al cerrar la pestaña
$(window).on('unload', function () {
	$.removeCookie('cve_cliente', { path: '/' });
	$.removeCookie('cliente', { path: '/' });
});

// Funcion para obtener las ventas
function obtenerVentas() {
	str = $('#fFiltros').serialize();
	return ajax('obtenerVentas', str);
}

// Funcion para obtener los pagos
function obtenerPagos() {
	str = $('#fFiltros').serialize();
	return ajax('obtenerPagos', str);
}

// Funcion para dar de alta una nueva venta
function crudVentas() {
	str = $('#fVentas').serialize();
	$.ajax({
		url: 'crudVentas',
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
				renderReporte();
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
		url: 'crudPagos',
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
				renderReporte();
				$('#mPagos').modal('hide');
				swal.close();
			}
		}
	});
}

// Funcion para renderizar los reportes y los totales de las ventas
function renderReporte() {
	$tventas = $tpagos = $tnc = $tncr = 0;
	$ventas = obtenerVentas();
	$pagos = obtenerPagos();
	$('#tVentas').bootstrapTable('load', $ventas);
	$('#tPagos').bootstrapTable('load', $pagos);
	$.each($ventas, function (i, item) {
		if (item.cve_articulo == 1) {
			$tnc = parseFloat($tnc) + parseFloat(item.precio_venta);
		} else {
			$tventas = parseFloat($tventas) + parseFloat(item.precio_venta);
		}
	});
	$.each($pagos, function (i, item) {
		if (item.es_nota_de_credito == 1) {
			$tncr = parseFloat($tncr) + parseFloat(item.importe);
		} else {
			$tpagos = parseFloat($tpagos) + parseFloat(item.importe);
		}
	});
	$r = $tventas + $tnc - $tpagos - $tncr;
	$('#tv').html('$' + formato_numero($tventas, 2, '.', ','));
	$('#tp').html('$' + formato_numero($tpagos, 2, '.', ','));
	$('#tnc').html('$' + formato_numero($tnc, 2, '.', ','));
	$('#tncr').html('$' + formato_numero($tncr, 2, '.', ','));
	$('#r').html('$' + formato_numero($r, 2, '.', ','));
}