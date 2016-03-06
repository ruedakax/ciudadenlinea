<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Estudiante extends CI_Controller {

	function __construct(){
		parent::__construct();
		 
		// load library
		$this->load->library(array('table','form_validation'));		 
		// load helper
		$this->load->helper('url');
		// load model
		$this->load->model('estudiante_model','',TRUE);
		date_default_timezone_set("America/Bogota");
	}
	 
	function index(){
		$data['title'] = "Estudiante";		
		$data['message'] = "";
		$this->form_validation->nombre = "";
		$this->form_validation->apellido = "";
		$this->form_validation->genero = "";
		$this->form_validation->fecha_nacimiento = "";
		$this->form_validation->email = "";
		$this->load->view('estudiante', $data);
	}
	 
	function add(){
		$this->_set_rules();
		if($this->input->post('accion')){			
			$this->form_validation->nombre = $this->input->post('nombre');
			$this->form_validation->apellido = $this->input->post('apellido');
			$this->form_validation->genero = $this->input->post('genero');
			$this->form_validation->fecha_nacimiento = $this->input->post('fecha_nacimiento');
			$this->form_validation->email = $this->input->post('email');
			
			if ($this->form_validation->run()!==FALSE){
					$estudiante = array(
							"nombre" => $this->input->post('nombre'),
							"apellido" => $this->input->post('apellido'),
							"genero" => $this->input->post('genero'),
							"fecha_nacimiento" => $this->input->post('fecha_nacimiento'),
							"email" => $this->input->post('email'),
					);
				$this->form_validation->nombre = "";
				$this->form_validation->apellido = "";
				$this->form_validation->genero = "";
				$this->form_validation->fecha_nacimiento = "";
				$this->form_validation->email = "";
				$id = $this->estudiante_model->save($estudiante);
				$data['message'] = '<div class="success">Registro guardado!</div>';			
			}else{
				$data['message'] ="existen errores.";
				
			}			
		}		
		$data['title'] = "Estudiante";		
		$this->load->view('estudiante', $data);
	}

	// validation rules
	function _set_rules(){
		$reglas = array(
				array(
						'field' => 'nombre',
						'label' => '',
						'rules' => 'required'
				),
				array(
						'field' => 'apellido',
						'label' => '',
						'rules' => 'required'
				),
				array(
						'field' => 'genero',
						'label' => '',
						'rules' => 'required'
				),
				array(
						'field' => 'fecha_nacimiento',
						'label' => 'Fecha de Nacimiento (dd-mm-yyyy)',
						'rules' => 'callback_valid_date'
				),
				
				array(
						'field' => 'email',
						'label' => '',
						'rules' => 'required','valid_email'
				)
		);
			
		$this->form_validation->set_rules($reglas);
		$this->form_validation->set_message('required', '* campo obligatorio');
		$this->form_validation->set_message('numeric', '* debe ser un número sin separadores');
		$this->form_validation->set_message('isset', '* campo obligatorio');
		$this->form_validation->set_message('min_length', 'debe ser mayor de 7 caracteres');
		$this->form_validation->set_message('valid_email', 'email invalido');
		$this->form_validation->set_error_delimiters('<p class="error">', '</p>');
		
		$this->form_validation->nombre = "";
		$this->form_validation->apellido = "";
		$this->form_validation->genero = "";
		$this->form_validation->fecha_nacimiento = "";
		$this->form_validation->email = "";	
	}	
	 
	// date_validation callback
	function valid_date($str){
		/*$date = DateTime::createFromFormat('Y-m-d', $str);
		$res = $date !== false && !array_sum($date->getLastErrors());
		if (!$res) {
			$this->form_validation->set_message('valid_date', 'La fecha no tiene el formato v�lido: yyyy-mm-dd');
		}
		return $res;*/
		if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$str))
		{
			return true;
		}else{
			return false;
		}		
	}	
}
?>