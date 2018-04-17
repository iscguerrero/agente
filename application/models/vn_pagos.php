<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_pagos extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_pagos';
		$this->primary_key = 'cve_pago';
	}

	public function _filter($fi, $ff, $cve_cliente, $cve_ruta) {
		$this->db->select("LPAD(vp.cve_pago * 1, 5, '0') as cve_pago, concat(vcc.nombre, ' ', vcc.apellidos) as cliente, vp.cve_cliente, vp.estatus, date_format(vp.fecha, '%d-%M-%Y') as fecha, vp.importe, vp.es_nota_de_credito, vcr.ruta")
		->from('vn_pagos vp')
		->join('vn_cat_clientes vcc', 'vp.cve_cliente = vcc.cve_cliente', 'INNER')
		->join('vn_cat_rutas vcr', 'vcc.cve_ruta = vcr.cve_ruta', 'INNER')
		->where('vp.estatus !=', 'X')
		->where('vp.fecha >=', $fi)
		->where('vp.fecha <=', $ff . ' 23:59:59');
		if($cve_cliente != '') $this->db->where('vp.cve_cliente', $cve_cliente);
		if($cve_ruta != '') $this->db->where('vcc.cve_ruta', $cve_ruta);
		$this->db->order_by('cve_pago');
		$query = $this->db->get();
		return $query->result();
	}

	public function ultimo_pago($cve_cliente) {
		$this->db->select("importe, fecha as rfecha, date_format(fecha, '%d-%m-%y') as fecha")
		->from('vn_pagos')
		->where('cve_cliente', $cve_cliente)
		->order_by('cve_pago', 'desc');
		return $this->db->get()->row();
	}

}