<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Articulos extends Base_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('vn_cat_articulos');
	}
	public function Inicio() {
		echo $this->templates->render('Articulos/inicio');
	}
	public function obtenerArticulos() {
		$where = array("estatus" => 'A');
		$fields = "cve_articulo, articulo, resenia, estatus";
		echo json_encode($this->vn_cat_articulos->filter($where, $fields));
	}
	public function crudArticulos() {
		$data = array(
			'articulo' => $this->input->post('articulo'),
			'resenia' => $this->input->post('resenia'),
			'estatus' => $this->input->post('estatus')
		);
		if($this->input->post('cve_articulo') != '') $data['cve_articulo'] = $this->input->post('cve_articulo');

		$this->vn_cat_articulos->save($data) ? exit(json_encode(array('bandera'=>true, 'msj'=>'Petición procesada con éxito'))) : exit(json_encode(array('bandera'=>false, 'msj'=>'Se presento un error al procesar la solicitud')));
	}

}
