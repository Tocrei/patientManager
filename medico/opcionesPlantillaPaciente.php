<?php
session_start();
error_reporting (0);
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;


$plan = $db->plantilla_paciente;
	

if($_POST['rechaza'])
{
	$res = $plan->remove(array('Campo_1'=>$_POST['nombreRandom']));
	header("Location: consultaPlantillaPaciente.php");
}

if($_POST['info'])
{

	$dni = $_SESSION['dni'];
	$conn = new MongoClient();
	$db = $conn->prueba;

	$coll = $db->usuarios;
	$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
	$pet = $db->plantilla_paciente;

	
	$funciona = array("Campo_1"=>$_POST['nombreRandom'], "Campo_2"=>$dni);
	$vaca = $pet->findOne($funciona, array('_id' => 0));
	$name = str_replace('_',' ',ucfirst($vaca['Campo_1']));
	
?>

	<!DOCTYPE html>
	<html lang="en">
			
		<head>
			<?php include 'links.php';?>
			<script type="text/javascript">
			
				function correcto(){
				
					alert("Registrado");
					
				}
				
			</script>
			
		</head>

		<body>
			<?php include 'navMedico.php';?>

			

		<div class="panel panel-default">
				<div class="container">
				  <div class="panel-heading"><span class="info">Datos de la plantilla del paciente</span></div>
				  <div class="panel-body">
					<form id="form_registrarse" action="consultaPlantillaPaciente.php" method="post" >
							<fieldset>
								<table class="tabla-form" id="datos">	
									<tr>
										<td><label for="plan">Campo 1: </label></td>
										<td>
										<input  class="input-oculto" id="plan" value= "<?php echo $name; ?>" name="Nombre_de_la_plantilla" type="text" readonly="readonly" >
										</td>
									</tr>	
									<tr>
										<td><label for="med">Campo 2: </label></td>
										<td>
										<input class="input-oculto" id="med" value="<?php echo $dni; ?>" name="Médico" type="text"  readonly="readonly">
										</td>
									</tr>						
									<tr >
										<td><label for="ss">Campo 3: </label></td>
										<td>
										<input class="input-oculto" id="ss" value="Nº SS" name="SS" type="text" readonly="readonly">
										</td>
									</tr>								
									<tr>
										<td><label for="apellido1">Campo 4: </label></td>
										<td>
										<input class="input-oculto" id="apellido1" value="Apellido1" name="Apellido_1" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="apellido2">Campo 5: </label></td>
										<td>
										<input class="input-oculto" id="apellido2" value="Apellido2" name="Apellido_2" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="nombre">Campo 6: </label></td>
										<td>
										<input class="input-oculto" id="nombre" value="Nombre" name="Nombre" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="dniPaciente">Campo 7: </label></td>
										<td>
										<input class="input-oculto" id="dniPaciente" value="DNI" name="DNI" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="sexo">Campo 8: </label></td>
										<td>
										<input class="input-oculto" id="sexo" value="Sexo" name="Sexo" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="nac">Campo 9: </label></td>
										<td>
										<input class="input-oculto" id="nac" value="Fecha de nacimiento" name="Fecha de nacimiento" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="direccion">Campo 10: </label></td>
										<td>
										<input class="input-oculto" id="direccion" value="Dirección" name="Dirección" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="poblacion">Campo 11: </label></td>
										<td>
										<input class="input-oculto" id="poblacion" value="Población" name="Poblacion" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="Provincia">Campo 12: </label></td>
										<td>
										<input class="input-oculto" id="provincia" value="Provincia" name="Provincia" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="cp">Campo 13: </label></td>
										<td>
										<input class="input-oculto" id="cp" value="CP" name="CP" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="telefono">Campo 14: </label></td>
										<td>
										<input class="input-oculto" id="telefono" value="Teléfono" name="Teléfono" type="text" readonly="readonly">
										</td>
									</tr>
									<?php
										 //Iniciamos el bucle de las filas
										$numFields = sizeof($vaca) +1;
										for($t=15;$t<$numFields;$t++){
											echo "<tr>";
												echo "<td>";
													$campo = "Campo_$t";
													echo "<label for='".str_replace('_',' ',ucfirst($vaca[$campo]))."' > Campo $t: </label>";
												echo "</td>";
												echo "<td>";
													echo "<input id='".str_replace('_',' ',ucfirst($vaca[$campo]))."' value='".str_replace('_',' ',ucfirst($vaca[$campo]))."' name='".str_replace('_',' ',ucfirst($vaca[$campo]))."' class='input-oculto' readonly='readonly' >";
												echo "</td>";
											echo "</tr>";
										 }
										 
									?>					
								
									<tr>
										<td>
										<input type="submit" class="btn-aceptar-consulta" id="sub" value="Atrás">
										</td>
										<td> </td>
									</tr>

								</table>
							</fieldset>

						</form>
				  </div>
				</div>
			</div>


		    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		 
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	

			<script type="text/javascript">
				
				$(document).ready(function() {

				    var MaxInputs       = 99; 
				    var contenedor       = $("#contenedor"); 
				    var AddButton       = $("#agregarCampo"); 

				    var x = $("#contenedor div").length + 1;
				    var FieldCount = x+14; 

				    $(AddButton).click(function (e) {
				        if(x <= MaxInputs) 
				        {
				            FieldCount++;
				            $(contenedor).append('<div><input type="text" class="campoextra" name="Campo '+ FieldCount +'" id="campo_'+ FieldCount +'" placeholder="Campo adicional"/></div>');
				            x++; 
				        }
						
				        return false;
				    });

				});
			</script>
		 
		</body>
	</html>

<?php

}

