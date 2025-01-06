<?php
// Conexión a la base de datos
$host = "localhost";
$dbname = "pasteleria";
$username = "root";
$password = "nelson15";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['id_pastel'])) {
        $id_pastel = $_GET['id_pastel'];

        // Consulta para obtener los ingredientes del pastel
        $query = $conn->prepare("
            SELECT i.ID_ingrediente, i.Nombre, i.Descripcion
            FROM pastel_ingredientes pi
            INNER JOIN ingrediente i ON pi.ID_ingrediente = i.ID_ingrediente
            WHERE pi.ID_pastel = :id_pastel
        ");
        $query->bindParam(':id_pastel', $id_pastel, PDO::PARAM_INT);
        $query->execute();
        $ingredientes = $query->fetchAll(PDO::FETCH_ASSOC);

        // Consulta para obtener el nombre del pastel
        $query2 = $conn->prepare("SELECT Nombre FROM pastel WHERE ID_pastel = :id_pastel");
        $query2->bindParam(':id_pastel', $id_pastel, PDO::PARAM_INT);
        $query2->execute();
        $pastel = $query2->fetch(PDO::FETCH_ASSOC)['Nombre'];

        echo json_encode(['ingredientes' => $ingredientes, 'pastel' => $pastel]);
    } else {
        echo json_encode(['error' => 'ID del pastel no proporcionado']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
