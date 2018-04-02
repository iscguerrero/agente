<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class gl_cat_perfiles extends Base_Model {
	public function __construct() {
		parent::__construct();
		$this->table = 'gl_cat_perfiles';
		$this->primary_key = 'cve_perfil';
	}

}