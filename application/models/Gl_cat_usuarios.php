<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class gl_cat_usuarios extends Base_Model{
	public function __construct() {
		parent::__construct();
		$this->table = 'gl_cat_usuarios';
		$this->primary_key = 'cve_usuario';
	}

	# Resolver el acceso del usuario
	public function resolver($data) {
		$this->db->select('contrasenia')
			->from($this->table)
			->where('cve_usuario', $data['cve_usuario'])
			->where('estatus', 'A');
		$hash = $this->db->get()->row('contrasenia');
		return $this->verify_password_hash($data['contrasenia'], $hash);
	}

	# Crear un nuevo registro en la tabla
	public function alta($data) {
		$data['contrasenia'] = $this->hash_password($data['contrasenia']);
		return $this->db->insert($this->table, $data);
	}

	# Funcion para setear la contraseña del usuario a un hash
	private function hash_password($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}

	# Funcion para desencriptar una contraseña
	private function verify_password_hash($contrasenia, $hash) {
		return password_verify($contrasenia, $hash);
	}

}