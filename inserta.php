<?php
	
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
	
	$dni = $_POST['dni'];
	
	$res = $coll->findOne(array('DNI'=>$dni),array('_id'=>0));
if($res != null)
	header("Location: formularioinserta.php");
else{


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
	mkdir("imagenesPerfil//" . $_POST['dni'] . "//", 0777);

	header("Location: index.php");


}
	
?>