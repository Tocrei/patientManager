<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll2 = $db->tests;
$DNIPaciente = $_GET['DNIPaciente'];
$Nombre = $_GET['Nombre'];
$res2 = $coll2->findOne(array('Nombre'=>$Nombre, 'DNIPaciente'=>$DNIPaciente, 'DNIMedico'=>$dni),array('_id' => 0));

$numFields2 = sizeof($res2);
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
			  <div class="panel-heading"><span class="alta">Test</span></div>
			  <div class="panel-body">
			  <?php 
			   $dolar = "consultaPaciente.php";
			  if(isset($_GET['Modifica'])){
			  	$dolar = "modificarPaciente.php";
			  }
				echo "<form id='form_registrarse' action=$dolar method='post' )>";
				?>
						<fieldset>
							<legend>
								Test: <?php echo $res2['Nombre'];?>
							</legend>
							<table class="tabla-form" id="datos">								
							<?php 
							for($t=0;$t<$numFields2;$t++) {
								if(str_replace('_',' ',ucfirst(array_keys($res2)[$t])) != "Etiqueta"){


									echo "<tr>";
										echo "<td>";
											echo "<label class='label-fino' for='nombre'>" .str_replace('_',' ',ucfirst(array_keys($res2)[$t])). " </label>";
										echo "</td>";
										echo "<td>";
											if(isset($_GET['Modifica'])){
											echo "<input id='".str_replace('_',' ',$res2[array_keys($res2)[$t]])."' value='".str_replace('_',' ',$res2[array_keys($res2)[$t]])."' name='".ucfirst(array_keys($res2)[$t])."'>";
											}
											else
											{
												echo "<input id='".str_replace('_',' ',$res2[array_keys($res2)[$t]])."' value='".str_replace('_',' ',$res2[array_keys($res2)[$t]])."' name='".ucfirst(array_keys($res2)[$t])."' readonly>";
											}
										echo "</td>";
									echo "</tr>";
								}
							}	
							?>
							<input type="hidden" name="idPaciente" value=<?php echo $DNIPaciente; ?> >

								<tr>
									<td>
									<input type="submit" class="btn-aceptar" id="sub" value="Atrás">
									</td>

									
									
								</tr>

							</table>
						</fieldset>

					</form>
					<?php 
					if(isset($_GET['Modifica'])){
															
							echo "<form class='form-rel' action='modificarDocumentos.php' method='post'>";
								echo "<input type='hidden' name='idPaciente' value=$DNIPaciente >";
								echo "<input type='hidden' name='nameTest' value=".$res2['Nombre']." >";
								echo "<input class='btn-elim btn-elim2' type='submit' name='Test' value='Eliminar' >";
							echo "</form>"; 
						
					}
					?>
			  </div>
			</div>
		</div>


	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	   	

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	</body>
</html>