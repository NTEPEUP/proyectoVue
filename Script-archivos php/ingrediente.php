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
    $sqlIngredientes = mysqli_query($conexionBD,"SELECT * FROM ingrediente WHERE ID_ingrediente=".$_GET["consultar"]);
    if(mysqli_num_rows($sqlIngredientes) > 0){
        $ingredientes = mysqli_fetch_all($sqlIngredientes,MYSQLI_ASSOC);
        echo json_encode($ingredientes);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//borrar pero se le debe de enviar una clave ( para borrado )
if (isset($_GET["borrar"])){
    $sqlPasteles = mysqli_query($conexionBD,"DELETE FROM ingrediente WHERE ID_ingrediente=".$_GET["borrar"]);
    if($sqlPasteles){
        echo json_encode(["success"=>1]);
        exit();
    }
    else{  echo json_encode(["success"=>0]); }
}
//Inserta un nuevo registro y recepciona en método post los datos 
if (isset($_GET["insertar"])) {
    // Decodificar los datos enviados desde Vue
    $data = json_decode(file_get_contents("php://input"));

    // Obtener los valores de los campos
    $nombre = $data->nombre;
    $descripcion = $data->descripcion;
    
    $fecha_ingreso = $data->fecha_ingreso;
    $fecha_vencimiento = $data->fecha_vencimiento;

    // Validar que los campos obligatorios no estén vacíos
    if (!empty($nombre) && !empty($descripcion) && !empty($fecha_ingreso) && !empty($fecha_vencimiento)) {
        // Consulta SQL para insertar los datos en la tabla
        $sqlInsertar = mysqli_query(
            $conexionBD,
            "INSERT INTO ingrediente (Nombre, Descripcion, Fecha_ingreso, Fecha_vencimiento) 
            VALUES ('$nombre', '$descripcion', '$fecha_ingreso', '$fecha_vencimiento')"
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

// Actualiza datos pero recepciona datos 
if (isset($_GET["actualizar"])) {
    $data = json_decode(file_get_contents("php://input"));

    $id=(isset($data->id))?$data->id:$_GET["actualizar"];
   
    $nombre = $data->nombre;
    $descripcion = $data->descripcion;
    
    $fecha_ingreso = $data->fecha_ingreso;
    $fecha_vencimiento = $data->fecha_vencimiento;

    if (!empty($nombre) && !empty($descripcion) && !empty($fecha_ingreso) && !empty($fecha_vencimiento)) {
        $sqlActualizar = mysqli_query(
            $conexionBD,
            "UPDATE ingrediente 
             SET Nombre = '$nombre', Descripcion = '$descripcion', 
                 Fecha_ingreso = '$fecha_ingreso', Fecha_vencimiento = '$fecha_vencimiento' 
             WHERE ID_ingrediente= $id"
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

// Consulta todos los registros de la tabla
$sqlPasteles = mysqli_query($conexionBD,"SELECT * FROM ingrediente");
if(mysqli_num_rows($sqlPasteles) > 0){
    $pasteles = mysqli_fetch_all($sqlPasteles,MYSQLI_ASSOC);
    echo json_encode($pasteles);
}
else{ echo json_encode([["success"=>0]]); }


//ver detalle de ingredientes



?>