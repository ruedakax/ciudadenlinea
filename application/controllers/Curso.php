<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Curso extends CI_Controller {
	private $limit=25;
	private $next=1;	
	
	function __construct(){
		parent::__construct();
		
		// load helper
		$this->load->helper('url');
		// load curl tool
		$this->load->library('PHPRequests');
	}
	 
	function index(){		
		$data['title'] = "Búsqueda de cursos";		
		$data['message'] = "";
		$data['limit'] = $this->limit;
		$data['next'] = $this->next;
		$this->load->view('curso', $data);
	}
	
	function query(){
		$criterio = $this->input->post('criterio');
		$limit = $this->input->post('limit');
		$start = $this->input->post('next')==1?1:($this->input->post('next')*$this->limit)+1;
		$criterio = str_replace(" ", "+",$criterio);
		$response = Requests::get("https://api.coursera.org/api/courses.v1?q=search&limit=".$limit."&start=".$start."&fields=id,description,name,photoUrl&query=".$criterio);
		
		$data['title'] = "Búsqueda de cursos";
		$data['limit'] = $this->limit;
		$data['next'] = $this->next;
		$data['paginacion'] ="";
		$objetos = json_decode($response->body);
				
		if($objetos->paging->total > 0){			
			// generate table data
			$cursos = $objetos->elements;
			$this->load->library('table');
			$this->table->set_empty("&nbsp;");
			$this->table->set_heading('&nbsp;', 'Nombre', 'Descripci&oacute;n', '&nbsp');
			
			foreach ($cursos as $curso){
				$this->table->add_row('<img src="'.htmlentities($curso->photoUrl).'" width="50" height="50" />', $curso->name,$curso->description,anchor(base_url().'curso/item/'.$curso->id,'ampliar',array('class'=>'')));
			}
			$data['table'] = $this->table->generate();
			//paginacion
			$paginas = floor($objetos->paging->total/$this->limit);
			if($paginas > 1){
				$celdas = "";
				for($i=1;$i<$paginas;$i++){
					$selected="class='cbs'";
					if($this->input->post('next')==$i){
						$selected = "class='' style='color:#b52d4f'";
					}
					$celdas .= "<td><span ".$selected.">".$i."</span></td>"; 
				}
				$data['paginacion'] = "<table class='paginacion'><tr>".$celdas."</tr><table>";				
			}
			//
			// load view
			echo $this->load->view('curso_listado', $data,true);			
		}else{			
			$data['table'] = "<div>No Existen Registros Para este cristerio.</div>";
			echo $this->load->view('curso_listado', $data,true);
		}
	}
	
	function item(){
		$uri_segment = 3;
		$id = $this->uri->segment($uri_segment);
		$response = Requests::get("https://api.coursera.org/api/courses.v1/".$id."?fields=name,partnerLogo");
		$item = json_decode($response->body);
		$curso = $item->elements[0];
		$data['imagen'] = $curso->partnerLogo;
		$data['title'] = $curso->name;
		$data['id_curso'] = $id;
		//matriculados
		$this->load->model('estudiante_model','',TRUE);
		$estudiantes = $this->estudiante_model->get_estudiantes($id);
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Estudiantes inscritos');
		foreach ($estudiantes as $estudiante){
			$this->table->add_row($estudiante->nombre." ".$estudiante->apellido);
		}
		$data['table'] = $this->table->generate();
		$this->load->view('item', $data);
	}
	function relate(){
		$id = $this->input->post('curso_id');
		$this->load->model('estudiante_model','',TRUE);
		$estudiantes = $this->estudiante_model->get_noInscritos($id);
		$this->load->library('table');
		$this->table->set_empty("&nbsp;");
		$this->table->set_heading('Estudiantes a inscribir','Marque estudiantes a inscribir');
		foreach ($estudiantes as $estudiante){
			$this->table->add_row($estudiante->nombre." ".$estudiante->apellido,'<input type="checkbox" name="ainscribir" value="'.$estudiante->id.'" />');
		}
		$table = $this->table->generate();
		echo $table;
	}
	function inscribir(){
		$this->load->model('estudiante_model','',TRUE);
		$id = $this->input->post('curso_id');
		$nuevos = explode(",",$this->input->post('nuevos'));	
		foreach($nuevos as $id_estudiante){
			$matricula = array(
							"id_estudiante" => $id_estudiante,
							"id_curso" => $id,
							"fecha" => date('Y-m-d', time()),
						);
			$this->estudiante_model->matricular($matricula);			
		}
	}

}
?>