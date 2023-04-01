<?php
   
//CONEXIÓN A LA BD
$servidor  = "127.0.0.1";
$basedatos = "sakila";
$usuario   = "root";
$contra    = "60401Utn";

$conex = new mysqli($servidor, $usuario, $contra, $basedatos);

if ($conex->connect_error) {
    die("La conexión falló: " . $conex->connect_error);
}


$Consultando="SELECT 
f.film_id, 
f.title, 
COUNT(r.rental_id) AS veces_alquilado, 
SUM(p.amount) AS total_generado 
FROM 
rental r 
JOIN inventory i ON r.inventory_id = i.inventory_id 
JOIN film f ON i.film_id = f.film_id 
JOIN payment p ON r.rental_id = p.rental_id 
WHERE 
r.rental_date BETWEEN 'fecha_inicio' AND 'fecha_final' 
GROUP BY 
f.film_id, 
f.title 
ORDER BY 
veces_alquilado DESC 
LIMIT 10;
";

//Ejecutar la consulta SQL y obtener los resultados
$resultados = $conex->query($Consultando);

// Crear un objeto SimpleXMLElement para almacenar los datos
$xml3 = new SimpleXMLElement('<peliculas></peliculas>');

// Iterar sobre los resultados y agregar cada película al XML
while ($fila = $resultados->fetch_assoc()) {
  $pelicula = $xml3->addChild('pelicula');
  $pelicula->addChild('codigo', $fila['film_id']);
  $pelicula->addChild('nombre', $fila['title']);
  $pelicula->addChild('veces_alquilado', $fila['veces_alquilado']);
  $pelicula->addChild('total_generado', $fila['total_generado']);
}

// Agregar el gran total generado del periodo solicitado
$gran_total = $conex->query('SELECT SUM(amount) AS gran_total FROM payment WHERE payment_date BETWEEN "fecha_inicio" AND "fecha_final"');
$gran_total = $gran_total->fetch_assoc()['gran_total'];
$xml3->addChild('gran_total_generado', $gran_total);

// Imprimir el XML formateado
 $xml3->asXML('XML3-Examen.xml');
 $conex->close();
?>
<br><br>
<!DOCTYPE html>
<html>
<head>
	<title>Las mejores peliculas</title>
	<!-- Agregar el enlace a los archivos CSS de Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<fieldset class="border p-2">
  <legend class="w-auto"><h3>Top 10 películas</h3></legend>
  <form action="Index10.php" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="archivo">Seleccionar archivo XML generado:</label>
      <input type="file" class="form-control-file" name="archivo" id="archivo">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Mostrar películas</button>
  </form>
</fieldset>

	</body>
</html>