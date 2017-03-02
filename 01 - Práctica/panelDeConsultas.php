
<!DOCTYPE html>

<html>

	<head>

		<title>Agenda académica</title>
		
		<link rel="stylesheet" type="text/css" href="./CSS/stylesheet.css">

		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta http-equiv="Content-Language" content="es" />

	</head>

	<body>

		<div id="sesion" class="center">

			<?php

				session_start();

				if (isset($_SESSION['usuario']))
				{
					echo "<p>" .
							"<label class=\"bold\">" . $_SESSION['usuario'] . "</label>" .
							" — " .
							"<label>" . $_SESSION['rol'] . "</label>" .
						"</p>";
					echo "<p><a href=\"cerrarConexion.php\"><input type=\"button\" name=\"cerrarSesion\" value=\"Cerrar sesión\" /></a></p>";
				}
				else
				{
					header("location: login.php");
				}

			?>

		</div>

		<div id="principal">

			<form action="realizarConsultas.php" enctype="application/x-www-form-url-urlencoded" method="POST">

				<div class="center">

					<!--<h1>Agenda académica</h1>-->
					<h2>Búsqueda por módulo</h2>

					<?php 

						/* "65" es el código ASCII decimal de la letra "A", mientras que "90" es el de la "Z". */
						for($i=65; $i<=90; $i++)
						{	
							/* Convertir a "char" el valor de "$i". */
							$letra = chr($i);
							echo "<input type=\"submit\" name=\"modulo$letra\" value=\"$letra\" />";
						}

					?>

				</div>

			</form>


			<form action="realizarConsultas.php" enctype="application/x-www-form-url-urlencoded" method="POST">			

				<br />
				<div class="center">

					<h2>Búsqueda personalizada</h2>

					<table align="center">

						<thead>
						</thead>

						<tbody>

							<tr>
								<th class="right">Nombre materia</th>
								<td class="left"><input type="text" name="nombreM" maxlength="90" /></td>
							</tr>
							<tr>
								<th class="right">Clave materia</th>
								<td class="left"><input type="text" name="claveM" minlength="5" maxlength="5" /></td>
							</tr>
							<tr>
								<th class="right">Módulo</th>
								<td class="left"><input type="text" name="modulo" minlength="5" maxlength="5" /></td>
							</tr>
							<tr>
								<th class="right">Aula</th>
								<td class="left"><input type="text" name="aula" minlength="5" maxlength="5" /></td>
							</tr>
							<tr>
								<th class="right">Días</th>
								<td class="left">
									<input type="checkbox" name="L" value="L" />L
									<input type="checkbox" name="M" value="M" />M
									<input type="checkbox" name="I" value="I" />I
									<input type="checkbox" name="J" value="J" />J
									<input type="checkbox" name="V" value="V" />V
									<input type="checkbox" name="S" value="S" />S
								</td>
							</tr>
							<tr>
								<th class="right">Hora inicio</th>
								<td class="left"><input type="text" name="horaInicio" minlength="4" maxlength="4" /></td>
							</tr>
							<tr>
								<th class="right">Hora fin</th>
								<td class="left"><input type="text" name="horaFin" minlength="4" maxlength="4" /></td>
							</tr>

						</tbody>

					</table>
					<br />

					<input type="submit" name="consultar" value="Consultar" />

				</div>

			</form>

		</div>

	</body>

</html>


<!--
	<div class="center">

		<h2>Búsqueda personalizada</h2>

		<label>Clave materia: <input type="text" name="clave" minlength="5" maxlength="5" /></label><br />
		<label>Módulo: <input type="text" name="modulo" minlength="5" maxlength="5" /></label><br />
		<label>Aula: <input type="text" name="aula" minlength="5" maxlength="5" /></label><br />
		<label>Días: 
			<input type="checkbox" name="L" value="L" />L
			<input type="checkbox" name="M" value="M" />M
			<input type="checkbox" name="I" value="I" />I
			<input type="checkbox" name="J" value="J" />J
			<input type="checkbox" name="V" value="V" />V
			<input type="checkbox" name="S" value="S" />S
		</label><br />
		<label>Hora inicio: <input type="text" name="horaInicio" minlength="4" maxlength="4" /> </label><br />
		<label>Hora fin: <input type="text" name="horaFin" minlength="4" maxlength="4" /> </label><br /><br />
		
		<input type="submit" name="consultar" value="Consultar" />

	</div>
-->