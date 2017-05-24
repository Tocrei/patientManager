<?php
session_start();


$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
	
$dni = $_POST['dni'];
$pass = $_POST['password'];
$res = $coll->findOne(array('DNI'=>$dni),array('Contraseña', 'Tipo'));


 if($res == NULL){

		echo '<script type="text/javascript">';
		echo 'alert("Usuario o contraseña incorrectos");';
		echo '</script>';
		header( "Refresh:0; url=http://localhost/tfg/login.php", true, 303);

}else{
		if( $pass == $res['Contraseña']){
			$_SESSION['dni'] = $dni;
			$_SESSION['lang'] = 'es';
			if($res['Tipo'] == '0'){
				header('Location: index.php');
			}
			else{
				header('Location: /tfg/medico/indexMedico.php');
			}
			
		}else{
			echo '<script type="text/javascript">';
			echo 'alert("Usuario o contraseña incorrectos");';
			echo '</script>';
			header( "Refresh:0; url=login.php", true, 303);
		}

	}


?>
