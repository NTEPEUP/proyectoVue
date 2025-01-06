<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header('Content-Type: application/json');

header('Content-Type: application/json');

// Configuración de conexión
$host = 'localhost';
$db = 'pasteleria';
$user = 'root';
$password = 'nelson15';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta
    $sql = "SELECT 
                p.Nombre AS pastel,
                p.Descripcion AS descripcion_pastel,
                i.Nombre AS ingrediente,
                i.Fecha_ingreso,
                i.Fecha_vencimiento
            FROM 
                pastel_ingredientes pi
            INNER JOIN 
                pastel p ON pi.ID_pastel = p.ID_pastel
            INNER JOIN 
                ingrediente i ON pi.ID_ingrediente = i.ID_ingrediente";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
