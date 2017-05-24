<?php
session_start();
$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;
$coll = $db->usuarios;
$res = $db->peticionAlta;
$var = 'texto';
$t = $_GET['t'];
$var .=$t;
$dniconfirma = $_GET[$var];

$docAlta = $res->findOne(array('DNI'=>$dniconfirma),array('_id' => 0));

$doc = array(
	"DNI"=>$docAlta['DNI'], 
	"Número_de_colegiado"=>$docAlta['Número_de_colegiado'],
	"Apellido_1"=>$docAlta['Apellido_1'],
	"Apellido_2"=>$docAlta['Apellido_2'],
	"Nombre"=>$docAlta['Nombre'],
	"Teléfono"=>$docAlta['Teléfono'],
	"Dirección"=>$docAlta['Dirección'],
	"Especialidad_Médica"=>$docAlta['Especialidad_Médica'],
	"Hospital"=>$docAlta['Hospital'],
	"Tipo" => $docAlta['Tipo'],
	"Contraseña" => $docAlta['Contraseña']
);	

	
$coll->insert($doc);

$aux = $res->remove(array('DNI'=>$dniconfirma));

header("Location: peticion.php");
	
?>