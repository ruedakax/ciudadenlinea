<?php
class Estudiante_Model extends CI_Model {
	// table name
	private $tbl_estudiante = 'estudiante';
	private $tbl_matricula = 'matricula';

	function __construct(){
		parent::__construct();
	}
	function save($person){
		return $this->db->insert($this->tbl_estudiante, $person);		
	}
	function get_estudiantes($id_curso){
		$consulta = "SELECT nombre,apellido,id FROM `estudiante` 
				     JOIN `matricula` ON `matricula`.`id_estudiante` = `estudiante`.`id` 
					 WHERE `id_curso` = '".$id_curso."' ORDER BY `apellido` ASC";
		$query = $this->db->query($consulta);
		return $query->result();
	}

	function get_noInscritos($id_curso){
		$consulta = "SELECT id,nombre,apellido FROM `estudiante`
					 WHERE id not in (SELECT id_estudiante FROM `matricula` 
				        			  WHERE `id_curso` = '".$id_curso."')";
		$query = $this->db->query($consulta);
		return $query->result();
	}	
	function matricular($matricula){
		return $this->db->insert($this->tbl_matricula, $matricula);
	}
}
?>