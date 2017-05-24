
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
		
	<form action="subir_archivo.php" method="post" enctype="multipart/form-data">
	  <label for="archivo">Archivo:</label>
	  <input type="file" name="archivo" id="archivo" />
	  <br/>
	  <input type="submit" value="Enviar" />
	</form>

</html>
