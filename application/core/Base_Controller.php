<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Base_Controller extends CI_Controller {
	public $templates, $created_user, $updated_user;
	public function __construct(){
		parent::__construct();
			$this->load->database();
			$this->load->helper(array('url','form', 'date', 'cookie'));
			$this->load->library(array('form_validation', 'session', 'encrypt'));
		# Configuracion inicial del motor de plantillas Plates
			$this->templates = new League\Plates\Engine(APPPATH . '/views');
			$this->templates->addFolder('partials', APPPATH . '/views/partials');
		# Comprobamos que exista una sesion de usuario creada
			if($this->session->userdata('logueado') == false) redirect(base_url());
			$cookie = array(
				'name' => 'cve_perfil',
				'value' => $this->session->userdata('cve_perfil'),
				'domain' => 'localhost',
				'path' => '/',
			);
			set_cookie('cve_perfil', $this->session->userdata('cve_perfil'), time() + (10 * 365 * 24 * 60 * 60));
		# Seteamos la clave de usuario en variables globales
			$this->created_user = $this->session->userdata() ? $this->session->userdata('cve_usuario') : null;
			$this->updated_user = $this->session->userdata() ? $this->session->userdata('cve_usuario') : null;
	}#asdasdasd

	# Funcion para formatear la fecha a formato Y-m-d
	function str_to_date($string){
		$meses = array("Enero" => "01", "Febrero" => "02", "Marzo" => "03", "Abril" => "04", "Mayo" => "05", "Junio" => "06", "Julio" => "07", "Agosto" => "08", "Septiembre" => "09", "Octubre" => "10", "Noviembre" => "11", "Diciembre" => "12");
		if(!isset($string)) exit(json_encode(array('flag'=>false, 'msj'=>'UNA O VARIAS DE LAS FECHAS NO FUE PROPORCIONADA CORRECTAMENTE')));
		if($string == null) exit(json_encode(array('flag'=>false, 'msj'=>'UNA O VARIAS DE LAS FECHAS ES NULA')));
		if($string == '') exit(json_encode(array('flag'=>false, 'msj'=>'UNA O VARIAS DE LAS FECHAS ES NULA')));
		isset($string)?$fecha=explode("-", $string):exit(array('flag'=>false, 'msj'=>'UNA DE LAS FECHAS NO SE PROPORCIONO CORRECTAMENTE'));
		$date = $fecha[2] . '-' . $meses[$fecha[1]] . '-' . $fecha[0];
		return $date;
	}

}
