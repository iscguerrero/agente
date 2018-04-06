<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_agenda extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_agenda';
		$this->primary_key = 'id';
	}
	public function _filter() {
		$this->db->select("va.fecha as start, va.fecha as end, vcc.nombre, vcc.apellidos")
		->from('vn_agenda va')
		->join('vn_cat_clientes vcc', 'va.cve_cliente = vcc.cve_cliente', 'INNER')
		->where('va.estatus', 'A');
		$query = $this->db->get();
		return $query->result();
	}
	public function actualizarAgenda() {
		$this->db->query("CALL calculaAgenda()");
	}
}