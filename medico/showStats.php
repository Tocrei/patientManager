<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
$Tipo = $res['Tipo'];


$campos =['Enfermedad','Edad','Sexo'];


$unomas = $db->tests;
$cursorTest = $unomas->find();

$pac = $db->pacientes;
$cursorPacientes = $pac->find();




$tag = $db->tags;

$canvas=0; // 1-Solo enfermedad, 2-solo fecha 3-solo sexo
			//4-enfer-fecha, 5-enfer-sexo, 6-fecha-sexo, 7-todos


#arrays para pintar en Solo Fecha
$arrayLabels = array();
$arrayContador = array();


#arrays para pintar en solo enfermedad buscando rangos de fechas
$countVeinte = 0;
$countTreinta = 0;
$countCuarenta = 0;
$countCincuenta = 0;
$countSesenta = 0;
$countSetenta = 0;
$countOchenta = 0;
$countNoventa = 0;

#contadores hombre mujer para enfermedad-sexo
$countHombres=0;
$countMujeres=0;


#Enfermedad
$enfermedad = $_POST['Enfermedad'];
$arrayEnfermedad = array();
$arrayEnfermedadCount = "0";

#Sexo
$sexo = $_POST['sexo'];
$arraySexo = array();
$arraySexoCount = "0";


#array para control de los 3 campos (lleva los dni´s no repetidos de los pacientes que los cumplan)
$arrayPacientesTriple= array();


$edadInicio = $_POST['inicio'];
$edadFin = $_POST['fin'];


if ($edadInicio == ""){
	$edadInicio = "0";

}
if ($edadFin == ""){
	$edadFin = "999";

}

$contador = "0";

#caso solo enfermedad(cambiado para nuevas estadisticas)
if($enfermedad != "" && $sexo == "" && $edadInicio == "0" && $edadFin == "999")
{
	$canvas=1;
	foreach ($cursorTest as $documentoTest) {
		if($documentoTest["Etiqueta"] == $enfermedad ) {
			#aqui se que la enfermedad es de un paciente
			#ahora toca saber el rango de edades del paciente y meterle uno
			foreach ($cursorPacientes as $documento) {

				if($documentoTest['DNIPaciente'] == $documento['DNI'])
				{
					$anos = substr($documento['Fecha_de_nacimiento'], -4);
					$meses = substr($documento['Fecha_de_nacimiento'], -7, 2);
					$dias = substr($documento['Fecha_de_nacimiento'], 2);
					$edad = $anos * 365 + $meses*30 + $dias;
					#aqui tenemos 19XX
					$fecha_actual_anos=date("Y");
					$fecha_actual_meses=date("m");
					$fecha_actual_dias=date("d");
					$fecha_actual = $fecha_actual_anos * 365 + $fecha_actual_meses*30 + $fecha_actual_dias;
					$edad = $fecha_actual-$edad;
					$edad = $edad / 365;

					if( ($edad <= 30) && ($edad >= 0) ) {
						$countVeinte++;
					}
					else  if( ($edad <= 40) && ($edad >= 30) ) {
						$countTreinta++;
					}
					else if( ($edad <= 50) && ($edad >= 40) ) {
						$countCuarenta++;
					}
					else 
					if( ($edad <= 60) && ($edad >= 50) ) {
						$countCincuenta++;
					}
					else if( ($edad <= 70) && ($edad >= 60) ) {
						$countSesenta++;
					}
					else if( ($edad <= 80) && ($edad >= 70) ) {
						$countSetenta++;
					}
					else if( ($edad <= 90) && ($edad >= 80) ) {
						$countOchenta++;
					}
					else  if( ($edad <= 120) && ($edad >= 90) ) {
						$countNoventa++;
					}


				}
				
			}	
		}
	}	
}


