<?php
class Usuario_Model extends CI_Model {
	// table name
	private $tbl_person= 'usuario';
	
	public function validate($cedula,$clave){
		
		$usuario = $this->security->xss_clean($cedula);
		$laclave = $this->security->xss_clean($clave);
				
		$this->db->where('cedula', $usuario);
		$this->db->where('clave', $clave);
	
		$query = $this->db->get($this->tbl_person);		
		if($query->num_rows() == 1){			
			$row = $query->row();			
			/*datos en sesion del menu*/
			//$permisos = $this->getMenu($row->cedula);								
			/**/
			$data = array(
					'cedula' => $row->cedula,
					'nombre' => $row->nombre,
					'regional' => $row->regional,
										
			);
			$this->session->set_userdata($data);			
			return true;
		}		
		$this->session->sess_destroy();
		return false;
	}	
}
?>