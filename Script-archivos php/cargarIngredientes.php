<?php
header("Access-Control-Allow-Origin: *");

header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "root", "nelson15", "pasteleria");

if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$sql = "SELECT* FROM ingrediente";
$result = $mysqli->query($sql);

$ingredientes = [];
while ($row = $result->fetch_assoc()) {
    $ingredientes[] = $row;
}

echo json_encode($ingredientes);
$mysqli->close();
?>