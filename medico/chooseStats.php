<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;

$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));
$Tipo = $res['Tipo'];


$campos =['Enfermedad','Edad','Sexo'];

$unomas = $db->tests;
$cursor = $unomas->find();

$tag = $db->tags;

$t=1;
?>

<!DOCTYPE html>
<html lang="en">
		
	<head>
		<?php include 'links.php';?>
		<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
		
	</head>

	<body>
		<?php include 'navMedico.php';?>
		
		
		<main>
			<div class="container">
			
				<p class="titulo-seccion">> Estadisticas:</p>
		

				<div class="row">
				
					<div class="col-sm-12 col-md-6">						
							<div class="panel panel-info">
								<div class="panel-heading">Datos: </div>
								<div class="panel-body">
									<table class="table table-striped table-bordered table-hover" data-method="POST">

										<?php 
										echo "<form id='form_algo' name='form' action='showStats.php' method='post'>";	
											for($t=0;$t<sizeof($campos);$t++) {
												echo "<tr>";
													echo "<td>";

														echo "<label class='label-fino' for='nombre'>" .$campos[$t]." </label>";
													
													echo "</td>";
													if(strcmp($campos[$t],"Enfermedad") == 0){
														echo "<td>";
															echo "<input  id='".$campos[$t]."' value='' name='".$campos[$t]."' >";
														echo "</td>";

													}

													if(strcmp($campos[$t],"Edad") == 0){
														echo "<td>";
															echo "<input  id='inicio' value='' name='inicio' placeholder='Desde' >";
															echo "<input  id='fin' value='' name='fin' placeholder='Hasta' >";
														echo "</td>";

													}

													if(strcmp($campos[$t],"Sexo") == 0){
														echo "<td>";
															echo "<input  id='sexo' value='' name='sexo' placeholder='H/M' >";
														echo "</td>";

													}

												echo "</tr>";
												
											}
											
											echo "<input class='btn-volver-atras btn-volver-bot2' type='submit' name='Submit' value='Crear'/>";
											echo "</form>";
										?>
										</table>
										<?php
										echo "<form id='form_algo2' name='form2' action='indexMedico.php' method='post'>";	
											echo "<input class='btn-volver-atras btn-volver-bot3' type='submit' name='Submit2' value='Volver'/>";
											echo "</form>";
										?>
								</div>
							</div>
					</div>

					<div class="col-sm-12 col-md-6">
						 
						<p class="popup-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Pulsa en "Etiquetas ya utilizadas" para comprobar qué etiquetas se han usado.<br> 
						Estas etiquetas son todas las empleadas en la creación de plantillas. <br> Pueden no haberse realizado test con ellas. <br><br><button id="ok-popup">¡Vale!</button></p> 
						  
						  <div class="panel-heading"><span class="info"  id="despliega">Etiquetas ya utilizadas</span><i class="fa fa-info-circle informacion" aria-hidden="true"></i></div>
						  <div class="panel-body" id="contenido" >
								<?php 
								
									$letrasUsadas = array();
									foreach(range('A', 'Z') as $letra){
										
										$regex = new MongoRegex("/^" .$letra. "/");
										$where = array('Etiqueta' => $regex);
										$cursor = $tag->find($where);									
										$cursor->sort(array("Etiqueta"=>1));
										
										
										foreach($cursor as $doc){
											//echo "<p><strong> " . $letra . ":</strong></p>";
											if(!in_array($letra, $letrasUsadas)){
												array_push($letrasUsadas, $letra);
												echo "<p><strong>" . end($letrasUsadas) . ":</strong></p>";
											}
											
											echo "<span>".$doc['Etiqueta'] . "  &nbsp;</span>";
										}
										
									}
								?>
						  </div>
					</div>	
				</div>
			</div>		
			
		</main>
		
		
		
		
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
   	
		
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	

	<script>
		
		$(document).ready(function(){
			$('#despliega').click(function(){
				$('#contenido').toggle('blind');
			});
		});
		
		$(document).ready(function(){
			$('.informacion').click(function(){
				$('.popup-info').css("display","block");
			});
		});
		$(document).ready(function(){
			$('#ok-popup').click(function(){
				$('.popup-info').css("display","none");
			});
		});
		</script>
	 
	</body>
</html>
