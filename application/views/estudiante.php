<?php $this->load->view('header'); ?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">  	
  	<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
  	<script> 
  	function isValidDate(day,month,year){
  	    var dteDate; 	    
  	    month=month-1; 	    
  	    dteDate=new Date(year,month,day);  	    
  	    return ((day==dteDate.getDate()) && (month==dteDate.getMonth()) && (year==dteDate.getFullYear()));
  	}

  	function validate_fecha(fecha){
  	    var patron=new RegExp("^(19|20)+([0-9]{2})([-])([0-9]{1,2})([-])([0-9]{1,2})$");  	 
  	    if(fecha.search(patron)==0)
  	    {
  	        var values=fecha.split("-");
  	        if(isValidDate(values[2],values[1],values[0]))
  	        {
  	            return true;
  	        }
  	    }
  	    return false;
  	}
  	
  	$(function() {
  	    $( "#datepicker" ).datepicker({
  	      changeMonth: true,
  	      changeYear: true,
  	      dateFormat:"yy-mm-dd",
  	      dayNames: [ "Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado" ],
  	  	  dayNamesMin: [ "Do", "Lu", "Ma", "Mi", "Ju", "Vi", "Sa" ],
  	      dayNamesShort: [ "Dom", "Lun", "Mar", "Mie", "Jue", "Vie", "Sab" ],
  	      monthNames: [ "Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre" ],
  	      monthNamesShort: [ "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic" ],
  	    });  	  	
  	  });	
  	$(document).ready(function(){		  	  	
	  	$("#datepicker").change(function() {
		  	var fecha=this.value;
		    if(validate_fecha(fecha)==true){
		        
		        var values=fecha.split("-");
		        var dia = values[2];
		        var mes = values[1];
		        var ano = values[0];
		 
		        var fecha_hoy = new Date();
		        var ahora_ano = fecha_hoy.getYear();
		        var ahora_mes = fecha_hoy.getMonth();
		        var ahora_dia = fecha_hoy.getDate();		 
		        
		        var edad = (ahora_ano + 1900) - ano;
		        if ( ahora_mes < (mes - 1))
		        {
		            edad--;
		        }
		        if (((mes - 1) == ahora_mes) && (ahora_dia < dia))
		        {
		            edad--;
		        }
		        if (edad > 1900)
		        {
		            edad -= 1900;
		        }		 
		        $("#edad").val(edad);
		    }else{
		    	$("#edad").val("");
		    } 	  			  		
	  	});	  		 	
  });	     	  			  
  </script>
	<div class="content">    	
        <h1><?php  echo $title; ?></h1>
        <?php  echo $message; ?>        
        <div class="data">
        <form method="post" action="<?php echo  base_url()?>estudiante/add">        
        <table>                
            <tr>
                <td valign="top">Nombre<span style="color:red;">*</span></td>
                <td><input type="text" name="nombre" class="text" value="<?php echo $this->form_validation->nombre;?>"/></td>
                <td>&nbsp;<?php echo  form_error('nombre')?> </td>
            </tr>
            <tr>
                <td valign="top">Apellido<span style="color:red;">*</span></td>
                <td><input type="text" name="apellido" class="text" value="<?php echo $this->form_validation->apellido;?>"/></td>
                <td>&nbsp;<?php echo  form_error('apellido')?> </td>                
            </tr>
            <tr>
                <td valign="top">Genero<span style="color:red;">*</span></td>
                <td><label for = "femenino">Femenino</label><input type = "radio" name="genero" id ="femenino" value = "femenino"/><label for = "maculino">Maculino</label><input type = "radio" name="genero" id ="masculino" value = "masculino" /></td>
                <td>&nbsp;<?php echo  form_error('genero')?> </td>                
            </tr>
            <tr>
                <td valign="top">Fecha de Nacimiento (dd-mm-yyyy)<span style="color:red;">*</span></td>
                <td><input type="text" name="fecha_nacimiento" id="datepicker" class="text" value="<?php echo $this->form_validation->fecha_nacimiento;?>"/></td>
                <td>&nbsp;<?php echo  form_error('fecha_nacimiento')?> </td>
            </tr>
            <tr>
                <td valign="top">Email<span style="color:red;">*</span></td>
                <td><input type="text" name="email" id="email" class="text" value="<?php echo $this->form_validation->email;?>"/></td>
                <td>&nbsp;<?php echo  form_error('email')?> </td>                
            </tr>                           
        </table>         
        <table>
           	<tr>
                <td>&nbsp;</td>                
                <td>&nbsp;</td>
                <td><input type="submit" value="Guardar" name="accion" id="accion"/></td>
            </tr>
        </table>          
        </form>
        </div>
        <br />
        <?php //echo $link_back; ?>
    </div>
<?php $this->load->view('footer'); ?>