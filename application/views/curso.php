<?php $this->load->view('header'); ?>
<div class="content">
 <h1><?php echo $title?></h1> 
 <div class="data">
	<div style="float:left">
		<form method="post">
			<input type="text" placeholder="Búsqueda" name="criterio" id="criterio"/>
			<input type="button" name="buscar" value="Buscar" id="buscar"/>			
		</form>
	</div>
	<div id="loading" style="display:none">
		<img src="<?php echo base_url()?>assets/img/loading.gif">
	</div>
 </div>
 <br />
<div  id="resultado">
	<form method="post">
		<input type="hidden" name="next" value="<?php echo $next?>" id="next"/>
		<input type="hidden" id="limit" name="limit" value="<?php echo $limit?>">
	</form>
</div> 
</div>
<script>
$('#buscar').click(function(){
	criterio = $('#criterio').val();
	next = $('#next').val();
	limit = $('#limit').val();
	$("html, body").animate({ scrollTop: 0 }, "fast");
	$('#loading').toggle();
	$.ajax({
        url: '<?php echo  base_url()?>curso/query',
        type: 'POST',        
        data: 'criterio=' + criterio + '&next=' + next + '&limit=' + limit,
        success: function (response) {
        	$('#resultado').html(response);
			$('#loading').toggle();				
        },
        error: function (e) {
        	$('#mensaje').text("La aplicación presenta dificultades!");
        }
    });
}).change(function() {
  $('#next').val(<?php echo $next?>);
  $('#limit').val(<?php echo $limit?>);
});
</script>
<?php $this->load->view('footer'); ?>