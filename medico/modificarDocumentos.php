
<?php
	session_start();
$dni = $_SESSION['dni'];

$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

	if(isset($_POST['idPaciente']))
		$dniPaciente = $_POST['idPaciente'];

	if(isset($_POST['DNI']))
		$dniPaciente = $_POST['DNI'];

	if(isset($_POST['nameTest']))
		$nameTest = $_POST['nameTest'];

?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<?php include 'links.php';?>

	</head>

	<body>
		<?php include 'navMedico.php';?>
		<div class="container">
<?php


	if(isset($_POST['submit'])){
		if(!empty($_POST['check_list'])){

			foreach($_POST['check_list'] as $selected){
				echo "El fichero   ".$selected."   ha sido eliminado </br>";
				unlink("..//documentos//$dniPaciente//$selected");

			}
			
		}
		else{
				echo "Ningún archivo ha sido seleccionado para eliminar </br>";
				echo "</br>";
			}
		

		if (isset($_FILES["imagen"]["name"]) && !empty($_FILES["imagen"]["name"]) )
		{
			$target_dir = "..//documentos//" . $dniPaciente . "//";
			$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
			}

			if ($_FILES["imagen"]["size"] > 50000000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
			}

			if($imageFileType != "pdf" ) {
			echo "Sorry, only PDF files are allowed.";
			$uploadOk = 0;
			}
			if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
			} else {
			if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
				echo "El fichero ". basename( $_FILES["imagen"]["name"]). " ha sido subido.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}

			}
		}
	}

	if(isset($_POST['Test'])){
		$unomas = $db->tests;
		$cursor = $unomas->find();
		$cursor = $unomas->remove( array('Nombre'=>$nameTest), array('DNIPaciente'=>$dniPaciente));
		echo "Test eliminado";
	}

	if(isset($_POST['DatosPersonales'])){
		////
		$pac = $db->pacientes;
		$doc = array();
		foreach($_POST as $nombre_campo => $valor){
		   $doc[$nombre_campo] = $valor;
		}
		$nuevosdatos = array('$set'=>$doc);
		$pac->update(array("DNI"=>$dniPaciente),$nuevosdatos);
		header("Location: modificarPacientes.php");
	}


?>

		<form action="modificarPaciente.php" method="post">
			<input type="hidden" name="idPaciente" value=<?php echo $dniPaciente;?>>
			<input class="btn-back" type="submit" name="Submit" value="Volver"/>
		</form>
		
	</div>
</body>

</html>
