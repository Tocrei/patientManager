

<?php

session_start();

$dni = $_SESSION['dni'];

	
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
	
$res = $coll->findOne(array('DNI'=>$dni),array('_id'=>0));

$numFields = sizeof($res);

?>

<!DOCTYPE html>
<html lang="en">
	<head>	
		<?php include 'links.php';?>		
	</head>

	<body>	
		<?php include 'navMedico.php';?>

		<div class="container">
		
		
			<div class="registro">
						
					
				<table class="datos">
					
				<form id='form_algo' name='form' action='modificaPerfil.php' method='post' enctype='multipart/form-data'>	
				<?php 
				$numFields = sizeof($res);
				for($t=0;$t<$numFields;$t++) {
					echo "<tr>";
						echo "<td>";
							$campo = "Campo_$t";
							echo "<label class='label-fino' for='nombre'>" .str_replace('_',' ',ucfirst(array_keys($res)[$t])). " </label>";
						echo "</td>";
						echo "<td>";
							echo "<input id='".str_replace('_',' ',$res[array_keys($res)[$t]])."' value='".str_replace('_',' ',$res[array_keys($res)[$t]])."' name='".ucfirst(array_keys($res)[$t])."' >";
						echo "</td>";
					echo "</tr>";
				}	
				?>
				
					<tr>
						<td>
						<input class="find_input" name="imagen" type="file" />
						</td>
						<td> </td>
					</tr>
					
					
					<tr>
						<td>
						<input type="submit" class="btn-log" id="sub" value="Modificar" name="submit">
						</td>
						<td> </td>
					</tr>

					</form>

				</table>
						
						

				
				<a href="consultaPerfil.php"> <span class="btn-volver-atras">Volver atrás</span></a>

			</div>			
			
		</div>


	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   	

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	
	
	</body>
</html>