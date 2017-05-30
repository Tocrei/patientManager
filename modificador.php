<?php 
	
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;
$coll = $db->usuarios;
$numCampos = 0;
$dni = $_POST['dni'];
$res = $coll->findOne(array('DNI'=>$dni),array('_id'=>0));
$numFields = sizeof($res);
$pet = $db->peticionAlta;

if($res == null)
	header("Location: formulariomod.php");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

		<link rel="stylesheet" type="text/css" href="css/main.css" media="screen" />
		
		<script type="text/javascript">
		
			function modificado(){
			
				alert("Modificado");
				
			}
			
		</script>
		
		<title> Modificar </title>
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
					  
					</div>
					</div>
				</nav>
			</div>	
		</header>	
		
		<div class="panel panel-default">
			<div class="container">	
				
				<div class="panel-heading"><span class="info">Modificación de datos</span></div>
				<div class="panel-body">
	
					<form id="form_registrarse" action="modifica.php" method="post" onsubmit="return modificado();">
						<fieldset>
							<legend>
								Cambie los datos que desee
							</legend>
							<table class="tabla-form" id="datos">
					
								<tr id="dni">
									<td>
										<label for="dni">DNI</label>
										
									</td>
									<td>
										<?php echo "<input  class='dni-oculto' id='dni' name='DNI' type='text' value=" .$dni. " readonly='readonly'>" ?>
									</td>
								</tr>
								<?php
									$hey = array_keys($res);
									foreach ($hey as $valor){
										echo "<tr>";
											echo "<td>";
											if(ucfirst(  $valor ) != "DNI"  )
											{
												echo "<label for='nombre'>" .str_replace('_',' ',ucfirst( $valor)). " </label>";
											
											echo "</td>";
											echo "<td>";
								?>
											<input id="<?php echo ucfirst($valor) ?>" name="<?php echo ucfirst($valor) ?>" type='text' value="<?php echo array_shift($res) ?>">

								<?php
											echo "</td>";
										}
										echo "</tr>";

									 }									 
									 
								?>
								<tr>
									<td>
									<input type="submit" class="btn-aceptar-consulta" id="sub" value="Modificar" >
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
