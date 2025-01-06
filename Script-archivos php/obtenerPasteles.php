<?php
header("Access-Control-Allow-Origin: *");

header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "root", "nelson15", "pasteleria");

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$sql = "SELECT* FROM pastel";
$result = $mysqli->query($sql);

$pasteles = [];
while ($row = $result->fetch_assoc()) {
    $pasteles[] = $row;
}

echo json_encode($pasteles);
$mysqli->close();
?>
