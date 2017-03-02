
<!DOCTYPE html>

<html>

	<head>

		<title>Iniciar sesión</title>
		
		<link rel="stylesheet" type="text/css" href="./CSS/stylesheet.css">

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Language" content="es" />

	</head>

	<body>
		
		<div id="principal">

			<h1>Login</h1>

			<form action="login.php" enctype="application/x-www-form-url-urlencoded" method="POST">
				<div class="center">
					<label><input type="text" name="usuario" placeholder="Usuario" required /></label></p>
					<label><input type="password" name="contrasenia" placeholder="Contraseña" required /></label></p>

					<input type="submit" name="iniciarSesion" value="Iniciar sesión" />
					<input type="reset" name="limpiarDatos" value="Limpiar datos" />
				</div>
			</form>


			<?php

				/* Indicar el uso de sesiones. */
				session_start();

				if (isset($_POST['iniciarSesion']))
				{
					$usuario = $_POST['usuario'];
					$contrasenia = $_POST['contrasenia'];
					
					if (($usuario == "") || ($contrasenia == ""))
					{	
						/* Código de inicio de sesión con campo(s) vacío(s). */
						$_SESSION['codigoSesion'] = -1;
					}
					else
					{
						include("abrirConexion.php");

						$sentenciaSQL = "SELECT * FROM $tableUsers WHERE usuario = '$usuario' AND contrasenia = '$contrasenia'";

						$resultados = $connection->query($sentenciaSQL);

						if (!$resultados)
						{
							echo "<div class=\"center\">";
								echo "<p class=\"blackBackground\">Error inesperado.</p>";
							echo "</div>";
						}
						else
						{
							$fila = $resultados->fetch_assoc();

							if (($fila['usuario'] == $usuario) && ($fila['contrasenia'] == $contrasenia))
							{
								/* Código de inicio de sesión correcto. */
								$_SESSION['codigoSesion'] = 1;
								
								$_SESSION['usuario'] = $fila['usuario'];

								if ($fila['rol'] == 'A')
								{
									$_SESSION['rol'] = "Administrador general";
								}
								else if ($fila['rol'] == 'J')
								{
									$_SESSION['rol'] = "Jefe de departamento";
								}
								else if ($fila['rol'] == 'C')
								{
									$_SESSION['rol'] = "Coordinador";
								}
								else /* Jamás debería "entrar" aquí. */
								{
									$_SESSION['rol'] = "Rol indeterminado";
								}
							}
							else
							{
								/* Código de inicio de sesión incorrecto. */
								$_SESSION['codigoSesion'] = 0;	
							}
						}
					}

					if ($_SESSION['codigoSesion'] == -1)
					{
						echo "<br />";
						echo "<div class=\"center\">";
							echo "<p class=\"redBackground\">Campo(s) vacio(s).</p>";
						echo "</div>";
					}
					else if ($_SESSION['codigoSesion'] == 0)
					{
						echo "<br />";
						echo "<div class=\"center\">";
							echo "<p class=\"redBackground\">Error de datos incorrectos.</p>";
						echo "</div>";
					}
					else if ($_SESSION['codigoSesion'] == 1)
					{
						header("location: panelDeConsultas.php");
					}
				}

			?>


		</div>

	</body>

</html>
