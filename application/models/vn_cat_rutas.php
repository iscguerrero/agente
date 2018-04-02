<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_cat_rutas extends Base_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'vn_cat_rutas';
		$this->primary_key = 'cve_ruta';
	}

}