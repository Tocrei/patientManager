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
											echo "<form id='form_algo' name='form' action='modificarDocumentos.php' method='post'>";
												$hey = array_keys($vaca);
												foreach ($hey as $valor){
														if(ucfirst($valor) != "Médico"){
															echo "<tr>";
																echo "<td>";

																	echo "<label class='label-fino' for='nombre'>" .str_replace('_',' ',ucfirst($valor)). " </label>";

																echo "</td>";
																echo "<td>";
																	echo "<input  id='".str_replace('_',' ',$valor)."' value='".str_replace('_',' ', array_shift($vaca))."' name='".str_replace('_',' ',$valor)."' ";
																echo "</td>";
															echo "</tr>";
														}
														else
														{
															//para mantener la integridad del array si no queremos mostrarlo lo quitamos también,
															//esto nos permitira mostar en orden.
															array_shift($res);
														}
												}
												echo "<input class='btn-volver-atras btn-volver-bot2' type='submit' name='DatosPersonales' value='Modificar'/>";
											echo "</form>";
											echo "<form id='form_algo2' name='form2' action='modificarPacientes.php' method='post'>";
											echo "<input class = 'btn-volver-atras btn-volver-bot3' type='submit' name='Submit' value='Volver'/>";
											echo "</form>"
										?>

										</table>
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
														$modifica = "Modifica";
														echo "<li> <a href='muestraTest.php?DNIPaciente=$dniPaciente&Nombre=$name&Modifica=$modifica' >" . $documento["Nombre"] . "</a>";
													}
												}
												?>
											</ul>
										</div>
								</div>

								<form action="modificarDocumentos.php" method="post">
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
										        echo "<input type='checkbox' name='check_list[]' value=$archivo> <a href=' ..//documentos//$dniPaciente//$archivo' target='_blank'>" . $archivo . "</a> <br/>";
										    }
										}
									}
								?>
									<input type="hidden" name="idPaciente" value=<?php echo $dniPaciente;?>>
									<input class="btn-volver-atras btn-volver-bot3 btn-elim" type="submit" name="submit" value="Eliminar"/>
								</form>


								<form action="modificarDocumentos.php" method="post"  enctype='multipart/form-data'>
									<tr>
										<td>
										<input class="find_input" name="imagen" type="file" />
										</td>
										<td> </td>
									</tr>
									<tr>
										<td>
										<input type="hidden" name="idPaciente" value=<?php echo $dniPaciente;?>>
										</td>
										<td> </td>
									</tr>
									<tr>
										<td>
										<input class="btn-volver-atras btn-volver-bot2" type="submit" name="submit" value="Subir"/>
										</td>
										<td> </td>
									</tr>
									
									
								</form>

							</div>
						</div>
					</div>


				</div>
			</div>


		</main>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

	</body>
</html>