if($_POST['modif'])
{


	session_start();

	$dni = $_SESSION['dni'];
	$conn = new MongoClient();
	$db = $conn->prueba;

	$coll = $db->usuarios;
	$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
	$pet = $db->plantilla_paciente;

	
	$funciona = array("Campo_1"=>$_POST['nombreRandom'], "Campo_2"=>$dni);
	$vaca = $pet->findOne($funciona, array('_id' => 0));
	$name = str_replace('_',' ',ucfirst($vaca['Campo_1']));
	
?>

	<!DOCTYPE html>
	<html lang="en">
			
		<head>
			<?php include 'links.php';?>
			<script type="text/javascript">
			
				function correcto(){
				
					alert("Registrado");
					
				}
				
			</script>
			
		</head>

		<body>
			<?php include 'navMedico.php';?>

			

		<div class="panel panel-default">
				<div class="container">
				  <div class="panel-heading"><span class="info">Modifica plantilla de paciente</span></div>
				  <div class="panel-body">
					<form id="form_registrarse" action="insertaPlantillaPacienteMongo.php" method="post" onsubmit="return correcto();")>
							<fieldset>
								<legend>
									Modifique campos (si se queda en blanco se eliminará el campo)
								</legend>
								<table class="tabla-form" id="datos">	
									<tr>
										<td><label for="plan">Campo 1: </label></td>
										<td>
										<input  class="input-oculto" id="plan" value= "<?php echo $name; ?>" name="Nombre_de_la_plantilla" type="text" readonly="readonly" >
										</td>
									</tr>	
									<tr>
										<td><label for="med">Campo 2: </label></td>
										<td>
										<input class="input-oculto" id="med" value="<?php echo $dni; ?>" name="Médico" type="text"  readonly="readonly">
										</td>
									</tr>						
									<tr >
										<td><label for="ss">Campo 3: </label></td>
										<td>
										<input class="input-oculto" id="ss" value="Nº SS" name="SS" type="text" readonly="readonly">
										</td>
									</tr>								
									<tr>
										<td><label for="apellido1">Campo 4: </label></td>
										<td>
										<input class="input-oculto" id="apellido1" value="Apellido1" name="Apellido_1" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="apellido2">Campo 5: </label></td>
										<td>
										<input class="input-oculto" id="apellido2" value="Apellido2" name="Apellido_2" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="nombre">Campo 6: </label></td>
										<td>
										<input class="input-oculto" id="nombre" value="Nombre" name="Nombre" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="dniPaciente">Campo 7: </label></td>
										<td>
										<input class="input-oculto" id="dniPaciente" value="DNI" name="DNI" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="sexo">Campo 8: </label></td>
										<td>
										<input class="input-oculto" id="sexo" value="Sexo" name="Sexo" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="nac">Campo 9: </label></td>
										<td>
										<input class="input-oculto" id="nac" value="Fecha de nacimiento" name="Fecha de nacimiento" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="direccion">Campo 10: </label></td>
										<td>
										<input class="input-oculto" id="direccion" value="Dirección" name="Dirección" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="poblacion">Campo 11: </label></td>
										<td>
										<input class="input-oculto" id="poblacion" value="Población" name="Poblacion" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="Provincia">Campo 12: </label></td>
										<td>
										<input class="input-oculto" id="provincia" value="Provincia" name="Provincia" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="cp">Campo 13: </label></td>
										<td>
										<input class="input-oculto" id="cp" value="CP" name="CP" type="text" readonly="readonly">
										</td>
									</tr>
									<tr>
										<td><label for="telefono">Campo 14: </label></td>
										<td>
										<input class="input-oculto" id="telefono" value="Teléfono" name="Teléfono" type="text" readonly="readonly">
										</td>
									</tr>
									<?php
										 //Iniciamos el bucle de las filas
										$numFields = sizeof($vaca) +1;
										for($t=15;$t<$numFields;$t++){
											echo "<tr>";
												echo "<td>";
													$campo = "Campo_$t";
													echo "<label for='".str_replace('_',' ',ucfirst($vaca[$campo]))."' > Campo $t: </label>";
												echo "</td>";
												echo "<td>";
													echo "<input id='".str_replace('_',' ',ucfirst($vaca[$campo]))."' value='".str_replace('_',' ',ucfirst($vaca[$campo]))."' name='".str_replace('_',' ',ucfirst($vaca[$campo]))."' >";
												echo "</td>";
											echo "</tr>";
										 }
										 
									?>					
									<tr>
										<td>
										<a id="agregarCampo" class="btn btn-info" href="#">+</a>
										</td>
										<td>
											<div id="contenedor">
											    <div class="added">
											    <?php $numFields = sizeof($vaca) +1;
											        echo "<input class='campoextra' type='text' name='Campo $numFields' id='Campo_$numFields' placeholder='Campo adicional'/>";
											        ?>
											    </div>
											</div>
										</td>
									</tr>

								
									<tr>
										<td>
										<input type="submit" class="btn-aceptar-consulta" id="sub" value="Modificar">
										</td>
										<td> </td>
									</tr>

								</table>
							</fieldset>

						</form>
						<form id="form_registrarse" action="consultaPlantillaPaciente.php" method="post" >
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

			<script type="text/javascript">
				
				$(document).ready(function() {

				    var MaxInputs       = 99; 
				    var contenedor       = $("#contenedor"); 
				    var AddButton       = $("#agregarCampo"); 

				    var x = $("#contenedor div").length + 1;
				    var FieldCount = x+14; 

				    $(AddButton).click(function (e) {
				        if(x <= MaxInputs) 
				        {
				            FieldCount++;
				            $(contenedor).append('<div><input type="text" class="campoextra" name="Campo '+ FieldCount +'" id="campo_'+ FieldCount +'" placeholder="Campo adicional"/></div>');
				            x++; 
				        }
						
				        return false;
				    });

				});
			</script>
		 
		</body>
	</html>

<?php
}

?>
