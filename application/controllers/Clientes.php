<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clientes extends Base_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('vn_cat_clientes');
	}
	public function Inicio() {
		echo $this->templates->render('Clientes/inicio');
	}
	public function obtenerClientes() {
		$cve_ruta = $this->input->post('cve_ruta');
		$clientes = $this->vn_cat_clientes->_filter($cve_ruta);
		foreach ($clientes as $key => $cliente) {
			$cliente->articulos = array('uno', 'dos');
			$cliente->fecha_ultimo_abono = '10-Marzo-2016';
			$cliente->importe_ultimo_abono = '120';
		}
		echo json_encode($clientes);
	}
	public function crudClientes() {
		$data = array(
			'idsepomex' => $this->input->post('idsepomex'),
			'cve_ruta' => $this->input->post('cve_ruta'),
			'nombre' => $this->input->post('nombre'),
			'apellidos' => $this->input->post('apellidos'),
			'anotaciones' => $this->input->post('anotaciones'),
			'telefono' => $this->input->post('telefono'),
			'direccion' => $this->input->post('direccion'),
			'estatus' => $this->input->post('estatus'),
			'periodicidad' => $this->input->post('periodicidad'),
		);
		if($this->input->post('cve_cliente') != '') $data['cve_cliente'] = $this->input->post('cve_cliente');

		$this->vn_cat_clientes->save($data) ? exit(json_encode(array('bandera'=>true, 'msj'=>'Petición procesada con éxito'))) : exit(json_encode(array('bandera'=>false, 'msj'=>'Se presento un error al procesar la solicitud')));
	}
	public function autocomplete() {
		$term = $this->input->get('term');
		echo json_encode($this->vn_cat_clientes->autocomplete($term));
	}

}
