<html class=""><head><meta charset="UTF-8"><meta name="robots" content="noindex">
<link rel="stylesheet prefetch" href="http://daneden.github.io/animate.css/animate.min.css"><link rel="stylesheet prefetch" href="http://fonts.googleapis.com/css?family=Roboto:400,100,400italic,700italic,700">
<style class="cp-pen-styles">
body {
  background: #CC2E34 url("http://upload.wikimedia.org/wikipedia/commons/thumb/3/39/Medellin_colombia.JPG/1280px-Medellin_colombia.JPG") no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  font-family: "Roboto";
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
}
body::before {
  z-index: -1;
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  background: #CC2E34;
  /* IE Fallback */
  background: rgba(247, 161, 150, 0.8);
  width: 100%;
  height: 100%;
}
.form {
  position: absolute;
  top: 50%;
  left: 50%;
  background: #fff;
  width: 285px;
  margin: -140px 0 0 -182px;
  padding: 40px;
  box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
}
.form h2 {
  margin: 0 0 20px;
  line-height: 1;
  color: #CC2E34 ;
  font-size: 18px;
  font-weight: 400;
}
.form input {
  outline: none;
  display: block;
  width: 100%;
  margin: 0 0 20px;
  padding: 10px 15px;
  border: 1px solid #ccc;
  color: #ccc;
  font-family: "Roboto";
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
  font-size: 14px;
  font-wieght: 400;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  -webkit-transition: 0.2s linear;
  -moz-transition: 0.2s linear;
  -ms-transition: 0.2s linear;
  -o-transition: 0.2s linear;
  transition: 0.2s linear;
}
.form input:focus {
  color: #333;
  border: 1px solid #2ecc71;
}
.form button {
  cursor: pointer;
  background: #CC2E34;
  width: 100%;
  padding: 10px 15px;
  border: 0;
  color: #fff;
  font-family: "Roboto";
  font-size: 14px;
  font-weight: 400;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  -webkit-transition: 0.2s linear;
  -moz-transition: 0.2s linear;
  -ms-transition: 0.2s linear;
  -o-transition: 0.2s linear;
  transition: 0.2s linear;
}
.form button:hover {
  background: #27ae60;
}
</style>
</head><body>
<div class="form animated flipInX">
<div id="mensaje" style="margin-bottom: 20px;background-color: rgb(255, 240, 253);padding: 10px;display:none"></div>
  <h2>Sistema de cursos</h2>
  <form>
    <input name="cedula" id="cedula" placeholder="cedula" type="text" value="8888">
    <input name="clave" id="clave" placeholder="clave" type="password" value="12345678">
    <button class="animated infinite pulse" id="enviar" type="button">Entrar</button>
  </form>
</div>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
$(document).keypress(function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if(keycode == '13') {
       $( "#enviar" ).trigger( "click" );   
    }
});
$('#enviar').click(function () {
	usuario = $('#cedula').val();
	clave = $('#clave').val();	
    $.ajax({
        url: '<?php echo  base_url()?>inicio/check',
        type: 'POST',        
        data: 'cedula=' + usuario + '&clave='+clave ,
        success: function (response) {
        	if(response == "OK"){
        		window.location.replace('<?php echo  base_url()?>curso/');        			
            }else{
            	$('#mensaje').text("Usuario o clave invalidos!");
            	$( "#mensaje" ).fadeIn(3000);
            	$( "#mensaje" ).fadeOut(3000);            	
            }            	
        },
        error: function (e) {
        	$('#mensaje').text("La aplicación presenta dificultades!");
        }
    });
});
</script>
</body></html>