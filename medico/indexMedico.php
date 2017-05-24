<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
$Tipo = $res['Tipo'];


	
?>

<!DOCTYPE html>
<html lang="en">
		
	<head>
		<?php include 'links.php';?>
		
	</head>

	<body>
		<?php include 'navMedico.php';?>
		
		
		<main>
			<div class="container">
			
			<p class="titulo-seccion"><?php echo __('> PACIENTES:', $lang); ?></p>
			
				<div class="row">
				
					
						<div class="col-xs-12 col-sm-6 col-md-3">
							<div class="panel panel-success">
								<div class="panel-heading"><?php echo __('Dar de alta un paciente', $lang); ?></div>
								<div class="panel-body panel-cuad-index">
									<p><?php echo __('Pulse aquí para acceder al formulario de alta de pacientes.', $lang); ?></p>
									
									<div class="row">
									<a href="insertaPacientePorDefecto.php" class="panel-enlace-alta">
										<div class="opcion-alta-paciente">
											<span><?php echo __('Por defecto.', $lang); ?></span>
										</div>
									</a>
									<a href="insertarPorPlantilla.php" class="panel-enlace-alta">
										<div class="opcion-alta-paciente-dcha">
											<span><?php echo __('Plantilla personalizada.', $lang); ?></span>
										</div>
									</a>
									</div>
								</div>
							</div>
						</div>
					
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="listaPacientes.php" class="panel-enlace-info">
							<div class="panel panel-info">
								<div class="panel-heading"><?php echo __('Consultar datos de un paciente', $lang);?></div>
								<div class="panel-body panel-cuad-index">
									<p><?php echo __('Pulse aquí para acceder a los datos de un paciente concreto.', $lang); ?></p>
								</div>
							</div>
						</a>
					</div>
					
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="modificarPacientes.php" class="panel-enlace-info">
							<div class="panel panel-info">
								<div class="panel-heading"><?php echo __('Modificar datos de un paciente', $lang);?></div>
								<div class="panel-body panel-cuad-index">
									<p><?php echo __('Pulse aquí para acceder a los datos de un paciente concreto y poder modificarlos.', $lang);?></p>
								</div>
							</div>
						</a>
					</div>
					
					
					
					<div class="col-xs-12 col-sm-6 col-md-3">
						<a href="eliminarPacientes.php" class="panel-enlace-danger">
							<div class="panel panel-danger">
								<div class="panel-heading"><?php echo __('Dar de baja un paciente', $lang);?></div>
								<div class="panel-body panel-cuad-index">
									<p><?php echo __('Pulse aquí para acceder al formulario de baja de pacientes.', $lang);?></p>
								</div>
							</div>
						</a>
					</div>
					
				
				</div>
			</div>
			
			<div class="container">
			
				<p class="titulo-seccion"><?php echo __('> PLANTILLAS PACIENTE:', $lang);?></p>
				
				<div class="row">
				
					
					<div class="col-xs-12 col-sm-4">
						<a href="consultaPlantillaPaciente.php" class="panel-enlace-info">
							<div class="panel panel-info">
								<div class="panel-heading"><?php echo __('Listado de plantillas de pacientes', $lang);?></div>
								<div class="panel-body panel-cuad-index-lista-paciente">
									<p><?php echo __('Pulse aquí para acceder al listado de plantillas de pacientes personalizadas.', $lang); ?></p>
								</div>
							</div>
						</a>
					</div>
					
					
					<div class="col-xs-12 col-sm-4">
						<a href="insertaPlantillaPaciente.php" class="panel-enlace-alta">
							<div class="panel panel-success">
								<div class="panel-heading"><?php echo __('Insertar plantilla de paciente', $lang);?></div>
								<div class="panel-body panel-cuad-index-lista-paciente">
									<p><?php echo __('Pulse aquí para acceder al panel de creación de plantillas personalizadas de pacientes.', $lang); ?></p>
								</div>
							</div>
						</a>
					</div>
					
						
					
					<div class="col-xs-12 col-sm-4">
						<a href="consultaPlantillaPaciente.php" class="panel-enlace-danger">
							<div class="panel panel-danger">
								<div class="panel-heading"><?php echo __('Eliminar plantilla de paciente', $lang);?></div>
								<div class="panel-body panel-cuad-index-lista-paciente">
									<p><?php echo __('Pulse aquí para acceder al panel de eliminación de plantillas personalizadas de paciente.', $lang);?></p>
								</div>
							</div>
						</a>
					</div>
					
					
				</div>
			</div>
			
			
			<div class="container">
			
			<p class="titulo-seccion"><?php echo __('> PLANTILLAS TEST:', $lang);?></p>
			
				<div class="row">
				
					<a href="consultaPlantillaTest.php" class="panel-enlace-info">
						<div class="col-xs-12 col-sm-4">
							<div class="panel panel-info">
								<div class="panel-heading"><?php echo __('Listado de plantillas de test', $lang);?></div>
								<div class="panel-body panel-cuad-index-lista-test">
									<p><?php echo __('Pulse aquí para acceder al listado de plantillas de test personalizadas.', $lang);?></p>
								</div>
							</div>
						</div>
					</a>
					
					<a href="insertaPlantillaTest.php" class="panel-enlace-alta">
						<div class="col-xs-12 col-sm-4">
							<div class="panel panel-success">
								<div class="panel-heading"><?php echo __('Insertar plantilla de test', $lang);?></div>
								<div class="panel-body panel-cuad-index-lista-test">
									<p><?php echo __('Pulse aquí para acceder al panel de creación de plantillas personalizadas de test.', $lang);?></p>
								</div>
							</div>
						</div>
					</a>
						
					<a href="consultaPlantillaTest.php" class="panel-enlace-danger">
						<div class="col-xs-12 col-sm-4">
							<div class="panel panel-danger">
								<div class="panel-heading"><?php echo __('Eliminar plantilla de test' , $lang);?></div>
								<div class="panel-body panel-cuad-index-lista-test">
									<p><?php echo __('Pulse aquí para acceder al panel de eliminación de plantillas personalizadas de test.', $lang);?></p>
								</div>
							</div>
						</div>
					</a>
					
				</div>
			</div>
			
		</main>
		
		
		
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
	 
	</body>
</html>
