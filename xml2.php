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

// Consulta SQL
$Consultando = "SELECT 
s.store_id,
a.address AS store_address,
c.customer_id,
CONCAT(c.first_name, ' ', c.last_name) AS customer_name,
LOWER(c.email) AS customer_email
FROM 
store s
INNER JOIN address a ON s.address_id = a.address_id
INNER JOIN customer c ON s.store_id = c.store_id
WHERE 
c.active = 1
ORDER BY 
s.store_id, 
c.last_name, 
c.first_name";

$resultado = $conex->query($Consultando);

// Creación del archivo XML

// Generar el archivo XML
$xml2 = new SimpleXMLElement('<reporte/>');

while ($row = $resultado->fetch_assoc()) {
    $customer = $xml2->addChild('customer');
    $customer->addChild('cod_almacen', $row['store_id']);
    $customer->addChild('nom_almacen', $row['store_address']);
    $customer->addChild('cod_client', $row['customer_id']);
    $customer->addChild('nom_completo', $row['customer_name']);
    $customer->addChild('email', $row['customer_email']);
}

// Configurar los encabezados para que el navegador reconozca el archivo como XML
header('Content-Type: text/xml');
echo $xml2->asXML();
?>
