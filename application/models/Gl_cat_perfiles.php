<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gl_cat_perfiles extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'gl_cat_pefiles';
		$this->primary_key = 'cve_perfil';
	}

	# Obtener un solo registros de la tabla que coincida con las condiciones seleccionadas
	public function obtener($where, $campos) {
		return $this->get($where, $campos);
	}

	# Lista los registros de la tabla que coincidan con las condiciones proporcionadas
	public function listar($wheres, $campos) {
		return $this->filter($wheres, $campos);
	}

	# Nuevo registro para la tabla
	public function alta($data) {
		return $this->save($data);
	}

}