<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
		parent::__construct();				
		$this->load->helper('url');		
		$this->load->model('Usuario_model');
	}
	
	public function index()	{
		if($this->session->userdata('validated')){
			redirect( base_url().'home');
		}				
		$this->load->view('inicio');		
	}
	
	public function check()	{
		$cedula = $this->input->post('cedula');
		$clave = $this->input->post('clave');		
		if(isset($cedula) && isset($clave)){			
			// Validate the user can login
			$result = $this->Usuario_model->validate($cedula,$clave);
			// Now we verify the result
			if(!$result){
				echo "ERROR";
				die;
			}else{
				echo "OK";
			}			
		}else{
			echo "ERROR";
			die;			
		}		
	}
	
	public function bye(){
		$this->session->sess_destroy();
		redirect( base_url().'inicio');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */