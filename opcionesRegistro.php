<?php
session_start();
error_reporting (0);
$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;
$coll = $db->usuarios;
$res = $db->peticionAlta;
$var = 'texto';
$t = $_GET['t'];
$var .=$t;
$dniconfirma = $_GET[$var];

if($_GET['confirma'])
{
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
	mkdir("imagenesPerfil//" . $docAlta['DNI'] . "//", 0777);
	header("Location: peticion.php");
}
if($_GET['rechaza'])
{
	$aux = $res->remove(array('DNI'=>$dniconfirma));
	header("Location: peticion.php");
}

$res2 = $res->findOne(array('DNI'=>$dniconfirma),array('_id'=>0));
$numFields = sizeof($res2);
	
$pet = $db->peticionAlta;	
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
		
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
				
					<table class="table-cebreada"  id="datos">
								
						<tr >
							<td>
								
							<?php
								 //Iniciamos el bucle de las filas
								$hey = array_keys($res2);
								foreach ($hey as $valor){
									echo "<tr>";
										echo "<td>";
											echo "<label class='label-grueso' for='nombre'>" .str_replace('_',' ',ucfirst( $valor ) ). " </label>";
										echo "</td>";
										echo "<td>";
											echo "<label  class='label-fino'>" .array_shift($res2). " </label>";
										echo "</td>";
									echo "</tr>";
								 }
								 
							?>							
							</td>
						</tr>
						
					</table>
							<a href="peticion.php" class="btn-volver-atras">Volver atrás</a>

				</div>
			</div>
		</div> 
		 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	
	
	</body>
</html>