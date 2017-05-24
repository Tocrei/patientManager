<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->plantilla_paciente;

$plan = $coll->find(array('Campo_2'=>$dni),array('_id'=>0));

?>

<!DOCTYPE html>
<html lang="en">
		
	<head>
		<link rel="stylesheet" href="/tfg/font-awesome-4.7.0/css/font-awesome.min.css">
		<?php include 'links.php';?>		
	</head>

	<body>
		<?php include 'navMedico.php';?>



			<div class="container">
				<div class="panel-heading"><span class="info">Listado de Plantillas de Pacientes</span></div>
					<div class="panel-body">					
						<table class="table table-striped table-bordered table-hover" data-method="POST">
							<thead>
								<tr>
									<th> </th>
									<th>Nombre Plantilla</th>
									<th class="btn-peticion">Elegir </th>
								</tr>
							</thead>
							<tbody data-link="row" class="rowlink">								
			<?php 
				$t=1;
				foreach ($plan as $documento) {
					echo "<form id='form_algo' name='form' action='insertaPacientePorPlantilla.php' method='get'>";
						echo "<tr>";
							echo "<td class='celda'> $t <input type='hidden' name='t' value='$t' > </td>";
							echo "<td class='celda'>" .str_replace('_',' ',ucfirst($documento['Campo_1'])). "<input type='hidden' name='texto$t' value='" .str_replace('_',' ',ucfirst($documento['Campo_1'])). "' /> </td>";
							echo "<td class='celda btn-peticion'><input type='submit' name='confirma' id='confirma' value='&#xf00c' class='btn btn-success btn-ancho' > </td>";
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