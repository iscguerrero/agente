<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_cat_clientes extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_cat_clientes';
		$this->primary_key = 'cve_cliente';
	}
	public function _filter($cve_ruta) {
		$this->db->select("cve_cliente, periodicidad, idsepomex, vcc.cve_ruta, ruta, nombre, apellidos, anotaciones, telefono, vcc.estatus, idEstado, estado, idMunicipio, municipio, ciudad, zona, cp, asentamiento, direccion, tipo")
		->from('vn_cat_clientes vcc')
		->join('sepomex smex', 'vcc.idsepomex = smex.id', 'INNER')
		->join('vn_cat_rutas vcr', 'vcc.cve_ruta = vcr.cve_ruta', 'INNER')
		->where('vcc.estatus', 'A');
		if($cve_ruta != '') $this->db->where('vcc.cve_ruta', $cve_ruta);
		$query = $this->db->get();
		return $query->result();
	}
	public function autocomplete($term) {
		$this->db->select("cve_cliente, concat(nombre, ' ', apellidos) as value")
		->from($this->table)
		->where('estatus', 'A')
		->like("concat(nombre, ' ', apellidos)", $term);
		$query = $this->db->get();
		return $query->result();
	}
}