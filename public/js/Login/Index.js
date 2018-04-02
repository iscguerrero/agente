$(document).ready(function () {
	$page = $('.full-page');
	image_src = $page.data('image');
	if (image_src !== undefined) {
		image_container = '<div class="full-page-background" style="background-image: url(' + image_src + ') "/>'
		$page.append(image_container);
	}
	setTimeout(function () {
		$('.card').removeClass('card-hidden');
	}, 700);
	// Se envia el formulario para loguear al usuario en el sistema
	$('#formAcceder').submit(function (e) {
		e.preventDefault();
		str = $('#formAcceder').serialize();
		$.ajax({
			url: 'Login/Acceder',
			data: str,
			type: 'POST',
			async: true,
			cache: false,
			dataType: 'json',
			success: function (json) {
				if (json.bandera == true) {
					window.location.replace(json.default_controller);
				} else {
					swal({
						title: "Atiende!",
						html: json.msj,
						buttonsStyling: true,
						confirmButtonClass: "btn btn-warning btn-fill"
					});
				}
			}
		});
	});
});