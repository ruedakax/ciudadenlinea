<br />
<div class="data">
	<form method="post">
		<input type="hidden" name="next" value="<?php echo $next?>" id="next"/>
		<input type="hidden" id="limit" name="limit" value="<?php echo $limit?>">
	</form>
	<?php echo $table; ?>	
</div>
<?php echo $paginacion; ?>
<script>$('.cbs').click(function(){
	var next = parseInt($( this ).html(),10);
	$('#next').val(next);
	$("#buscar").trigger("click");	
});</script>
<br />
