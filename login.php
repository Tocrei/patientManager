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
		
		
			<div class="login">
				<form id="form_login" action="compruebaUsuario.php" method="post">
					<fieldset>
							
						<h1><strong><u>Log-in</u></strong></h1>	
							
						<table class="datos">
							
							<tr >
								<td>
								<input  class="campo" id="dni" name="dni" type="text" placeholder="Dni usuario:" required>
								</td>
							</tr>
							
							<tr>
								<td>
								<input class="campo" id="password" name="password" type="password" placeholder="Password:" required>
								</td>
							</tr>
							
					
							<tr>
								<td>
								<input  class="btn-log" type="submit" id="sub" value="Log-in">
								</td>
								<td> </td>
							</tr>

						</table>
					</fieldset>

				</form>
				
				<a href="registro.php"> <span class="enlace">Registrarse</span></a>

			</div>			
			
		</div>
	
	</body>
	
	
	
</html>