<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		
		<link rel="stylesheet" type="text/css" href="css/log-reg.css" media="screen" />
				<title> Log-in </title>
	</head>
	
	
	
	
	<body>
		<div class="contenido">
		
		
			<div class="registro">
				<form id="form_reg" action="reg.php" method="post" >
					<fieldset>
						
						
					<h1><strong><u> Registro</u></strong></h1>
							
						<table class="datos">
							
							<tr >
									<td>									
									<input class="campo" id="dni" name="dni" type="text" placeholder="Dni:" required>
									</td>
								</tr>
								<tr>
									<td>
									<input class="campo" id="numCol" name="numCol" type="text" placeholder="Número de colegiado:" required>
									</td>
								</tr>
								<tr>
									<td>
									<input class="campo" id="apellido1" name="apellido1" type="text" placeholder="Primer apellido:" required>
									</td>
								</tr>
								<tr>
									<td>
									<input class="campo" id="apellido2" name="apellido2" type="text" placeholder="Segundo apellido:" required>
									</td>
								</tr>
								<tr>
									<td>
									<input class="campo" id="nombre" name="nombre" type="text" placeholder="Nombre:" required>
									</td>
								</tr>
								<tr>
									<td>
									<input class="campo" id="telefono" name="telefono" type="text" placeholder="Teléfono:" required>
									</td>
								</tr>
								<tr>
									<td>
									<input class="campo" id="direccion" name="direccion" type="text" placeholder="Dirección:" required>
									</td>
								</tr>
								<tr>
									<td>
									<input class="campo" id="espemedica" name="espemedica" type="text" placeholder="Especialidad médica:" required>
									</td>
								</tr>
								<tr>
									<td>
									<input class="campo" id="hospital" name="hospital" type="text" placeholder="Hospital:" required>
									</td>
								</tr>
								<tr>
									<td>
									<input class="campo" id="password" name="password" type="password" placeholder="Contraseña:" required>
									</td>
								</tr>
								
								<tr>
									<td>
									<input type="submit" class="btn-log" id="sub" value="Registrarse">
									</td>
									<td> </td>
								</tr>

						</table>
						
						
						
					</fieldset>

				</form>
				
				<a href="login.php"> <span class="enlaceatras">Volver atrás</span></a>

			</div>			
			
		</div>
	
	</body>
	
</html>