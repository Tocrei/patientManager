
<?php
session_start();

$dni = $_SESSION['dni'];

if (isset($_FILES["imagen"]["name"]) && !empty($_FILES["imagen"]["name"]) )
{
	$target_dir = "..//imagenesPerfil//" . $dni . "//";
	$target_file = $target_dir . basename($_FILES["imagen"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["imagen"]["tmp_name"]);
	    if($check !== false) {
	        echo "File is an image - " . $check["mime"] . ".";
	        $uploadOk = 1;
	    } else {
	        echo "File is not an image.";
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["imagen"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["imagen"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["imagen"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }

	}
}



$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;
$coll = $db->usuarios;

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



if (isset($_FILES["imagen"]["name"])  && !empty($_FILES["imagen"]["name"]) )
{
 

	$res = $db->foto_perfil;

	$cursor = $res->findOne(array('idMedico'=>$dni),array('_id'=>0));
	$vaca = array(
		"idMedico"=>$dni,
		"imagename"=>basename($_FILES["imagen"]["name"])
	);

	$nuevafoto = array('$set'=>$vaca);
	if($cursor != "")
	{		
		$res->update(array("idMedico"=>$dni),$nuevafoto);
	}
	else
	{
		$res->insert($vaca);
	}

}

    header("Location: consultaPerfil.php");

		
?>