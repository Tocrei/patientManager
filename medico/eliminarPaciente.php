<?php
	
$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;




$dniPaciente = $_POST['idPaciente'];
$fua = $db->pacientes;
$vaca = $fua->findOne(array('DNI'=>$dniPaciente),array('_id' => 0));

$otro = $fua->remove(array('DNI'=>$dniPaciente));



if (file_exists("..//documentos//" . $dniPaciente . "//" )) {
	eliminarDir("..//documentos//" . $dniPaciente . "//" );
}


$unomas = $db->tests;
$cursor = $unomas->find();
$cursor = $unomas->remove(array('DNIPaciente'=>$dniPaciente), array('DNIMedico'=>$dni));



function eliminarDir($carpeta)
{
	foreach(glob($carpeta . '/*') as $archivos_carpeta)
	{
		if (is_dir($archivos_carpeta))
			eliminarDir($archivos_carpeta);
		else
			unlink($archivos_carpeta);
	} 
	rmdir($carpeta);
}

header("Location: eliminarPacientes.php");
	
	
?>