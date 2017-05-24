<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$pet = $db->peticionAlta;

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
		
		<title> Consulta </title>
		
	</head>

	<body>
	
		<header class="navbar-inverse navbar-fixed-top" role="banner">
			<div class="container">

				<nav role="navigation">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="index.php">Inicio</a>
						</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Acciones <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="formularioinserta.php">Insertar</a></li>
									<li><a href="formularioborrado.php">Eliminar</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="formularioconsulta.php">Consultar</a></li>
									<li><a href="formulariomod.php">Modificar</a></li>		
								</ul>
							</li>
							<li role="presentation"><a href="peticion.php">Peticiones <span class="badge">
							<?php 
								echo $pet->count();
							?></span></a></li>
						</ul>
					  
					</div>
				  </div>
				</nav>
			</div>	
		</header>	
		
		<div class="panel panel-default">
			<div class="container">
			
				<div class="panel-heading"><span class="info">Consulta de datos</span></div>
				<div class="panel-body">
	
					<form id="form_registrarse" action="consulta.php" method="post">
						<fieldset>
							<legend>
								Indroduce DNI
							</legend>
							<table class="tabla-form" id="datos">
								
								<tr >
									<td><label for="dni">DNI</label></td>
									<td>
									<input  id="dni" name="dni" type="text" required>
									</td>
								</tr>
	
								<tr>
									<td>
									<input type="submit" class="btn-aceptar-consulta" id="sub" value="Consultar" >
									</td>
									<td> </td>
								</tr>

							</table>
						</fieldset>

					</form>
				</div>
			</div>
		</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	
	
	</body>
</html>
