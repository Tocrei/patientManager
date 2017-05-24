<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
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
			  <div class="panel-heading"><span class="alta">Nueva plantilla de paciente</span></div>
			  <div class="panel-body">
				<form id="form_registrarse" action="insertaPlantillaPacienteMongo.php" method="post" onsubmit="return correcto();")>
						<fieldset>
							<legend>
								Agregue campos a su gusto:
							</legend>
							<table class="tabla-form" id="datos">	
								<tr>
									<td><label for="plan">Campo 1: </label></td>
									<td>
									<input  id="plan" placeholder="Nombre de la plantilla" name="Nombre_de_la_plantilla" type="text" >
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
								<tr>
									<td>
									<a id="agregarCampo" class="btn btn-info" href="#">+</a>
									</td>
									<td>
										<div id="contenedor">
										    <div class="added">
										        <input class="campoextra" type="text" name="Campo_15" id="campo_15" placeholder="Campo adicional"/>
										    </div>
										</div>
									</td>
								</tr>

							
								<tr>
									<td>
									<input type="submit" class="btn-aceptar" id="sub" value="Insertar">
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
			    var FieldCount = x+13; 

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