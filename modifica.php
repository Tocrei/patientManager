<?php
	
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
	
	
$dni = $_POST["DNI"];
$numCol = $_POST["Número_de_colegiado"];
$apellido1 = $_POST["Apellido_1"];
$apellido2 = $_POST["Apellido_2"];
$nombre = $_POST["Nombre"];
$telefono = $_POST["Teléfono"];
$direccion = $_POST["Dirección"];
$espemedica = $_POST["Especialidad_Médica"];
$hospital = $_POST["Hospital"];


	
$doc = array(
	"DNI"=>$dni, 
	"Número_de_colegiado"=>$numCol,
	"Apellido_1"=>$apellido1,
	"Apellido_2"=>$apellido2,
	"Nombre"=>$nombre,
	"Teléfono"=>$telefono,
	"Dirección"=>$direccion,
	"Especialidad_Médica"=>$espemedica,
	"Hospital"=>$hospital
);	
	
$nuevosdatos = array('$set'=>$doc);
$coll->update(array("DNI"=>$dni),$nuevosdatos);


header("Location: index.php");
	
	
?>