#caso solo fecha(cambiado para nuevas estadisticas)
else if($enfermedad == "" && $sexo == "" && $edadInicio >= "-1" && $edadFin <= "1000")
{
	$canvas=2;
	foreach ($cursorPacientes as $documento) {

		$anos = substr($documento['Fecha_de_nacimiento'], -4);
		$meses = substr($documento['Fecha_de_nacimiento'], -7, 2);
		$dias = substr($documento['Fecha_de_nacimiento'], 2);
		$edad = $anos * 365 + $meses*30 + $dias;
		#aqui tenemos 19XX
		$fecha_actual_anos=date("Y");
		$fecha_actual_meses=date("m");
		$fecha_actual_dias=date("d");
		$fecha_actual = $fecha_actual_anos * 365 + $fecha_actual_meses*30 + $fecha_actual_dias;
		$edad = $fecha_actual-$edad;
		$edad = $edad / 365;

		if( ($edad <= $edadFin) && ($edad >= $edadInicio) ) {
			foreach ($cursorTest as $documentoTest) {
				if($documento['DNI'] == $documentoTest['DNIPaciente'])
				{
						array_push($arrayLabels, $documentoTest["Etiqueta"]);															
				}
			}
		}
	}	
}
#caso solo sexo(cambiado para nuevas estadisticas)
else if($enfermedad == "" && $sexo != "" && $edadInicio == "0" && $edadFin == "999")
{
	$canvas=3;
	foreach ($cursorPacientes as $documento) {

		if($documento["Sexo"] == $sexo ) {
			foreach ($cursorTest as $documentoTest) {
				if($documento['DNI'] == $documentoTest['DNIPaciente'])
				{
						array_push($arrayLabels, $documentoTest["Etiqueta"]);															
				}
			}
		}
	}	
}

#caso enfermedad y fecha(cambiado para nuevas estadisticas)
else if($enfermedad != "" && $sexo == "" && $edadInicio >= "-1" && $edadFin <= "1000")
{
	$canvas=4;
	foreach ($cursorTest as $documento) {
		if($documento["Etiqueta"] == $enfermedad ) {
			$arrayEnfermedad[$arrayEnfermedadCount] = $documento;
			$arrayEnfermedadCount++;
		}
	}

	foreach ($cursorPacientes as $documento) {
		$anos = substr($documento['Fecha_de_nacimiento'], -4);
		$meses = substr($documento['Fecha_de_nacimiento'], -7, 2);
		$dias = substr($documento['Fecha_de_nacimiento'], 2);
		$edad = $anos * 365 + $meses*30 + $dias;
		#aqui tenemos 19XX
		$fecha_actual_anos=date("Y");
		$fecha_actual_meses=date("m");
		$fecha_actual_dias=date("d");
		$fecha_actual = $fecha_actual_anos * 365 + $fecha_actual_meses*30 + $fecha_actual_dias;
		$edad = $fecha_actual-$edad;
		$edad = $edad / 365;

		for($t=0;$t<sizeof($arrayEnfermedad);$t++)
		{
			if ($arrayEnfermedad[$t]['DNIPaciente'] == $documento['DNI'] && ($edad <= $edadFin) && ($edad >= $edadInicio) )
			{
				if($documento['Sexo'] == "H")
					$countHombres++;
				else
					$countMujeres++;
			}
		}

	}
}

