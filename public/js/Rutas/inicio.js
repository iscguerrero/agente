$(document).ready(function () {
	// Configuracion de la tabla de rutas
	$('#tRutas').bootstrapTable({
		data: obtenerRutas(),
		toolbar: '#toolbar',
		clickToSelect: true,
		pagination: true,
		pageSize: 10,
		pageList: [10, 25, 50],
		columns: [
			{ field: 'cve_ruta', visible: false },
			{ field: 'estatus', visible: false },
			{ field: 'ruta', title: 'Ruta', align: 'left', sortable: true },
			{ field: 'resenia', title: 'Reseña', align: 'left' },
			{
				title: '', align: 'center', formatter: function (value, row, index) {
					return "<button type='button' class='btn btn-warning btn-xs editar' title='Editar información'><i class='fa fa-edit'></i> Editar</button>";
				}
			}
		],
		onClickRow: function (row, $element, field) {
			$('#cve_ruta').val(row.cve_ruta);
			$('#ruta').val(row.ruta);
			$('#resenia').val(row.resenia);
			$('#estatus').selectpicker('val', row.estatus);
		}
	});

	// Clic en el boton editar de la tabla de rutas
	$('#tRutas tbody').on('click', 'button.editar', function () {
		$('#mRutas').modal('show');
	});

	// Limpiar el formulario de rutas
	$('#mRutas').on('hidden.bs.modal', function (e) {
		$('#fRutas input').val('');
	}).on('shown.bs.modal', function (e) {
		$('#ruta').focus();
	});

	// Ejecucion del formulario de ruta
	$('#fRutas').submit(function (e) {
		e.preventDefault();
		crudRutas();
	});

});

// Funcion para obtener el catalogo de rutas
function obtenerRutas() {
	return ajax('obtenerRutas', null);
}

// Funcion para editar o dar de alta una ruta
function crudRutas() {
	str = $('#fRutas').serialize();
	$.ajax({
		url: 'crudRutas',
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
				$('#tRutas').bootstrapTable('load', ajax('obtenerRutas', null));
				$('#mRutas').modal('hide');
				swal.close();
			}
		}
	});
}

