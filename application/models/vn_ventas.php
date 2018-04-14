<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class vn_ventas extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_ventas';
		$this->primary_key = 'cve_venta';
	}

	public function _filter($fi, $ff, $cve_cliente, $saldadas = null) {
		$this->db->select("LPAD(vv.cve_venta * 1, 5, '0') as cve_venta, vv.importe_abono, concat(vcc.nombre, ' ', vcc.apellidos) as cliente, vv.cve_cliente, vv.cve_articulo, vv.estatus, vca.articulo, date_format(vv.fecha_venta, '%d-%M-%Y') as fecha_venta, date_format(vv.fecha_ultimo_pago, '%d-%M-%Y') as fecha_ultimo_pago, date_format(fecha_proximo_pago, '%d-%M-%Y') as fecha_proximo_pago, vv.precio_venta, saldo")
		->from('vn_ventas vv')
		->join('vn_cat_clientes vcc', 'vv.cve_cliente = vcc.cve_cliente', 'INNER')
		->join('vn_cat_articulos vca', 'vv.cve_articulo = vca.cve_articulo', 'INNER')
		->where('vv.estatus !=', 'X');
		if($saldadas != null ) $this->db->where('vv.saldo >', 0);
		if($fi != '') $this->db->where('vv.fecha_venta >=', $fi);
		if($ff != '') $this->db->where('vv.fecha_venta <=', $ff . ' 23:59:59');
		if($cve_cliente != '') $this->db->where('vv.cve_cliente', $cve_cliente);
		$this->db->order_by('cve_venta');
		$query = $this->db->get();
		return $query->result();
	}

}