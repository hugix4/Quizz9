<!doctype html>
<?php
require('secPdLic.php');
require('fxQuiz.php');
include('cnxh.php');
$quiz=new fxQuizz();
$conexion=new conexion();
$conexion->conectar();
$nombreBD='pdlic2015';
$tituloEx='Quizz 9';
$nPreguntas=10;
$nQuizz=9;
$Cuenta=$_SESSION["Cuenta"];
?>
<html lang="es">
	<head>
		<link href="Favicon.ico" type="image/x-icon" rel="shortcut icon" />
		<title>Coordinación General de Lenguas</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1"'>	
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"><!-- Latest compiled and minified CSS -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script><!-- jQuery library -->
		<link rel="stylesheet" href="hugix.css" type="text/css" media="screen" /><!-- Mi hoja de estilos-->
		<link rel="stylesheet" href="css/hugixBS.css" type="text/css" media="screen" /><!-- Mi 2a hoja de estilos-->
		
		<script>
			function habilita(){
				for(var i=1;i<=10;i++){
					document.getElementById('sel'+i).disabled=false;
				}
			}
		
			function dirCGL()
			{
				var direccion="http://www.cgl.unam.mx";
				location.href=direccion;
			}
			
			function dirUNAM()
			{
				var direccion="http://www.unam.mx";
				location.href=direccion;
			}
			
			function Califica(){
				var suma=[];
				for(var i=1;i<=10;i++){
					document.getElementById('sel'+i).disabled=true;
					var valor=document.getElementById('sel'+i).value;
					if(valor=='xh'){
						valor=1;						
					}
					else{
						valor=0;
					}
					suma[i]=parseInt(valor);					
				}
				var calificacion=null;
				for(var h=1;h<suma.length;h++){
					calificacion+=suma[h];
				}				
				//alert("Tu calificación en la segunda parte es de "+[(calificacionT/16)*10]);
				//alert("Los valores obtenidos son: "+sumaT);
				var c_Total=calificacion;
				//alert("Tu calificación total es: "+c_Total);
				document.getElementById('Calificacion').value=c_Total;
				//alert("Ya se mandó la calificación, la cual debe ser: "+c_Total);				
				$("#quizz").submit();
			}
			
			$(document).ready(function(){
				$("#vRespuesta").click(function (){
					var nulo=0;
					var faltantes=[];
					for(var i=1;i<=10;i++){
						var valor=i;
						if(document.getElementById('sel'+i).checked == true){
							valor=document.getElementById('sel'+i).value;
							if(valor=="xh"){
								valor=1;
								//alert("El valor en la pregunta "+i+" ya transformado es "+valor);
							}
							
						}
						else{
							alert("Te falta contestar el ejercicio "+i);
							alert("Falta contestar la pregunta: "+nulo);
							faltantes[nulo]=i;
							nulo++;
						}
						
					}				
					if(nulo!=0)
					{					
						alert(""+faltantes.toString());
						var faltan=faltantes.toString();
						if(faltantes.length==1){
							alert("Te falta contestar un ejercicio: ");
						}
						else{
							alert("Te falta contestar algunos ejercicios: ";
						}
					}
					else{
						//alert("Ahora se calificará el examen, ya no puedes cambiar tus respuestas");						
						Califica();
					}
					//alert("El valor que obtuvo nulo fue: "+nulo);
					return false;
				});
				
				$("#contestaT").click(function (){
					alert("Entró al contestaT");
					//for(var i=1;i<=10;i++){
						//var idSel="sel"+i;
						//document.getElementById('sel'+i).checked = true;
						//alert("Ya seleccionó el index 2");
					//}
				});				
			});
			
			function aMinuscula(campo){				
				var x = document.getElementById(''+campo+'');
				x.value = x.value.toLowerCase();
				var opciones=document.getElementById(''+campo+'').value;
				if(x.value.length==2  ){
					switch(opciones){
							case "is":
							case "ar":
							case "am"://alert ("Bien, puedes continuar");
							break;
							default:
							alert("This is not a valid answer, remember use \nthe correct form of the verb to be");	
							x.value="";
					}
				}
				if(x.value.length==3 && x.value!="are"){
					alert("This is not a valid answer, remember use \nthe correct form of the verb to be");
					x.value="";
				}
			}
			
		</script>
		<?php
		
		/*Esta funci&oacute;n obtiene como arreglo las respuestas seleccionadas de los radiobutton*/
		function getRespuestas($Npreguntas,$Nactual){
			$res=array();
			for($i=1+$Nactual;$i<=$Npreguntas+$Nactual;$i++){						
				$res[$i]=$_POST['p'.$i];				
			}
			return $res;
		}
		?>
	</head>
	<body style="margin-top: 0%; font-size:1.4em" onload='habilita()'>
		<style>
			p{
				color: #FFF;
				font-size:18px;
				margin-left:20%;
			}
			select{
				color: #000;
			}
			option{
				color: #233072;
			}
			
			
		</style>
		
		<nav class="navbar navbar-inverse">			
				<div class="navbar-header">					
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>					  
					<a class="navbar-brand" >
						<img src="images/LogoUNAMamarillo.png" alt="UNAM" height="80%" width="5.5%" onclick='dirUNAM()' style="cursor:pointer; position:absolute; top:16%; left:5%; height=10%;">
					</a>
					<a class="navbar-brand" >
						<img alt="" src="images/LogoCGLblanco.png" alt="CGL" height="70%" width="12%" onclick='dirCGL()' style="cursor:pointer; position:absolute; top:20%; left:15%;">
					</a>
					
					  <!--<a class="navbar-brand" href="#">CGL</a>-->
				</div>
				<div id="navbar" class="collapse navbar-collapse">
					  <p style="text-align: right;"><font style="color:#fff;font-size:2em; font-weight:bold;"><br/><?php echo $tituloEx;?></font></p>
					  
				</div><!--/.nav-collapse -->				
		  
		</nav>

		<br/>
		<div class="container container-fluid">	
			<?php
			$calificacionQ=$quiz->consultaUnica("SELECT q$nQuizz FROM $nombreBD Where Cuenta='$Cuenta'");
			if($calificacionQ==0){
				//echo"La calificacion del quizz fue $calificacionQ es 0";
			?>
			<form action="quizz.php" method="POST" id="quizz">
				<font style="color:#CB9D01; font-size:18px; text-align:center;"><b>Chose the correct form of the verb to be: am, is or are</b></font><br/><br/>			
				<p>
				<?php
					$quiz->preguntaDe3(1,"The exam _____ twenty two questions.","haves","have","has","has");
					$quiz->preguntaDe3(2," Emilio _____ to do homework.","haves","have","has","has");
					$quiz->preguntaDe3(3,"Karina ____ a brother.","don't has","don't have","doesn't have","doesn't have");
					$quiz->preguntaDe3(4,"Ernest _____ to use the computer.","have","has","haves","doesn't like");
					$quiz->preguntaDe3(5,"Laura ____ pets.","don't has","don't have","doesn't have","doesn't have");
					$quiz->preguntaDe3(6,"The Johnsons _____ two sons and one daughter.","haves","have","has","have");
					$quiz->preguntaDe3(7,"Emily and her sister _____ a lot of shoes.","have","has","haves","have");
					$quiz->preguntaDe3(8,"The teacher ____ a surprise for us today. That's a shame.","don't has","don't have","doesn't have","doesn't have");
					$quiz->preguntaDe3(9,"Henry _____ a new car ...again!","have","has","haves");
					$quiz->preguntaDe3(10,"Edward _____ money to pay his school.","don't has","don't have","doesn't have","doesn't have");
					?>
				</p>
				<br/>
				<br/>
				<input type=button style='margin-left:35%;' class='btn' id='vRespuesta' value='Calificar examen'>				
				<input type=button style='margin-left:35%;' class='btn' id='contestaT' value='Contestar todo'>
				<input type='hidden' id='Calificacion' name='Calificacion' value='nulo'>
				<input type='hidden' id='nPreguntas' name='nPreguntas' value='<?php echo$nPreguntas;?>'>
				<input type='hidden' id='nQuizz' name='nQuizz' value='<?php echo $nQuizz;?>'>
				<br/>	
				</form>
			<?php }
			else{
				echo"<br/><br/>You have already answered this Quizz, please try another one<br/><br/>";
			}?>
			<br/>
			<br/>
			<u><a href='paqtlic.php'> Regresar</a></u>
			<br/>
			<br/>
			<u><a href='salirPdLic.php'> Cerrar sesión </a></u>
			<br/>
			<br/>
		</div><!-- container -->
		<br/>
			<br/>
			<br/>
			<br/> 
			<br/>
			<br/>
			<br/>
			<br/> 
			<br/>
			<br/> 
		<br/>
		<br/>
		<br/>
		<br/>
		<footer class="footer">
			<div class="container">
				<p class="text-muted"><font style="font-size: 0.9em">
					Hecho en M&eacute;xico, <a href="http://www.unam.mx">Universidad Nacional Aut&oacute;noma de M&eacute;xico (UNAM)</a>, todos los derechos reservados 2009 - 2015. Esta p&aacute;gina puede ser reproducida con fines no lucrativos, siempre y cuando se cite la fuente completa y su direcci&oacute;n electr&oacute;nica, y no se mutile. De otra forma requiere permiso previo por escrito de la instituci&oacute;n.<a href="creditos.html">Cr&eacute;ditos</a></font>
				</p>
			</div>
		</footer>
		<!--Ingeniero Hugo Luna a.k.a. hugix4-->
	</body>
</html>
