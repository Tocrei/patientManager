<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		
		<script type="text/javascript">
		
			function espera(){
			
				alert("Petición realizada, a la espera de confirmación.");
				
			}
			
		</script>
		
		<title> Alta </title>
	</head>
<?php 

$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->peticionAlta;
	


$dni = $_POST['dni'];
$numCol = $_POST['numCol'];
$apellido1 = $_POST['apellido1'];
$apellido2 = $_POST['apellido2'];
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$direccion = $_POST['direccion'];
$espemedica = $_POST['espemedica'];
$hospital = $_POST['hospital'];
$password = $_POST['password'];
$tipo = '1';
	
$doc = array(
	"DNI"=>$dni, 
	"Número_de_colegiado"=>$numCol,
	"Apellido_1"=>$apellido1,
	"Apellido_2"=>$apellido2,
	"Nombre"=>$nombre,
	"Teléfono"=>$telefono,
	"Dirección"=>$direccion,
	"Especialidad_Médica"=>$espemedica,
	"Hospital"=>$hospital,
	"Tipo" => $tipo,
	"Contraseña" => $password
);	
	
$coll->insert($doc);

	//espera();
	header('Location: login.php');

?>
</html>