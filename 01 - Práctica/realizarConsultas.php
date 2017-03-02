
<html>

<head>

	<title>Resultados de consulta</title>

	<link rel="stylesheet" type="text/css" href="./CSS/stylesheet.css">

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Content-Language" content="es" />

</head>

<body>


	<?php
		
		echo "<div class=\"secundario\">";

			include("abrirConexion.php");

			include("mostrarResultados.php");

				if (isset($_POST['consultar']))
				{
					$nombreM    = $_POST['nombreM'];
					$claveM     = $_POST['claveM'];
					$modulo     = $_POST['modulo'];
					$aula       = $_POST['aula'];
					$L          = $_POST['L'];
					$M          = $_POST['M'];
					$I          = $_POST['I'];
					$J          = $_POST['J'];
					$V          = $_POST['V'];
					$S          = $_POST['S'];
					$horaInicio = $_POST['horaInicio'];
					$horaFin    = $_POST['horaFin'];

					$totalVariablesVacias = 0;

					if (empty($nombreM))    { $nombreM    = "%"; $totalVariablesVacias++; }
					if (empty($claveM))     { $claveM     = "%"; $totalVariablesVacias++; }
					if (empty($modulo))     { $modulo     = "%"; $totalVariablesVacias++; }
					if (empty($aula))       { $aula       = "%"; $totalVariablesVacias++; }
					if (empty($L))          { $L          = "%"; $totalVariablesVacias++; }
					if (empty($M))          { $M          = "%"; $totalVariablesVacias++; }
					if (empty($I))          { $I          = "%"; $totalVariablesVacias++; }
					if (empty($J))          { $J          = "%"; $totalVariablesVacias++; }
					if (empty($V))          { $V          = "%"; $totalVariablesVacias++; }
					if (empty($S))          { $S          = "%"; $totalVariablesVacias++; }
					if (empty($horaInicio)) { $horaInicio = "%"; $totalVariablesVacias++; }
					if (empty($horaFin))    { $horaFin    = "%"; $totalVariablesVacias++; }

					if ($totalVariablesVacias == 12)
					{	
						$posibleMensajeError = "<p class=\"blueBackground\">Especifique valores de filtrado.</p>";

						/* No extraer ningún resultado de la base de datos. */
						$sentenciaSQL = "SELECT * FROM $tableOferta WHERE 0=1";
					}
					else
					{
						$posibleMensajeError = "<p class=\"blueBackground\">No se han obtenido coincidencias.</p>";

						$sentenciaSQL = "SELECT * FROM $tableOferta WHERE 
															MATERIA LIKE '$nombreM'    AND 
															CLAVE   LIKE '$claveM'     AND 
															EDIF    LIKE '$modulo'     AND
															AULA    LIKE '$aula'       AND
															L       LIKE '$L'          AND
															M       LIKE '$M'          AND
															I       LIKE '$I'          AND
															J       LIKE '$J'          AND
															V       LIKE '$V'          AND
															S       LIKE '$S'          AND";

						if (($horaInicio == "%") || ($horaFin == "%"))
						{
							if (($horaInicio == "%") && ($horaFin == "%"))
							{	
								$sentenciaSQL .= " INI LIKE '$horaInicio' AND FIN LIKE '$horaFin' AND ST != 'I'";	
							}
							else if (($horaInicio == "%") && ($horaFin != "%"))
							{
								$sentenciaSQL .= " INI LIKE '$horaInicio' AND FIN LIKE $horaFin AND ST != 'I'";
							}
							else if (($horaInicio != "%") && ($horaFin == "%"))
							{
								$sentenciaSQL .= " INI LIKE $horaInicio AND FIN LIKE '$horaFin' AND ST != 'I'";
							}
						}
						else
						{
							if ((!is_numeric($horaInicio)) || (!is_numeric($horaFin)))
							{
								$horaInicio = intval($horaInicio);
								$horaFin = intval($horaFin);
							}
							
							$sentenciaSQL .= " INI LIKE $horaInicio AND FIN LIKE $horaFin";
						}
					}

					/*echo "<p>" . var_dump($clave)      . "</p>";
					echo "<p>" . var_dump($modulo)     . "</p>";
					echo "<p>" . var_dump($aula)       . "</p>";
					echo "<p>" . var_dump($L)          . "</p>";
					echo "<p>" . var_dump($M)          . "</p>";
					echo "<p>" . var_dump($I)          . "</p>";
					echo "<p>" . var_dump($J)          . "</p>";
					echo "<p>" . var_dump($V)          . "</p>";
					echo "<p>" . var_dump($S)          . "</p>";
					echo "<p>" . var_dump($horaInicio) . "</p>";
					echo "<p>" . var_dump($horaFin)    . "</p>";*/

					mostrarResultados($connection, $sentenciaSQL, $titulo, $posibleMensajeError);
				}
				else
				{
					$posibleMensajeError = "<p class=\"blueBackground\">No se imparten materias en este módulo.</p>";

					for($i=65; $i<=90; $i++)
					{
						$letra = chr($i);

						if (isset($_POST["modulo$letra"]))
						{
							$sentenciaSQL = "SELECT * FROM $tableOferta WHERE EDIF='DED$letra' AND AULA != '' AND ST != 'I'";
							$titulo = "<h2>Módulo $letra</h2>";
							
							mostrarResultados($connection, $sentenciaSQL, $titulo, $posibleMensajeError);
						}
					}
				}


		echo "</div>";
		
		echo "<p class=\"center\"><a href=\"panelDeConsultas.php\"><button>Atrás</button></a></p>";

	?>


</body>

</html>
