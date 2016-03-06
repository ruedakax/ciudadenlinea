<?php $this->load->view('header'); ?>
<div class="content">
  <div class="data">
	<img width="100px" height="100px" src="<?php echo $imagen?>">
	<h1><?php echo $title ?></h1>	
</div>
<div class="data">
<div id="inscribir" style="cursor:pointer;float:left;color:#8A0808;font-weight: bold;">Inscribir Estudiante</div>
<div class="elboton" id="btnenviar" style="display:none">Enviar</div>
<div id="loading" style="display:none">
		<img src="<?php echo base_url()?>assets/img/loading.gif">
</div>
</div>
<br />
<div class="data" id="otros" style="display:none">
	
</div>
<div class="data" id="matriculados">
 <?php echo $table ?>
</div> 
</div>
<script>
$('#inscribir').click(function(){
	if($('#otros').css('display') == 'none'){
		curso_id = '<?php echo $id_curso?>';
		$('#loading').toggle();
		$.ajax({
			url: '<?php echo  base_url()?>curso/relate',
			type: 'POST',        
			data: 'curso_id=' + curso_id,
			success: function (response) {
				$('#otros').html(response);
				$('#otros').toggle();
				$('#loading').toggle();
				$('#btnenviar').toggle();			
			},
			error: function (e) {
				$('#mensaje').text("La aplicación presenta dificultades!");
			}
		});
	}else{
		$('#otros').toggle();
		$('#btnenviar').toggle();
	}	
});
$('#btnenviar').click(function(){
	if($('#otros').css('display') != 'none'){
		var selected = [];
		$('#otros input:checked').each(function() {
			selected.push($(this).attr('value'));
		});
		if(selected.length > 0){
			var curso_id = '<?php echo $id_curso?>';
			$('#loading').toggle();
			$.ajax({
				url: '<?php echo  base_url()?>curso/inscribir',
				type: 'POST',        
				data: 'curso_id=' + curso_id + '&nuevos=' + selected,
				success: function (response) {
					setTimeout(swal("OK", "Los estudiantes fueron matriculados", "success"),3000);
					window.location.reload(false); 			
				},
				error: function (e) {
					$('#mensaje').text("La aplicación presenta dificultades!");
				}
			});
		}else{
			alert("no hay tal");
		}
	}else{		
		$('#btnenviar').toggle();
	}	
});
</script>
<?php $this->load->view('footer'); ?>