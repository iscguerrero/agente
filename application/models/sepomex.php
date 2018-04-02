<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class sepomex extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'sepomex';
		$this->primary_key = 'id';
	}

	# Catálolgo de estados
	public function estados() {
		$this->db->select('idEstado, estado')
		->from($this->table)
		->group_by('idEstado');
		$query = $this->db->get();
		return $query->result();
	}

	# Catálolgo de municipios
	public function municipios($idEstado) {
		$this->db->select('idMunicipio, municipio')
		->from($this->table)
		->where('idEstado', $idEstado)
		->group_by('idMunicipio');
		$query = $this->db->get();
		return $query->result();
	}

	# Catálolgo de asentamientos
	public function asentamientos($idEstado, $idMunicipio, $asentamiento) {
		$this->db->select('id, asentamiento as value, cp, tipo, zona, ciudad')
		->from($this->table)
		->where('idEstado', $idEstado)
		->where('idMunicipio', $idMunicipio)
		->like('asentamiento', $asentamiento);
		$query = $this->db->get();
		return $query->result();
	}

}