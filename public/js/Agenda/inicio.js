$(document).ready(function () {
	$calendar = $('#fullCalendar');

	today = new Date();
	y = today.getFullYear();
	m = today.getMonth();
	d = today.getDate();

	$calendar.fullCalendar({
		locale: 'es',
		header: {
			left: 'title',
			center: '',
			right: 'prev,next,today'
		},
		defaultDate: today,
		buttonText: {
			today: 'Hoy'
		},
		selectable: true,
		views: {
			month: {
				titleFormat: 'MMMM YYYY'
			}
		},
		editable: false,
		eventLimit: true,
		// color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
		events: obtenerAgenda()
	});

	// Actualizar la agenda
	$('#actualizar').click(function () {
		actualizarAgenda();
	});

});

// Funcion para actualizar la agenda
function actualizarAgenda() {
	$.ajax({
		url: 'actualizarAgenda',
		type: 'POST',
		async: true,
		cache: false,
		dataType: 'json',
		beforeSend: function () {
			swal({
				html: '<h3>Espera un momento por favor...</h3>',
				showConfirmButton: false,
				type: 'info'
			});
		},
		success: function (data) {
			$.notify({
				message: data.msj
			}, {
				type: 'success'
			});
			swal.close();
			$calendar.fullCalendar('removeEvents');
			$calendar.fullCalendar('addEventSource', obtenerAgenda());
			$calendar.fullCalendar('refetchEvents');
		}
	});
}

function obtenerAgenda(){
	return ajax('Eventos', null);
}