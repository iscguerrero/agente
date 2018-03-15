<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Cobraza extends Base_Controller {
	function __construct(){
		parent::__construct();
	}
	public function Inicio() {
		echo $this->templates->render('Cobranza/Inicio');
	}

}
