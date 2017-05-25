<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
$Tipo = $res['Tipo'];
$pet = $db->peticionAlta;
$numPeticiones = $pet->count();
$cursor = $pet->find();
?>

<!DOCTYPE html>
<html lang="en">
		
	<head>
		<meta charset="utf-8" />

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<link rel="stylesheet" href="/font-awesome-4.7.0/css/font-awesome.min.css">
		
		<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
		
		<title>Inicio</title>
		
		
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
							echo $numPeticiones;
						?></span></a></li>
					 </ul>			 
					 
					</div>
				  </div>
				</nav>
			</div>			
		</header>	
		<div class="container">
			<div class="panel-heading"><span class="info">Peticiones pendientes</span></div>
				<div class="panel-body">
				
					<table class="table table-striped table-bordered table-hover" data-method="POST">
						<thead>
							<tr>
								<th> </th>
								<th>Nombre</th>
								<th>Primer Apellido</th>
								<th>Segundo Apellido</th>
								<th>DNI</th>
								<th>Num colegiado</th>
								<th class="btn-peticion">Confirmar</th>
								<th class="btn-peticion">Mas info </th>
								<th class="btn-peticion">Rechazar</th>
							</tr>
						</thead>
						<tbody data-link="row" class="rowlink">
							
								<?php 
								$t=1;

								foreach ($cursor as $documento) {
									echo "<form id='form_algo' name='form' action='opcionesRegistro.php' method='get'>";
										echo "<tr>";
											echo "<td class='celda'> $t <input type='hidden' name='t' value='$t' > </td>";
											echo "<td class='celda'>" .$documento['Nombre']. "</td>";
											echo "<td class='celda'>" .$documento['Apellido_1']. "</td>";
											echo "<td class='celda'>" .$documento['Apellido_2']. "</td>";
											echo "<td class='celda'>" .$documento['DNI']. "<input type='hidden' name='texto$t' value='" .$documento['DNI']. "' /> </td>";
											echo "<td class='celda'>" .$documento['Número_de_colegiado']. "</td>";
											echo "<td class='celda btn-peticion'><input type='submit' name='confirma' id='confirma' value='&#xf00c' class='btn btn-success btn-ancho' > </td>";
											echo "<td class='celda btn-peticion'><input type='submit'  name='info' id='info' value='&#xf129' class='btn btn-info btn-ancho'></td>";
											echo "<td class='celda btn-peticion'><input type='submit' name='rechaza'  id='rechaza' value='&#xf00d' class='btn btn-danger btn-ancho'  > </td>";
										echo "</tr>";
									echo "</form>";
									$t = $t+1;	
								}	
								?>
								

				</div>
			</div>	

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	</body>
</html>
