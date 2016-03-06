<?php
if(!$this->session->userdata['cedula']){
	redirect('inicio');
	die;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<title>Sistema de cursos</title> 
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="<?php echo base_url(); ?>assets/alert/lib/sweet-alert.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/alert/lib/sweet-alert.css"/>
<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" type="text/css" /> 
</head>
<body>
<div class="user"><?php  echo $this->session->userdata['nombre'];?>
	<a href="<?php echo base_url(); ?>inicio/bye">Salir</a>
</div>
<div id="navegador">
<ul>
	<li><a href="<?php echo base_url(); ?>curso">Inicio</a></li>
	<li><a href="<?php echo base_url(); ?>estudiante">Estudiantes</a></li>
</ul>
</div>
