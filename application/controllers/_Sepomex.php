<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class _Sepomex extends Base_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('sepomex');
	}
	public function estados() {
		echo json_encode($this->sepomex->estados());
	}
	public function municipios() {
		$idEstado = $this->input->post('idEstado');
		echo json_encode($this->sepomex->municipios($idEstado));
	}
	public function asentamientos() {
		$idEstado = $this->input->get('idEstado');
		$idMunicipio = $this->input->get('idMunicipio');
		$asentamiento = $this->input->get('term');
		echo json_encode($this->sepomex->asentamientos($idEstado, $idMunicipio, $asentamiento));
	}

}
