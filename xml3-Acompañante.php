<link rel="stylesheet" href="xml3.css">
<?php

if(isset($_POST['submit'])) {
	// Obtener el archivo enviado
	$xml = simplexml_load_file($_FILES['archivo']['tmp_name']);

	// Imprimir los datos de las películas en una tabla HTML
	echo "<div class='container'>";
	echo "<h1 class='my-8'>Top 10 películas</h1>";
	echo "<fieldset><legend>Resultados</legend>";
	echo "<table class='table table-striped'>";
	echo "<thead><tr><th>Código</th><th>Nombre</th><th>Veces Alquilado</th><th>Total Generado</th></tr></thead>";
	echo "<tbody>";
	foreach ($xml->film as $film) {
	    echo "<tr>";
	    echo "<td>" . $film->film_id . "</td>";
	    echo "<td>" . $film->title . "</td>";
	    echo "<td>" . $film->veces_alquilado . "</td>";
	    echo "<td>" . $film->total_generado . "</td>";
	    echo "</tr>";
	}
	echo "</tbody>";
	echo "</table>";
	echo "</fieldset>";
	echo "</div>";
}
?>