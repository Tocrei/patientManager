<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
$Tipo = $res['Tipo'];

$dniPaciente = $_POST['idPaciente'];
$fua = $db->pacientes;
$vaca = $fua->findOne(array('DNI'=>$dniPaciente),array('_id' => 0));

$numFields3 = sizeof($vaca);

if($numFields3 == 0)
{
	header("Location: indexMedico.php");
}


$unomas = $db->tests;
$cursor = $unomas->find();

$t=1;
?>

<!DOCTYPE html>
<html lang="en">
		
	<head>
		<?php include 'links.php';?>
		
	</head>

	<body>
		<?php include 'navMedico.php';?>
		
		
		<main>
			<div class="container">
			
				<p class="titulo-seccion">> PACIENTES:</p>
			
				<div class="row">
				
					<div class="col-sm-12 col-md-6">						
							<div class="panel panel-info">
								<div class="panel-heading">Datos: </div>
								<div class="panel-body">
									<table class="table table-striped table-bordered table-hover" data-method="POST">

										<?php 
											for($t=0;$t<$numFields3;$t++) {
												if(ucfirst(array_keys($vaca)[$t]) != "Médico"){
													echo "<tr>";
														echo "<td>";

															echo "<label class='label-fino' for='nombre'>" .str_replace('_',' ',ucfirst(array_keys($vaca)[$t])). " </label>";
														
														echo "</td>";
														echo "<td>";
															echo "<input  id='".str_replace('_',' ',$vaca[array_keys($vaca)[$t]])."' value='".str_replace('_',' ',$vaca[array_keys($vaca)[$t]])."' name='".ucfirst(array_keys($vaca)[$t])."' readonly>";
														echo "</td>";
													echo "</tr>";
												}
											}
											echo "<form id='form_algo' name='form' action='listaPacientes.php' method='post'>";	
											echo "<input class='btn-volver-atras btn-volver-bot' type='submit' name='Submit' value='Volver'/>";
											echo "</form>";
										?>
										</table>
										<?php 
											echo "<form id='form_pdf' name='pdf' action='consultaPacientePdf.php' target='_blank' method='post'> ";	
											echo "<input  type='hidden' name='idPaciente' value='" .$dniPaciente ."' />";
											echo "<input class='boton_pdf' type='submit' name='pdf' title='Descargar PDF' value='' />";
											echo "</form>"
										?>
								</div>
							</div>
					</div>
					<div class="col-sm-12 col-md-6">
						<div class="panel panel-info">
							<div class="panel-heading">Adjuntos: </div>
							<div class="panel-body">
								
								<div class="row">
										<div class="lista_test">
											<span>Test.</span>
											<ul>
												<?php 
												
												foreach ($cursor as $documento) {
													if($documento['DNIPaciente'] == $dniPaciente  and $documento["DNIMedico"] == $dni ) {
														$name = $documento["Nombre"];
														echo "<li> <a href='muestraTest.php?DNIPaciente=$dniPaciente&Nombre=$name' >" . $documento["Nombre"] . "</a>";
													}
												}	
												?>
											</ul>
										</div>
								</div>
								<div class="row">
										<div class="lista_documentos">
											<span>Documentos. </span>	
											<ul>										
												<?php

												if (file_exists("..//documentos//" . $dniPaciente . "//" )) {
													$directorio = opendir("..//documentos//" . $dniPaciente . "//" ); //ruta actual
													while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
													{
													    if (is_dir($archivo))//verificamos si es o no un directorio
													    {
													         //de ser un directorio lo envolvemos entre corchetes
													    }
													    else
													    {
													        echo "<li> <a href=' ..//documentos//$dniPaciente//$archivo' target='_blank'>" . $archivo . "</a>";
													    }
													}
												}
												?>
											</ul>

											<form action="descargarZip.php" method="post">
												<input type="hidden" name="idPaciente" value=<?php echo $dniPaciente;?>>
												<input class="btn-back" type="submit" name="Submit" value="Zip"/>
											</form>	
										</div>
								</div>
							</div>
						</div>
					</div>								
				
				
				</div>
			</div>
			
			
		</main>
		
		
		
		
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   	
		
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	</body>
</html>
