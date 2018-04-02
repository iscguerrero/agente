<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('url','form', 'cookie'));
		$this->load->library(array('form_validation', 'session', 'encrypt'));
		$this->load->model('gl_cat_usuarios');
		$this->load->model('gl_cat_perfiles');
	}

	# Metodo para retornar la vista del login del sistema
	public function Inicio(){
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			$where = array('cve_perfil' => $this->session->userdata('cve_perfil'));
			$perfil = $this->gl_cat_perfiles->get($where, 'default_controller');
			redirect(base_url($perfil->default_controller));
		} else{
			$this->load->view('Login/Inicio');
		}
	}

	# Metodo para loguear el usuario dentro del sistema
	public function Acceder() {
		if(!$this->input->is_ajax_request()) show_404();
		# Validamos la cambinacion de usuario y contraseña de inicio de sesion
		$this->form_validation->set_rules('cve_usuario', 'Usuario', 'required', array('required'=>'Proporciona usuario de acceso'));
		$this->form_validation->set_rules('contrasenia', 'Contraseña', 'required', array('required'=>'Proporciona la contraseña del usuario'));
		if ($this->form_validation->run() == false) exit(json_encode(array('bandera'=>false, 'msj'=>'Las validaciones del formulario no se completaron, atiende:<br>' . validation_errors())));
		# Resolvemos el acceso al sistema
		$data = array(
			'cve_usuario' => $this->input->post('cve_usuario'),
			'contrasenia' => $this->input->post('contrasenia')
		);
		if($this->gl_cat_usuarios->resolver($data) == false) exit(json_encode(array('bandera' => false, 'msj' => 'Combinación de usuario y contraseña no válida')));

		# Seteamos las variables de sesion
		$where = array('cve_usuario' => $this->input->post('cve_usuario'));
		$usuario = $this->gl_cat_usuarios->get($where, '*');
		$nickname = explode(' ', $usuario->nombre);
		$nickname = $nickname[0];
		$where = array('cve_perfil' => $usuario->cve_perfil);
		$perfil = $this->gl_cat_perfiles->get($where, 'default_controller');
		$sesion = array(
			'cve_usuario' => $usuario->cve_usuario,
			'cve_perfil' => $usuario->cve_perfil,
			'nombre' => $usuario->nombre,
			'nickname' => $nickname,
			'default_controller' => $perfil->default_controller,
			'logueado' => true
		);
		$this->session->set_userdata($sesion);
		exit(json_encode(array('bandera'=>true, 'default_controller'=>$this->session->userdata('default_controller'))));
	}

	# Metodo para dar de alta un nuevo usuario
	public function Alta() {
		# Guardamos los parametros de la peticion en variables locales
		$data = array(
			'cve_usuario' => $this->input->get('cve_usuario'),
			'contrasenia' => $this->input->get('contrasenia'),
			'cve_perfil' => $this->input->get('cve_perfil'),
			'nombre' => $this->input->get('nombre'),
			'estatus' => 'A',
		);
		$this->gl_cat_usuarios->alta($data) ? exit(json_encode(array('bandera'=>true, 'msj'=>'Petición procesada con éxito'))) : exit(json_encode(array('bandera'=>false, 'msj'=>'Se presento un error al crear el registro')));
	}

	# Metodo para destruir los variables de sesion del usuario logueado
	public function Salir() {
		if ($this->session->userdata() && $this->session->userdata('logueado') == true) {
			$sesion = array('logueado' => false);
			$this->session->set_userdata($sesion);
			delete_cookie('cve_perfil', 'localhost', '/');
		}
		redirect(base_url());
	}
}