$(document).ready(function () {
	// Configuracion de la tabla de articulos
	$('#tArticulos').bootstrapTable({
		data: obtenerArticulos(),
		toolbar: '#toolbar',
		clickToSelect: true,
		pagination: true,
		pageSize: 10,
		pageList: [10, 25, 50],
		columns: [
			{ field: 'cve_articulo', visible: false },
			{ field: 'estatus', visible: false },
			{ field: 'articulo', title: 'Artículo', align: 'left', sortable: true },
			{ field: 'resenia', title: 'Reseña', align: 'left' },
			{
				title: '', align: 'center', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-warning btn-xs editar' title='Editar información'>Editar</button>";
				}
			}
		],
		onClickRow: function (row, $element, field) {
			$('#cve_articulo').val(row.cve_articulo);
			$('#articulo').val(row.articulo);
			$('#resenia').val(row.resenia);
			$('#estatus').selectpicker('val', row.estatus);
		}
	});

	// Clic en el boton editar de la tabla de articulos
	$('#tArticulos tbody').on('click', 'button.editar', function () {
		$('#fArticulos input, textarea').closest('div').removeClass('is-empty');
		$('#mArticulos').modal('show');
	});

	// Limpiar el formulario de articulos
	$('#mArticulos').on('hidden.bs.modal', function (e) {
		$('#cve_articulo, #articulo, #resenia').val('');
		$('#fArticulo input, textarea').closest('div').addClass('is-empty');
	}).on('shown.bs.modal', function (e) {
		$('#articulo').focus();
	});

	// Ejecucion del formulario de articulos
	$('#fArticulos').submit(function (e) {
		e.preventDefault();
		crudArticulos();
	});

});

// Funcion para obtener el catalogo de articulos
function obtenerArticulos() {
	return ajax('obtenerArticulos', null);
}

// Funcion para editar o dar de alta un articulo
function crudArticulos() {
	str = $('#fArticulos').serialize();
	$.ajax({
		url: 'crudArticulos',
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
				$('#tArticulos').bootstrapTable('load', obtenerArticulos());
				$('#mArticulos').modal('hide');
				swal.close();
			}
		}
	});
}

