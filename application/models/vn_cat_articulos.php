<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class vn_cat_articulos extends Base_Model {
	public function  __construct() {
		parent::__construct();
		$this->table = 'vn_cat_articulos';
		$this->primary_key = 'cve_articulo';
	}

}