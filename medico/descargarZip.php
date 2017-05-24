<?php
	session_start();
	$dni = $_SESSION['dni'];

$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;
	if(isset($_POST['idPaciente'])){
		$dniPaciente = $_POST['idPaciente'];

		$zip = new ZipArchive();
				
		if (file_exists("..//documentos//" . $dniPaciente . "//" )) {

			$filename = "..//documentos//" . $dniPaciente . "//" . $dniPaciente . ".zip";
			if($zip->open($filename,ZIPARCHIVE::CREATE)===true) {
				$directorio = opendir("..//documentos//" . $dniPaciente . "//" ); //ruta actual
				while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
				{
				    if (is_dir($archivo))//verificamos si es o no un directorio
				    {
				         //de ser un directorio lo envolvemos entre corchetes
				    }
				    else
				    {			    	
				        $zip->addFile("..//documentos//$dniPaciente//$archivo", "$archivo");
				        					 
				    }
				}
				$zip->close();
			}

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
		<div class="container">

			<span>Zip creado en la carpeta del paciente (<?php echo $dniPaciente; ?>):  </span>
			<form action="consultaPaciente.php" method="post">
				<input type="hidden" name="idPaciente" value=<?php echo $dniPaciente;?>>
				<input class="btn-back" type="submit" name="Submit" value="Volver"/>
			</form>
		</div>
	</body>

</html>

