
<?php
	
	function mostrarResultados($connection, $sentenciaSQL, $titulo, $posibleMensajeError)
	{
		$resultados = $connection->query($sentenciaSQL);

		if (!$resultados)
		{
			echo "<div class=\"center\">";
				echo "<p class=\"blackBackground\">Error inesperado.</p>";
			echo "</div>";
		}
		else
		{
			if ($resultados->num_rows == 0)
			{
				echo "<div class=\"center\">";
					echo $posibleMensajeError;
				echo "</div>";
			}
			else
			{
				$i = 0;
				while ($fila = $resultados->fetch_assoc())
				{
					$i++;
				}

				echo "<div class=\"center\">";
					echo "<p class=\"lightGreenBackground\">$i resultados</p>";
				echo "</div>";
				echo $titulo;


				$resultados = $connection->query($sentenciaSQL);

				echo "<form action=\"editarAula.php\" enctype=\"application/x-www-form-url-urlencoded\" method=\"POST\">";
					
					while($fila = $resultados->fetch_assoc())
					{	
						$aula = $fila['aula'];

						echo '<p class="lightBlueBackground">';

							echo "<table>

								<thead>
								</thead>

								<tbody>

									<tr>
										<th class=\"right\"><label class=\"bold\">Dpto.:</label></th>
										<td class=\"left\">" . $fila['DEPARTAMENTO'] . "</td>
									</tr>
									<tr>
										<th class=\"right\"><label class=\"bold\">Materia:</label></th>
										<td class=\"left\">" . $fila['MATERIA'] . "</td>
									</tr>
									<tr>
										<th class=\"right\"><label class=\"bold\">NRC:</label></th>
										<td class=\"left\">" . $fila['NRC'] . "</td>
									</tr>
									<tr>
										<th class=\"right\"><label class=\"bold\">Sección:</label></th>
										<td class=\"left\">" . $fila['SECC'] . "</td>
									</tr>
									<tr>
										<th class=\"right\"><label class=\"bold\">Estatus:</label></th>
										<td class=\"left\">" . $fila['ST'] . "</td>
									</tr>
									<tr>
										<th class=\"right\"><label class=\"bold\">Edificio:</label></th>
										<td class=\"left\">" . $fila['EDIF'] . "</td>
									</tr>
									<tr>
										<th class=\"right\"><label class=\"bold\">Aula:</label></th>
										<td class=\"left\">" . $fila['AULA'] . "</td>
									</tr>
									<tr>
										<th class=\"right\"><label class=\"bold\">Días:</label></th>
										<td class=\"left\">" . $fila['L'] . " " . $fila['M'] . " " . $fila['I'] . " " . $fila['J'] . " " . $fila['V'] . " " . $fila['S'] . "</td>
									</tr>
									<tr>
										<th class=\"right\"><label class=\"bold\">Horario:</label></th>
										<td class=\"left\">" . $fila['INI'] . " - " . $fila['FIN'] . "</td>
									</tr>
									<tr>
										<th class=\"right\"><label class=\"bold\">Profesor:</label></th>
										<td class=\"left\">" . $fila['PROFESOR'] . "</td>
									</tr>

								</tbody>
								
							</table>
							<br />";


							echo "<input type=\"submit\" name=\"editar$aula\"   value=\"Editar\"   />";
							echo "<input type=\"submit\" name=\"mover$aula\"    value=\"Mover\"    />";
							echo "<input type=\"submit\" name=\"eliminar$aula\" value=\"Eliminar\" />";


						echo "</p>";
					}

				echo "</form>";
			}
		}
	}
	
?>


<!-- 
	echo "<label class=\"bold\">Dpto.:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"          . $fila['DEPARTAMENTO'] . "<br />";
	echo "<label class=\"bold\">Materia:</label>&nbsp&nbsp&nbsp"                            . $fila['MATERIA']      . "<br />";
	echo "<label class=\"bold\">NRC:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"  . $fila['NRC']          . "<br />";
	echo "<label class=\"bold\">Sección:</label>&nbsp&nbsp&nbsp"                            . $fila['SECC']         . "<br />";
	echo "<label class=\"bold\">Estatus:</label>&nbsp&nbsp&nbsp&nbsp"                       . $fila['ST']           . "<br />";
	echo "<label class=\"bold\">Edificio:</label>&nbsp&nbsp&nbsp&nbsp"                      . $fila['EDIF']         . "<br />";
	echo "<label class=\"bold\">Aula:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $fila['AULA']         . "<br />";
	echo "<label class=\"bold\">Días:</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" . $fila['L']            . $fila['M'] . $fila['I'] . $fila['J'] . $fila['V'] . $fila['S'] . "<br />";
	echo "<label class=\"bold\">Horario:</label>&nbsp&nbsp&nbsp"                            . $fila['INI']          . '&nbsp'         . $fila['FIN'] . "<br />";
	echo "<label class=\"bold\">Profesor:</label>&nbsp"                                     . $fila['PROFESOR']     . "<br /><br />";
-->