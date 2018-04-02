<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Rutas extends Base_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('vn_cat_rutas');
	}
	public function Inicio() {
		echo $this->templates->render('Rutas/inicio');
	}
	public function obtenerRutas() {
		$where = array("estatus" => 'A');
		$fields = "cve_ruta, ruta, resenia, estatus";
		echo json_encode($this->vn_cat_rutas->filter($where, $fields));
	}
	public function crudRutas() {
		$data = array(
			'ruta' => $this->input->post('ruta'),
			'resenia' => $this->input->post('resenia'),
			'estatus' => $this->input->post('estatus')
		);
		if($this->input->post('cve_ruta') != '') $data['cve_ruta'] = $this->input->post('cve_ruta');

		$this->vn_cat_rutas->save($data) ? exit(json_encode(array('bandera'=>true, 'msj'=>'Petición procesada con éxito'))) : exit(json_encode(array('bandera'=>false, 'msj'=>'Se presento un error al procesar la solicitud')));
	}

}
