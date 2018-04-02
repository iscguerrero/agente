<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class vn_aplicacion_pago extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_aplicacion_pago';
		$this->primary_key = 'cve_aplicacion';
	}

}