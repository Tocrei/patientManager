<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;
$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
$Tipo = $res['Tipo'];
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
		  <div class="panel-heading"><span class="alta">Formulario de alta paciente</span></div>
		  <div class="panel-body">
			<form id="form_registrarse" action="insertaPaciente.php" method="post" onsubmit="return correcto();")>
					<fieldset>
						<legend>
							Introduce los datos:
						</legend>
						<table class="tabla-form" id="datos">		
							<tr>
								<td><label for="med">Medico Responsable</label></td>
								<td>
								<input class="dni_no_mod" id="med" name="Médico" type="text" value=<?php echo $dni ;?> readonly>
								</td>
							</tr>						
							<tr >
								<td><label for="ss">Nº SS</label></td>
								<td>
								<input  id="ss" name="SS" type="text" required>
								</td>
							</tr>								
							<tr>
								<td><label for="apellido1">Apellido1</label></td>
								<td>
								<input id="apellido1" name="Apellido1" type="text" required>
								</td>
							</tr>
							<tr>
								<td><label for="apellido2">Apellido2</label></td>
								<td>
								<input id="apellido2" name="Apellido2" type="text" required>
								</td>
							</tr>
							<tr>
								<td><label for="nombre">Nombre</label></td>
								<td>
								<input id="nombre" name="Nombre" type="text" required>
								</td>
							</tr>
							<tr>
								<td><label for="dniPaciente">DNI</label></td>
								<td>
								<input id="dniPaciente" name="DNI" type="text" required>
								</td>
							</tr>
							<tr>
								<td><label for="sexo">Sexo</label></td>
								<td>
								<input id="sexo" name="Sexo" type="text" placeholder="H/M" required>
								</td>
							</tr>
							<tr>
								<td><label for="nac">Fecha de nacimiento</label></td>
								<td>
								<input id="nac" name="Fecha de nacimiento" type="text" placeholder="dd/mm/aaaa"required>
								</td>
							</tr>
							<tr>
								<td><label for="direccion">Dirección</label></td>
								<td>
								<input id="direccion" name="Dirección" type="text" required>
								</td>
							</tr>
							<tr>
								<td><label for="poblacion">Población</label></td>
								<td>
								<input id="poblacion" name="Poblacion" type="text" required>
								</td>
							</tr>
							<tr>
								<td><label for="Provincia">Provincia</label></td>
								<td>
								<input id="provincia" name="Provincia" type="text" required>
								</td>
							</tr>
							<tr>
								<td><label for="cp">CP</label></td>
								<td>
								<input id="cp" name="CP" type="text" required>
								</td>
							</tr>
							<tr>
								<td><label for="telefono">Teléfono</label></td>
								<td>
								<input id="telefono" name="Teléfono" type="text" required>
								</td>
							</tr>
							

						
							<tr>
								<td>
								<input type="submit" class="btn-aceptar" id="sub" value="Dar de alta">
								</td>
								<td> </td>
							</tr>

						</table>
					</fieldset>

				</form>
				<form id="form_registrarse" action="indexMedico.php" method="post" >
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