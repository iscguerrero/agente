<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class vn_ventas extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_ventas';
		$this->primary_key = 'cve_venta';
	}

}