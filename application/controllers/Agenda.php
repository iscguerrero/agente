<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Agenda extends Base_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('vn_agenda');
	}
	public function Inicio() {
		echo $this->templates->render('Agenda/inicio');
	}
	public function Eventos() {
		$agenda = $this->vn_agenda->_filter();
		foreach($agenda as $dia) {
			$anombre = explode(' ', $dia->nombre);
			$aapellidos = explode(' ', $dia->apellidos);
			$dia->title = $anombre[0] . ' ' . $aapellidos[0];
			$dia->allDay = true;
		}
		echo json_encode($agenda);
	}
	public function actualizarAgenda() {
		$this->vn_agenda->actualizarAgenda();
		echo json_encode(array('bandera'=>true, 'msj'=>'Petición procesada con éxito'));
	}
}
