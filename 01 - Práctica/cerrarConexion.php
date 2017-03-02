
<?php

	if (isset($_SESSION['usuario']))
	{
		if (!($connection->close())){
			echo "<div class=\"center\">";
				echo "<p class=\"blackBackground\">Error al intentar cerrar sesión.</p>";
			echo "</div>";
			exit();
		}
		else
		{
			header("location: login.php");
		}
	}
	else
	{
		header("location: login.php");
	}

?>
