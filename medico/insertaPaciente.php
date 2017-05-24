<?php
	
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$pac = $db->pacientes;

$doc = array();	
foreach($_POST as $nombre_campo => $valor){ 
   $doc[$nombre_campo] = $valor;
}
		
$pac->insert($doc);
	
mkdir("..//documentos//" . $_POST['DNI'] . "//", 0777);
header("Location: indexMedico.php");

	
?>