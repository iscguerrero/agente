<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Clientes extends Base_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('vn_cat_clientes');
		$this->load->model('vn_ventas');
		$this->load->model('vn_pagos');
	}
	public function Inicio() {
		echo $this->templates->render('Clientes/inicio');
	}
	public function obtenerClientes() {
		$cve_ruta = $this->input->post('cve_ruta');
		$clientes = $this->vn_cat_clientes->_filter($cve_ruta);
		foreach ($clientes as $cliente) {
			# Obtenemos los articulos con saldo del cliente
			$articulos = array();
			$saldo = $precio_venta = $importe_abono = $dias = 0;
			$cliente->clase = '';
			$ventas = $this->vn_ventas->_filter('', '', $cliente->cve_cliente, 'all');
			if(count($ventas) > 0) {
				foreach ($ventas as $venta) {
					array_push($articulos, $venta->articulo);
					$saldo += $venta->saldo;
					$precio_venta += $venta->precio_venta;
					$importe_abono += $venta->importe_abono;
				}
			}
			$cliente->articulos = $articulos;
			# Obtenemos la información del último abono del cliente
			$pago = $this->vn_pagos->ultimo_pago($cliente->cve_cliente);
			$cliente->fecha_ultimo_abono = isset($pago->fecha) ? $pago->fecha : '';
			$cliente->importe_ultimo_abono = isset($pago->importe) ? $pago->importe : '';
			$cliente->saldo = $saldo;
			$cliente->venta = $precio_venta;
			$cliente->importe_abono = $importe_abono;
			# Obtenemos el numero de días transcurridos entre el ultimo pago y la fecha actual
			if(isset($pago->rfecha)) {
				$dias	= (strtotime(date('Y-m-d')) - strtotime($pago->rfecha))/86400;
				$dias = floor($dias);
				if($dias <= 15) $cliente->clase = 'success';
				if($dias > 15 && $dias < 20) $cliente->clase = 'warning';
				else if($dias > 21) $cliente->clase = 'danger';
				$cliente->dias = $dias;
			}
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
