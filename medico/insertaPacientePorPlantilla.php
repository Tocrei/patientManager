<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$var = 'texto';
$t = $_GET['t'];
$var .=$t;
$nombreplantilla = $_GET[$var];

$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
$pet = $db->plantilla_paciente;


$funciona = array("Campo_1"=>$nombreplantilla, "Campo_2"=>$dni);
$vaca = $pet->findOne($funciona, array('_id' => 0));

?>
<!DOCTYPE html>
<html lang="en">
		
	<head>
		<?php include 'links.php';?>		
	</head>

	<body>
		<?php include 'navMedico.php';?>

		<div class="panel panel-default">
			<div class="container">
			  <div class="panel-heading"><span class="alta">Formulario de alta paciente</span></div>
			  <div class="panel-body">
				<form id="form_registrarse" action="insertaPaciente.php" method="post" onsubmit="return correcto();")>
						<fieldset>
							<legend>
								Plantilla elegida de tipo: <?php echo $vaca['Campo_1']?>
								Introduce los datos:
							</legend>
							<table class="tabla-form" id="datos">		
								<tr>
									<td><label for="med">Medico Responsable</label></td>
									<td>
									<input id="med" name="Médico" type="text" value=<?php echo $dni ;?> >
									</td>
								</tr>						
								<?php
										 //Iniciamos el bucle de las filas
										$numFields = sizeof($vaca) +1;
										for($t=3;$t<$numFields;$t++){
											echo "<tr>";
												echo "<td>";
													$campo = "Campo_$t";
													echo "<label for='".str_replace('_',' ',ucfirst($vaca[$campo]))."' > ".str_replace('_',' ',ucfirst($vaca[$campo]))." </label>";
												echo "</td>";
												echo "<td>";
												if (str_replace('_',' ',ucfirst($vaca[$campo])) == "Sexo"){
													echo "<input id='".str_replace('_',' ',ucfirst($vaca[$campo]))."' name='".str_replace('_',' ',ucfirst($vaca[$campo]))."'  placeholder='H/M' >";
												}elseif (str_replace('_',' ',ucfirst($vaca[$campo])) == "Fecha de nacimiento") {
													echo "<input id='".str_replace('_',' ',ucfirst($vaca[$campo]))."' name='".str_replace('_',' ',ucfirst($vaca[$campo]))."'  placeholder='dd/mm/aaaa' >";
												}
												else{
													echo "<input id='".str_replace('_',' ',ucfirst($vaca[$campo]))."' name='".str_replace('_',' ',ucfirst($vaca[$campo]))."' >";
												}

													
												echo "</td>";
											echo "</tr>";
										 }
										 
								?>			

								<tr>
									<td>
									<input type="submit" class="btn-aceptar" id="sub" value="Dar de alta">
									</td>
									<td> </td>
								</tr>

							</table>
						</fieldset>

					</form>
					<form id="form_registrarse" action="insertarPorPlantilla.php" method="post" >
							<tr>
								<td>
								<input type="submit" class="btn-aceptar-consulta" id="sub" value="Atrás">
								</td>
								<td> </td>
							</tr>
					</form>

			  </div>
			</div>
		</div>

	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	   	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	</body>
</html>