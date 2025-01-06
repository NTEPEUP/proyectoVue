<?php
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true"); // Si necesi
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "root", "nelson15", "pasteleria");

if ($mysqli->connect_error) {
    die(json_encode(["success" => false, "message" => "Error de conexión: " . $mysqli->connect_error]));
}

$data = json_decode(file_get_contents("php://input"), true);
if (!$data || !isset($data['ID_pastel']) || !isset($data['ID_ingrediente'])) {
    echo json_encode(["success" => false, "message" => "Datos incompletos."]);
    exit();
}

$ID_pastel = $mysqli->real_escape_string($data['ID_pastel']);
$ID_ingrediente = $mysqli->real_escape_string($data['ID_ingrediente']);

$sql = "INSERT INTO pastel_ingredientes (ID_pastel, ID_ingrediente) VALUES ('$ID_pastel', '$ID_ingrediente')";

if ($mysqli->query($sql)) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Error: " . $mysqli->error]);
}

$mysqli->close();
?>