#caso enfermedad y sexo
else if($enfermedad != "" && $sexo != "" && $edadInicio == "0" && $edadFin == "999")
{
	$canvas=5;
	foreach ($cursorPacientes as $documento) {
		if($documento["Sexo"] == $sexo ) {
			
	
			foreach ($cursorTest as $documentoTest) {
				if($documentoTest["Etiqueta"] == $enfermedad ) {
					if($documento['DNI'] == $documentoTest['DNIPaciente'])
					{
						$anos = substr($documento['Fecha_de_nacimiento'], -4);
						$meses = substr($documento['Fecha_de_nacimiento'], -7, 2);
						$dias = substr($documento['Fecha_de_nacimiento'], 2);
						$edad = $anos * 365 + $meses*30 + $dias;
						#aqui tenemos 19XX
						$fecha_actual_anos=date("Y");
						$fecha_actual_meses=date("m");
						$fecha_actual_dias=date("d");
						$fecha_actual = $fecha_actual_anos * 365 + $fecha_actual_meses*30 + $fecha_actual_dias;
						$edad = $fecha_actual-$edad;
						$edad = $edad / 365;

						if( ($edad <= 30) && ($edad >= 0) ) {
							$countVeinte++;
						}
						else  if( ($edad <= 40) && ($edad >= 30) ) {
							$countTreinta++;
						}
						else if( ($edad <= 50) && ($edad >= 40) ) {
							$countCuarenta++;
						}
						else 
						if( ($edad <= 60) && ($edad >= 50) ) {
							$countCincuenta++;
						}
						else if( ($edad <= 70) && ($edad >= 60) ) {
							$countSesenta++;
						}
						else if( ($edad <= 80) && ($edad >= 70) ) {
							$countSetenta++;
						}
						else if( ($edad <= 90) && ($edad >= 80) ) {
							$countOchenta++;
						}
						else  if( ($edad <= 120) && ($edad >= 90) ) {
							$countNoventa++;
						}
					}
				}
			}
		}
	}
}


#sexo y fecha 
else if($enfermedad == "" && $sexo != "" && $edadInicio >= "-1" && $edadFin <= "1000")
{
	$canvas=6;
	foreach ($cursorTest as $documentoTest) {
		foreach ($cursorPacientes as $documento) {
			if($documento["Sexo"] == $sexo && $documentoTest['DNIPaciente'] == $documento['DNI']) {
				$anos = substr($documento['Fecha_de_nacimiento'], -4);
				$meses = substr($documento['Fecha_de_nacimiento'], -7, 2);
				$dias = substr($documento['Fecha_de_nacimiento'], 2);
				$edad = $anos * 365 + $meses*30 + $dias;
				#aqui tenemos 19XX
				$fecha_actual_anos=date("Y");
				$fecha_actual_meses=date("m");
				$fecha_actual_dias=date("d");
				$fecha_actual = $fecha_actual_anos * 365 + $fecha_actual_meses*30 + $fecha_actual_dias;
				$edad = $fecha_actual-$edad;
				$edad = $edad / 365;
				if(($edad <= $edadFin) && ($edad >= $edadInicio) )
				{
					array_push($arrayLabels, $documentoTest["Etiqueta"]);
				}
			}
		}
	}

}


#caso enfermedad, sexo y fecha
else if($enfermedad != "" && $sexo != "" && $edadInicio >= "-1" && $edadFin <= "1000")
{
	$canvas=7;
	foreach ($cursorTest as $documentoTest) {
		if($documentoTest["Etiqueta"] == $enfermedad ) {

			foreach ($cursorPacientes as $documento) {
				if($documento["Sexo"] == $sexo ) {
					
					$anos = substr($documento['Fecha_de_nacimiento'], -4);
					$meses = substr($documento['Fecha_de_nacimiento'], -7, 2);
					$dias = substr($documento['Fecha_de_nacimiento'], 2);
					$edad = $anos * 365 + $meses*30 + $dias;
					#aqui tenemos 19XX
					$fecha_actual_anos=date("Y");
					$fecha_actual_meses=date("m");
					$fecha_actual_dias=date("d");
					$fecha_actual = $fecha_actual_anos * 365 + $fecha_actual_meses*30 + $fecha_actual_dias;
					$edad = $fecha_actual-$edad;
					$edad = $edad / 365;

					if($documento['DNI'] == $documentoTest['DNIPaciente'] && ($edad <= $edadFin) && ($edad >= $edadInicio) )
					{
						$contador++;
						if(!in_array($documento['DNI'],$arrayPacientesTriple))
						{
							array_push( $arrayPacientesTriple, $documento['DNI']);
						}
					}

				}
			}		
		}
	}	

}


