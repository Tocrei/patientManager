<?php
session_start();

$dni = $_SESSION['dni'];

	
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
	
$res = $coll->findOne(array('DNI'=>$dni),array('_id'=>0));

$numFields = sizeof($res);

function cargaimagen()
{

	$conn = new MongoClient();
	$dni = $_SESSION['dni'];
    $db = $conn->prueba;
    $collection = $db->foto_perfil;
    $cursor = $collection->findOne(array('idMedico'=>$dni),array('_id'=>0));

    if($cursor != "")
    {
    	$resultado = $cursor['imagename'];
		$resultado = "..//imagenesPerfil//" . $dni . "//" . $resultado;
    	return $resultado;
	}
	else{
		$resultado = "..//imagenDefecto//imagenDefault.jpg";
		return $resultado;
	}

}
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
				<div class="fotoContainer" >
					 <?php echo "<img src= " . cargaimagen() . ">"; ?>
				</div>
				<div class="panel-heading"><span class="info">Datos Personales</span></div>
				<div class="panel-body">
				
					<table class="table-cebreada" id="datos">
								
						<tr >
							<td>
								
							<?php
								 //Iniciamos el bucle de las filas
								for($t=0;$t<$numFields;$t++){
									echo "<tr>";
										echo "<td>";
										if(ucfirst(array_keys($res)[$t]) != "Tipo" && ucfirst(array_keys($res)[$t]) != "Contraseña"  )
										{
											echo "<label class='label-grueso' for='nombre'>" .str_replace('_',' ',ucfirst(array_keys($res)[$t])). " </label>";
										
										echo "</td>";
										echo "<td>";
											echo "<label class='label-fino'>" .$res[array_keys($res)[$t]]. " </label>";
										echo "</td>";
										}
									echo "</tr>";
								 }								 
							?>							
							</td>
						</tr>
					</table>
					<a class="btn-volver-atras" href="/medico/modificaDatosPersonales.php">Modificar datos</a>
				</div>
			</div>
		</div> 


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	
	
	</body>
</html>