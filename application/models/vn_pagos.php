<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class vn_pagos extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_pagos';
		$this->primary_key = 'cve_pago';
	}

}