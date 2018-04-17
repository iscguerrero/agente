<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cobranza extends Base_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('vn_ventas');
		$this->load->model('vn_pagos');
		$this->load->model('vn_aplicacion_pago');
	}
	public function Inicio() {
		echo $this->templates->render('Cobranza/inicio');
	}

	public function obtenerVentas() {
		$fi = $this->str_to_date($this->input->post('fi'));
		$ff = $this->str_to_date($this->input->post('ff'));
		$cve_ruta = $this->input->post('cve_ruta');
		$cve_cliente = $this->input->post('__cve_cliente');

		echo json_encode($this->vn_ventas->_filter($fi, $ff, $cve_cliente, null, $cve_ruta));
	}

	public function wobtenerVentas() {
		if($this->input->post('fi') != '') {
			$fi = $this->str_to_date($this->input->post('fi'));
			$ff = $this->str_to_date($this->input->post('ff'));
			$cve_ruta = $this->input->post('cve_ruta');
			$cve_cliente = $this->input->post('__cve_cliente');
			echo json_encode($this->vn_ventas->wfilter($fi, $ff, $cve_cliente, $cve_ruta));
		} else {
			echo json_encode(array());
		}
	}

	public function obtenerPagos() {
		$fi = $this->str_to_date($this->input->post('fi'));
		$ff = $this->str_to_date($this->input->post('ff'));
		$cve_ruta = $this->input->post('cve_ruta');
		$cve_cliente = $this->input->post('__cve_cliente');

		$pagos = $this->vn_pagos->_filter($fi, $ff, $cve_cliente, $cve_ruta);
		foreach ($pagos as $pago) {
			$_aplicaciones = array();
			$where = array('cve_pago' => $pago->cve_pago);
			$fields = "LPAD(cve_venta * 1, 5, '0') as cve_venta";
			$aplicaciones = $this->vn_aplicacion_pago->filter($where, $fields);
			foreach($aplicaciones as $aplicacion) {
				array_push($_aplicaciones, $aplicacion->cve_venta);
			}
			$pago->aplicaciones = $_aplicaciones;
		}

		echo json_encode($pagos);
	}

	public function crudVentas() {
		$cve_cliente = null !== $this->input->post('cve_cliente') ? $this->input->post('cve_cliente') : $this->input->post('_cve_cliente');
		$cve_articulo = $this->input->post('cve_articulo');
		$precio_venta = $this->input->post('precio_venta');
		$importe_abono = $this->input->post('importe_abono');

		$data = array(
			'cve_cliente' => $cve_cliente,
			'cve_articulo' => $cve_articulo,
			'cve_usuario' => $this->created_user,
			'precio_venta' => $precio_venta,
			'saldo' => $precio_venta,
			'importe_abono' => $importe_abono,
			'fecha_venta' => date('Y-m-d'),
			'fecha_ultimo_pago' => '0000-00:00',
			'fecha_proximo_pago' => '0000-00:00',
			'estatus' => 'A',
		);

		$this->vn_ventas->save($data) === false ? exit(json_encode(array('bandera'=>false, 'msj'=>'Se presento un error al procesar la petición'))) : exit(json_encode(array('bandera'=>true, 'msj'=>'Petición procesada con éxito')));
	}

	public function crudPagos() {
		$cve_cliente = null !== $this->input->post('_cve_cliente') ? $this->input->post('_cve_cliente') : $this->input->post('__cve_cliente');
		$importe = $this->input->post('importe');
		$anotaciones = $this->input->post('anotaciones');
		$es_nota_de_credito = null !== $this->input->post('es_nota_de_credito') ? '1' : '0';
		# Obtenemos el saldo del cliente
		$campos = "SUM(saldo) as saldo";
		$where = array('estatus !=' => 'X', 'cve_cliente' => $cve_cliente);
		$saldo = $this->vn_ventas->get($where, $campos);
		# Comprobamos que el cliente tenga saldo de alguna venta, caso contrario no se acepta el pago
		if($saldo->saldo == 0)
			exit(json_encode(array('bandera'=>false, 'msj'=>'El cliente seleccionado no tiene adedudo por saldar')));
		if($saldo->saldo < $importe)
			exit(json_encode(array('bandera'=>false, 'msj'=>'El adeudo del cliente ' . number_format($saldo->saldo, 2) . ' es menor al importe del pago ingresado')));

		# Iniciamos la transaccion
		$this->db->trans_begin();

		# Insertamos el pago
		$data = array(
			'cve_cliente' => $cve_cliente,
			'importe' => $importe,
			'cve_usuario' => $this->created_user,
			'anotaciones' => $anotaciones,
			'estatus' => 'A',
			'es_nota_de_credito' => $es_nota_de_credito,
			'fecha' => date('Y-m-d')
		);
		$cve_pago = $this->vn_pagos->save($data);

		# Obtenemos las ventas con saldo del cliente
		$campos = "cve_venta, saldo";
		$where = array('estatus !=' => 'X', 'cve_cliente' => $cve_cliente, 'saldo >' => 0);
		$ventas = $this->vn_ventas->filter($where, $campos);

		# Recorremos las ventas del cliente, saldando en orden sus compras
		foreach($ventas as $venta) {
			while($importe > 0 && $venta->saldo > 0) {
				if($venta->saldo > $importe) {
					$data = array(
						'cve_pago' => $cve_pago,
						'cve_venta' => $venta->cve_venta,
						'importe' => $importe,
						'estatus' => 'A'
					);
					$this->vn_aplicacion_pago->save($data);
					$data = array(
						'cve_venta' => $venta->cve_venta,
						'saldo' => $venta->saldo - $importe,
						'fecha_ultimo_pago' => date('Y-m-d H:i:s'),
					);
					$this->vn_ventas->save($data);
					$importe = 0;
					$venta->saldo = $venta->saldo - $importe;
				} else if($venta->saldo == $importe) {
					$data = array(
						'cve_pago' => $cve_pago,
						'cve_venta' => $venta->cve_venta,
						'importe' => $importe,
						'estatus' => 'A'
					);
					$this->vn_aplicacion_pago->save($data);
					$data = array(
						'cve_venta' => $venta->cve_venta,
						'saldo' => 0,
						'fecha_ultimo_pago' => date('Y-m-d H:i:s'),
					);
					$this->vn_ventas->save($data);
					$importe = 0;
					$venta->saldo = 0;
				} else if($venta->saldo < $importe) {
					$data = array(
						'cve_pago' => $cve_pago,
						'cve_venta' => $venta->cve_venta,
						'importe' => $venta->saldo,
						'estatus' => 'A'
					);
					$this->vn_aplicacion_pago->save($data);
					$data = array(
						'cve_venta' => $venta->cve_venta,
						'saldo' => 0,
						'fecha_ultimo_pago' => date('Y-m-d H:i:s'),
					);
					$this->vn_ventas->save($data);
					$importe = $importe - $venta->saldo;
					$venta->saldo = 0;
				}
			}
		}

		# Finalizamos la transaccion
		if ($this->db->trans_status() == false) {
			$this->db->trans_rollback();
			exit(json_encode(array('bandera' => false, 'msj' => 'Se presento un error al procesar la petición')));
		} else {
			$this->db->trans_commit();
			exit(json_encode(array('bandera' => true, 'msj' => 'Petición procesada con éxito')));
		}


	}
}
