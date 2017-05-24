	<?php 
	session_start();
	$idioma = $_GET['idioma'];
	$_SESSION['lang'] = $idioma;

	header("Location: indexMedico.php");

	?>