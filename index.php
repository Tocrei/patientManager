<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
$Tipo = $res['Tipo'];
$pet = $db->peticionAlta;

?>

<!DOCTYPE html>
<html lang="en">
		
	<head>
		<meta charset="utf-8" />

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		
		<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
		
		<title>Inicio</title>
		
	</head>

	<body>
		<header class="navbar-inverse navbar-fixed-top" role="banner">
			<div class="container">

				<nav  role="navigation">
				  <div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
					  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					  </button>
					  <a class="navbar-brand" href="index.php">Inicio</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
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
						<a class="navbar-brand navbar-right" href="logout.php">Log Out</a>					 
					 
					</div><!-- /.navbar-collapse -->
				  </div><!-- /.container-fluid -->
				</nav>
			</div>	
		</header>	
		
		<main>
			<div class="container">
				<div class="row">
				
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="formularioinserta.php" class="panel-enlace-alta">
							<div class="panel panel-success">
								<div class="panel-heading">Dar de alta un médico</div>
								<div class="panel-body panel-cuad-index">
									<p>Pulse aquí para acceder al formulario de alta de médicos.</p>
								</div>
							</div>
						</a>
					</div>
					
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="formularioconsulta.php" class="panel-enlace-info">
							<div class="panel panel-info">
								<div class="panel-heading">Consultar datos de un médico</div>
								<div class="panel-body panel-cuad-index">
									<p>Pulse aquí para acceder alos datos de un médico concreto.</p>
								</div>
							</div>
						</a>
					</div>
					
						
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="formulariomod.php" class="panel-enlace-info">
							<div class="panel panel-info">
								<div class="panel-heading">Modificar datos de un médico</div>
								<div class="panel-body panel-cuad-index">
									<p>Pulse aquí para acceder alos datos de un médico concreto y poder modificarlos.</p>
								</div>
							</div>
						</a>
					</div>
					
						
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="formularioborrado.php" class="panel-enlace-danger">
							<div class="panel panel-danger">
								<div class="panel-heading">Dar de baja un médico</div>
								<div class="panel-body panel-cuad-index">
									<p>Pulse aquí para acceder al formulario de baja de médicos.</p>
								</div>
							</div>
						</a>
					</div>
					
					
					
				</div>
			</div>
			
			<div class="container">
				<div class="row">
					
					
					<div class="col-xs-12, col-sm-6">
						<a href="peticion.php" class="panel-enlace-info">
							<div class="panel panel-info">
								<div class="panel-heading">Peticiones de registro pendientes de confirmar</div>
								<div class="panel-body">
									<p>Pulse aquí para acceder a la lista de médicos registrados pendientes de confirmación. Usted podrá confirmar o rechazar, así como obtener más información acerca del registro.</p>
								</div>
							</div>
						</a>
					</div>
					
						
					<div class="col-xs-12, col-sm-6">
						<div class="panel panel-info">
							<div class="panel-heading">Buscar un médico</div>
							<div class="panel-body">
								<p>Introduzca el DNI del médico para mostrar sus datos de perfil en pantalla.</p>
								<form action='consulta.php' method='POST'>
									<tr>
										<div class="form-group">
											<input name="dni" type="text" class="form-control" placeholder="Dni del medico" required>
										</div>
										
										<?php 
										if($Tipo != 1) echo "<input type='submit' class='btn-aceptar-consulta-index' value='Buscar'>";
										?>
									</tr>
								</form> 
							</div>
						</div>
					</div>
					
				</div>
			</div>
			
			
		</main>
		
		
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   	
		
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	</body>
</html>
