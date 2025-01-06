<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET,POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Conecta a la base de datos  con usuario, contraseña y nombre de la BD
$servidor = "localhost"; $usuario = "root"; $contrasenia = "nelson15"; $nombreBaseDatos = "pasteleria";
$conexionBD = new mysqli($servidor, $usuario, $contrasenia, $nombreBaseDatos);


// Consulta datos y recepciona una clave para consultar dichos datos con dicha clave
if (isset($_GET["consultar"])){
    $sqlPasteles = mysqli_query($conexionBD,"SELECT * FROM pastel WHERE ID_pastel=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlPasteles) > 0){
        $pasteles = mysqli_fetch_all($sqlPasteles,MYSQLI_ASSOC);
        echo json_encode($pasteles);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlPasteles = mysqli_query($conexionBD,"DELETE FROM pastel WHERE ID_pastel=".$_GET["borrar"]);
    if($sqlPasteles){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos de nombre y correo
if (isset($_GET["insertar"])) {
    // Decodificar los datos enviados desde Vue
    $data = json_decode(file_get_contents("php://input"));

    // Obtener los valores de los campos
    $nombre = $data->nombre;
    $descripcion = $data->descripcion;
    $preparado_por = $data->preparado_por;
    $fecha_creacion = $data->fecha_creacion;
    $fecha_vencimiento = $data->fecha_vencimiento;

    // Validar que los campos obligatorios no estén vacíos
    if (!empty($nombre) && !empty($descripcion) && !empty($preparado_por) && !empty($fecha_creacion) && !empty($fecha_vencimiento)) {
        // Consulta SQL para insertar los datos en la tabla
        $sqlInsertar = mysqli_query(
            $conexionBD,
            "INSERT INTO pastel (Nombre, Descripcion, Preparado_por, Fecha_creacion, Fecha_vencimiento) 
            VALUES ('$nombre', '$descripcion', '$preparado_por', '$fecha_creacion', '$fecha_vencimiento')"
        );

        // Verificar si la consulta fue exitosa
        if ($sqlInsertar) {
            echo json_encode(["success" => 1, "message" => "Registro agregado exitosamente."]);
        } else {
            echo json_encode(["success" => 0, "message" => "Error al agregar el registro."]);
        }
    } else {
        echo json_encode(["success" => 0, "message" => "Todos los campos son obligatorios."]);
    }

    exit();
}

// Actualiza datos pero recepciona datos de nombre, correo y una clave para realizar la actualización
if (isset($_GET["actualizar"])) {
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
   
    $nombre = $data->nombre;
    $descripcion = $data->descripcion;
    $preparado_por = $data->preparado_por;
    $fecha_creacion = $data->fecha_creacion;
    $fecha_vencimiento = $data->fecha_vencimiento;

    if (!empty($nombre) && !empty($descripcion) && !empty($preparado_por) && !empty($fecha_creacion) && !empty($fecha_vencimiento)) {
        $sqlActualizar = mysqli_query(
            $conexionBD,
            "UPDATE pastel 
             SET Nombre = '$nombre', Descripcion = '$descripcion', Preparado_por = '$preparado_por', 
                 Fecha_creacion = '$fecha_creacion', Fecha_vencimiento = '$fecha_vencimiento' 
             WHERE ID_pastel= $id"
        );

        if ($sqlActualizar) {
            echo json_encode(["success" => 1, "message" => "Registro actualizado exitosamente."]);
        } else {
            echo json_encode(["success" => 0, "message" => "Error al actualizar el registro."]);
        }
    } else {
        echo json_encode(["success" => 0, "message" => "Todos los campos son obligatorios."]);
    }

    exit();
}

// Consulta todos los registros de la tabla empleados
$sqlPasteles = mysqli_query($conexionBD,"SELECT * FROM pastel");
if(mysqli_num_rows($sqlPasteles) > 0){
    $pasteles = mysqli_fetch_all($sqlPasteles,MYSQLI_ASSOC);
    echo json_encode($pasteles);
}
else{ echo json_encode([["success"=>0]]); }


//ver detalle de ingredientes
if (isset($_GET['verDetalles'])) {
    $id_pastel = $_GET['verDetalles'];
    $query = "SELECT p.Nombre, p.Descripcion, i.nombre AS ingrediente_nombre, pi.cantidad 
              FROM pasteles p
              LEFT JOIN pastel_ingredientes pi ON p.ID_pastel = pi.pastel_id
              LEFT JOIN ingredientes i ON pi.ingrediente_id = i.id
              WHERE p.ID_pastel = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_pastel);
    $stmt->execute();
    $result = $stmt->get_result();

    $detalles = [];
    while ($row = $result->fetch_assoc()) {
        $detalles['Nombre'] = $row['Nombre'];
        $detalles['Descripcion'] = $row['Descripcion'];
        $detalles['ingredientes'][] = [
            'nombre' => $row['ingrediente_nombre'],
            'cantidad' => $row['cantidad']
        ];
    }
    echo json_encode($detalles);
    exit;
}






?>
