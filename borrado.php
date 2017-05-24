<?php
	
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
	
	

$dni = $_POST['dni'];
	
$res = $coll->remove(array('DNI'=>$dni));


header("Location: formularioborrado.php");
	
	
?>