<?php 
session_start();

$dni = $_SESSION['dni'];
$conn = new MongoClient("mongodb://davidalvaro:patientmanager2017@127.0.0.1/patientmanager?authSource=admin");
$db = $conn->patientmanager;
$coll = $db->usuarios;
$res = $coll->findOne(array('DNI'=>$dni),array('_id' => 0));

$tag = $db->tags;
?>

<!DOCTYPE html>
<html lang="en">
		
	<head>
		<?php include 'links.php';?>
		<link rel="stylesheet" href="../font-awesome-4.7.0/css/font-awesome.min.css">
		<script type="text/javascript">
		
			function correcto(){
			
				alert("Registrado");
				
			}
			
		</script>
		
	</head>

	<body>
		<?php include 'navMedico.php';?>
		
				
	<div class="panel panel-default">
		<div class="container">
			<div class="row">
				
				<div class="col-sm-12 col-md-6">
					  <div class="panel-heading"><span class="alta">Nueva plantilla de test</span></div>
					  <div class="panel-body">
						<form id="form_registrarse" action="insertaPlantillaTestMongo.php" method="post" onsubmit="return correcto();")>
								<fieldset>
									<legend>
										Agregue campos a su gusto:
									</legend>
									<table class="tabla-form" id="datos">	
										<tr>
											<td><label for="plan">Campo 1: </label></td>
											<td>
											<input  id="plan" placeholder="Nombre de la plantilla" name="Nombre_de_la_plantilla" type="text" required>
											</td>
										</tr>	
										<tr>
											<td><label for="med">Campo 2: </label></td>
											<td>
											<input class="input-oculto" id="med" value="<?php echo $dni; ?>" name="Médico" type="text"  readonly="readonly">
											</td>
										</tr>	
										<tr>
											<td><label for="plan">Campo 3: </label></td>
											<td>
											<input  id="plan2" placeholder="Etiqueta" name="etiqueta" type="text" required>
											</td>
										</tr>									
										<tr>
											<td>
											<a id="agregarCampo" class="btn btn-info" href="#">+</a>
											</td>
											<td>
												<div id="contenedor">
													<div class="added">
														<input class="campoextra" type="text" name="Campo_4" id="campo_4" placeholder="Campo adicional"/>
													</div>
												</div>
											</td>
										</tr>

									
										<tr>
											<td>
											<input type="submit" class="btn-aceptar" id="sub" value="Insertar">
											</td>
											<td> </td>
										</tr>

									</table>
								</fieldset>

							</form>
					  </div>
					</div>
				
					<div class="col-sm-12 col-md-6">
						 
						<p class="popup-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Pulsa en "Etiquetas ya utilizadas" para comprobar qué etiquetas se han usado.<br> El número entre paréntesis (n) indica cuántas veces se han utilizado. <br>
						Por favor, intenta en la medida de lo posible comprobar si tu etiqueta ya ha sido utilizada, para no repetirla. ¡Te lo agradecemos mucho! <br><br><button id="ok-popup">¡Vale!</button></p> 
						  
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
											if(!in_array($letra, $letrasUsadas)){
												array_push($letrasUsadas, $letra);
												echo "<p><strong>" . end($letrasUsadas) . ":</strong></p>";
											}
											
											echo "<span>".$doc['Etiqueta'] . " (" . $doc["Contador"] .") &nbsp;</span>";
										}
										
									}
								?>
						  </div>
					</div>	
				
				</div>
				
				  
				
			</div>
		</div>	



	    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	   	
			
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
		<script type="text/javascript">
			
			$(document).ready(function() {

			    var MaxInputs       = 99; 
			    var contenedor       = $("#contenedor"); 
			    var AddButton       = $("#agregarCampo"); 

			    var x = $("#contenedor div").length + 1;
			    var FieldCount = x+2; 

			    $(AddButton).click(function (e) {
			        if(x <= MaxInputs) 
			        {
			            FieldCount++;
			            //agregar campo
			            $(contenedor).append('<div><input type="text" class="campoextra" name="Campo '+ FieldCount +'" id="campo_'+ FieldCount +'" placeholder="Campo adicional"/></div>');
			            x++; 
			        }
					
			        return false;
			    });

			});
		</script>
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