?>

<!DOCTYPE html>
<html lang="en">
		
	<head>
		<?php include 'links.php';?>
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<link rel="stylesheet" href="/tfg/font-awesome-4.7.0/css/font-awesome.min.css">



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script type="text/javascript" src="dist/Chart.bundle.min.js"></script>


		<!-- solo enfermedad -->
				<script type="text/javascript">
					$(document).ready(function(){
						var randomcolor = function(){
							return '#'+(Math.random().toString(16) + '0000000').slice(2,8);
						}
						var datos = {
							type: "pie",
							data: {
								datasets: [{
									data: [

									 '<?php  echo $countVeinte ?>',
									 '<?php  echo $countTreinta ?>',
									 '<?php  echo $countCuarenta ?>',
									 '<?php  echo $countCincuenta ?>',
									 '<?php  echo $countSesenta ?>',
									 '<?php  echo $countSetenta ?>',
									 '<?php  echo $countOchenta ?>',
									 '<?php  echo $countNoventa ?>',



									],
									backgroundColor: [
											<?php
											for($i=0;$i<8;$i++)
											{
												?>
												randomcolor(),
												<?php
											}
										 ?>
									],
								}],
								labels: [
									"[ < 30 ]",
									"[ 30-40 ]",
									"[ 40-50 ]",
									"[ 50-60 ]",
									"[ 60-70 ]",
									"[ 70-80 ]",
									"[ 80-90 ]",
									"[ 90 + ]",

								]
							},
							options: {
								responsive: true,
							}	
						};
						
						if( document.getElementById('soloEnfermedad') != null)
						{
							var canvas = document.getElementById('soloEnfermedad').getContext('2d');
							window.pie = new Chart(canvas, datos);
						}
					});	
				
				</script> 



		<!-- Solo fecha-->
		<script type="text/javascript">
					$(document).ready(function(){
						var randomcolor = function(){
							return '#'+(Math.random().toString(16) + '0000000').slice(2,8);
						}
						var datos = {
							type: "pie",
							data: {
								datasets: [{
									data: [
									<?php
									$vals = array_count_values($arrayLabels);
									foreach ($vals as $key => $value) {
										
									?>
									 '<?php  echo $value ?>',
									 <?php
									}
									?>

									],
									backgroundColor: [
											<?php
											foreach ($arrayLabels as $hola) 
											{
												?>
												randomcolor(),
												<?php
											}
										 ?>
									],
								}],
								labels: [
									<?php
									$original = array();
											foreach ($arrayLabels as $documentoLabel) {
												if(!in_array($documentoLabel, $original)){
														array_push($original, $documentoLabel);
													}
											}
									foreach ($original as $original2) {
									?>
									 '<?php  echo $original2  ?>',
									 <?php
									}
									?>
								]
							},
							options: {
								responsive: true,
							}	
						};
						
						if( document.getElementById('soloFecha') != null)
						{
							var canvas = document.getElementById('soloFecha').getContext('2d');
							window.pie = new Chart(canvas, datos);
						}
					});	
				
				</script> 

				<!-- solo sexo -->
				<script type="text/javascript">
					$(document).ready(function(){
						var randomcolor = function(){
							return '#'+(Math.random().toString(16) + '0000000').slice(2,8);
						}
						var datos = {
							type: "pie",
							data: {
								datasets: [{
									data: [
									<?php
									$vals = array_count_values($arrayLabels);
									foreach ($vals as $key => $value) {
										
									?>
									 '<?php  echo $value ?>',
									 <?php
									}
									?>

									],
									backgroundColor: [
											<?php
											foreach ($arrayLabels as $hola) 
											{
												?>
												randomcolor(),
												<?php
											}
										 ?>
									],
								}],
								labels: [
									<?php
									$original = array();
											foreach ($arrayLabels as $documentoLabel) {
												if(!in_array($documentoLabel, $original)){
														array_push($original, $documentoLabel);
													}
											}
									foreach ($original as $original2) {

									?>
									 '<?php  echo $original2 ?>',
									 <?php
									}
									?>
								]
							},
							options: {
								responsive: true,
							}	
						};
						
						if( document.getElementById('soloSexo') != null){
							var canvas = document.getElementById('soloSexo').getContext('2d');
							window.pie = new Chart(canvas, datos);
						}
					});	
				
				</script> 



				<!-- fecha-enfermedad -->
				<script type="text/javascript">
					$(document).ready(function(){
						var randomcolor = function(){
							return '#'+(Math.random().toString(16) + '0000000').slice(2,8);
						}
						var datos = {
							type: "pie",
							data: {
								datasets: [{
									data: [

									 '<?php  echo $countMujeres ?>',
									 '<?php  echo $countHombres ?>',



									],
									backgroundColor: [

										randomcolor(), randomcolor(),
	
									],
								}],
								labels: [
									"Mujeres",
									"Hombres",
								]
							},
							options: {
								responsive: true,
							}	
						};
						
						if( document.getElementById('enfermedadFecha') != null){
							var canvas = document.getElementById('enfermedadFecha').getContext('2d');
							window.pie = new Chart(canvas, datos);
						}
					});	
				
				</script> 


				<!-- enfermedad y sexo -->
				<script type="text/javascript">
					$(document).ready(function(){
						var randomcolor = function(){
							return '#'+(Math.random().toString(16) + '0000000').slice(2,8);
						}
						var datos = {
							type: "pie",
							data: {
								datasets: [{
									data: [

									 '<?php  echo $countVeinte ?>',
									 '<?php  echo $countTreinta ?>',
									 '<?php  echo $countCuarenta ?>',
									 '<?php  echo $countCincuenta ?>',
									 '<?php  echo $countSesenta ?>',
									 '<?php  echo $countSetenta ?>',
									 '<?php  echo $countOchenta ?>',
									 '<?php  echo $countNoventa ?>',



									],
									backgroundColor: [
											<?php
											for($i=0;$i<8;$i++)
											{
												?>
												randomcolor(),
												<?php
											}
										 ?>
									],
								}],
								labels: [
									"[ < 30 ]",
									"[ 30-40 ]",
									"[ 40-50 ]",
									"[ 50-60 ]",
									"[ 60-70 ]",
									"[ 70-80 ]",
									"[ 80-90 ]",
									"[ 90 + ]",

								]
							},
							options: {
								responsive: true,
							}	
						};
						
						if( document.getElementById('enfermedadSexo') != null)
						{
							var canvas = document.getElementById('enfermedadSexo').getContext('2d');
							window.pie = new Chart(canvas, datos);
						}
					});	
				
				</script> 

				<!-- fecha y sexo-->
				<script type="text/javascript">
							$(document).ready(function(){
								var randomcolor = function(){
									return '#'+(Math.random().toString(16) + '0000000').slice(2,8);
								}
								var datos = {
									type: "pie",
									data: {
										datasets: [{
											data: [
											<?php
											$vals = array_count_values($arrayLabels);
											foreach ($vals as $key => $value) {
												
											?>
											 '<?php  echo $value ?>',
											 <?php
											}
											?>

											],
											backgroundColor: [
													<?php
													foreach ($arrayLabels as $hola) 
													{
														?>
														randomcolor(),
														<?php
													}
												 ?>
											],
										}],
										labels: [
											<?php
											$original = array();
													foreach ($arrayLabels as $documentoLabel) {
														if(!in_array($documentoLabel, $original)){
																array_push($original, $documentoLabel);
															}
													}
											foreach ($original as $original2) {

											?>
											 '<?php  echo $original2 ?>',
											 <?php
											}
											?>
										]
									},
									options: {
										responsive: true,
									}	
								};
								
								if( document.getElementById('fechaSexo') != null)
								{
									var canvas = document.getElementById('fechaSexo').getContext('2d');
									window.pie = new Chart(canvas, datos);
								}
							});	
						
						</script> 

				
	</head>

	<body>
		<?php include 'navMedico.php';?>
		
		
		<main>
			<div class="container">
			
				<p class="titulo-seccion">> Estadisticas:</p>
		
				<?php echo "Condiciones de búsqueda: <br/>
				
				&nbsp;&nbsp;&nbsp;&nbsp; Enfermedad: <strong>". $enfermedad ." </strong><br/>
				&nbsp;&nbsp;&nbsp;&nbsp; Edad entre: <strong>" ?>  <?php if(($edadInicio != 0) && ($edadInicio != 999)) echo $edadInicio ."</strong> - <strong>". $edadFin ?>  <?php echo "</strong><br/>
				&nbsp;&nbsp;&nbsp;&nbsp; Sexo: <strong>" . $sexo ." </strong><br/>				
				Pacientes que cumplen las condiciones buscadas:  <strong>" . $contador ;?>
				</strong>
				<div id="canvas-container" style="width:35%;"> 
				<?php
				switch ($canvas) {
				    case 1:
				    	echo "<canvas id='soloEnfermedad' height='225' width='300'></canvas>";
				        break;
				    case 2:
				        echo "<canvas id='soloFecha' height='225' width='300'></canvas>";
				        break;
			        case 3:
			        	echo "<canvas id='soloSexo' height='225' width='300'></canvas>";
			       		break;
			       	case 4:
			       		echo "<canvas id='enfermedadFecha' height='225' width='300'></canvas>";
			       		break;
			       	case 5:
			       		echo "<canvas id='enfermedadSexo' height='225' width='300'></canvas>";
			       		break;
			       	case 6:
			       		echo "<canvas id='fechaSexo' height='225' width='300'></canvas>";
			       		break;
			       	case 7:
			       	?>
			       			<div class="container">
								<div class="panel-body">				
									<table class="table table-striped table-bordered table-hover" data-method="POST">
										<thead>
											<tr>
												<th> </th>
												<th>Nombre Paciente</th>
												<th>DNI Paciente</th>
												<th class="btn-peticion">Mas info </th>
											</tr>
										</thead>
										<tbody data-link="row" class="rowlink">
											
											<?php 

											$t=1;
											$conn = new MongoClient();
											$db = $conn->prueba;
											$pat = $db->pacientes;

											foreach ($arrayPacientesTriple as $pacDni) {
												$documento = $pat->findOne(array('DNI'=>$pacDni),array('_id'=>0));
												echo "<form id='form_algo' name='form' action='consultaPaciente.php' method='post'>";
													echo "<tr>";
														echo "<td class='celda'> $t <input type='hidden' name='t' value='$t' > </td>";
														echo "<td class='celda'>" .str_replace('_',' ',ucfirst($documento['Nombre']))." " .str_replace('_',' ',ucfirst($documento['Apellido1'])). " <input type='hidden' name='idPaciente' value=".$documento['DNI']." ></td>";
														echo "<td class= 'celda'>" .str_replace('_',' ',ucfirst($documento['DNI'])). " <input type='hidden' name='DNIPaciente' value=".$documento['DNI']." ></td>";
														echo "<td class='celda btn-peticion'><input type='submit'  name='lupa' id='info' value='&#xf129' class='btn btn-info btn-ancho'></td>";
													echo "</tr>";
												echo "</form>";
												$t = $t+1;	
											}	
					?>
								</div>
							</div>	
					<?php
			       		break;
				}
					?>
				</div>

			</div>		
			
		</main>
		
		
		
		
	
   	
		
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	


	</body>
</html>