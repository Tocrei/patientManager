<?php


$dni = $_SESSION['dni'];

	
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
	
$res = $coll->findOne(array('DNI'=>$dni),array('_id'=>0));

$numFields = sizeof($res);
	require('languages.php'); 


	$lang = $_SESSION['lang'];	
		
	if($lang == 'es')
	{
		$lang = null;
	}


?>
<!DOCTYPE html>
<html lang="en">
	
	<body>
	
		<header id="navbar-custom" class="navbar navbar-default navbar-fixed-top" role="banner">
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
					  <a class="navbar-brand" href="indexMedico.php"><?php echo __('Inicio', $lang) ?></a>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					  <ul class="nav navbar-nav">
						
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo __('Pacientes', $lang) ?><span class="caret"></span></a>
						  <ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
							<li class="dropdown-submenu"><a tabindex="-1" href=""><?php echo __('Insertar', $lang); ?></a>
								<ul class="dropdown-menu">
									<li><a href="insertaPacientePorDefecto.php"><?php echo __('Por defecto', $lang) ?></a></li>
									<li><a href="insertarPorPlantilla.php"><?php echo __('Plantilla', $lang) ?></a></li>
								</ul>
							</li>
							<li><a href="listaPacientes.php"><?php echo __('Consultar', $lang); ?></a></li>
							<li><a href="modificarPacientes.php"><?php echo __('Modificar', $lang); ?></a></li>
							<li><a href="eliminarPacientes.php"><?php echo __('Eliminar', $lang);?></a></li>							
						  </ul>
						</li>
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo __('Plantillas paciente' ,$lang);?><span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<li><a href="consultaPlantillaPaciente.php"><?php echo __('Listado', $lang); ?></a></li>
							<li><a href="insertaPlantillaPaciente.php"><?php echo __('Insertar', $lang); ?></a></li>
							<li><a href="consultaPlantillaPaciente.php"><?php echo __('Eliminar', $lang); ?></a></li>
							
						  </ul>
						</li>
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo __('Plantillas Test' , $lang); ?><span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<li><a href="consultaPlantillaTest.php"><?php echo __('Listado', $lang); ?></a></li>
							<li><a href="insertaPlantillaTest.php"><?php echo __('Insertar', $lang); ?></a></li>
							<li><a href="consultaPlantillaTest.php"><?php echo __('Eliminar', $lang); ?></a></li>
						  </ul>
						</li>
						<li class="dropdown">
						  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo __('Estadísticas' , $lang); ?><span class="caret"></span></a>
						  <ul class="dropdown-menu">
							<li><a href="chooseStats.php"><?php echo __('Crear estadística', $lang); ?></a></li>

						  </ul>
						</li>
						
					 </ul>			 
					
					
					<ul class="nav navbar-nav navbar-right">
						<li>
						<form class="navbar-form" action='consultaPaciente.php' method='POST'>
							<div class="form-group">
								<input name="idPaciente" type="text" class="form-control" placeholder=<?php echo __('Dni del paciente', $lang);?> required>
							</div>
								<input type='submit' class='btn btn-default'  value=<?php echo __('Buscar', $lang); ?> >
						 </form> 
						 </li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo __('Perfil' , $lang);?><span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="consultaPerfil.php"><?php echo $res['Nombre'];?></a></li>
								<li><a href="../logout.php"><?php echo __('Log Out', $lang);?></a></li>
							</ul>
						</li>
						<li>
							<a href="changelanguage.php?idioma=es" class="bandera" alt="Español"> <img src="../img/es.jpg" /></a>
							<a href="changelanguage.php?idioma=en" class="bandera" alt="English"> <img src="../img/en.png" /></a>
						</li>
					
					</ul>
					</div>
				  </div>
				</nav>
			</div>	
		</header>	

		 
	 
	
	
	</body>
</html>