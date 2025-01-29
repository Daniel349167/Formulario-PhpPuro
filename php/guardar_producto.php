<?php
include 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['codigo'], $data['nombre'], $data['bodega'], $data['sucursal'], $data['moneda'], $data['precio'], $data['materiales'], $data['descripcion'])) {
    
    $codigo = trim($data['codigo']);
    $nombre = trim($data['nombre']);
    $bodega = $data['bodega'];
    $sucursal = $data['sucursal'];
    $moneda = $data['moneda'];
    $precio = trim($data['precio']);
    $materiales = $data['materiales'];
    $descripcion = trim($data['descripcion']);

    if (!preg_match("/^(?=.*[a-zA-Z])(?=.*\d)[A-Za-z\d]{5,15}$/", $codigo)) {
        die(json_encode(["success" => false, "message" => "Código inválido."]));
    }

    if (strlen($nombre) < 2 || strlen($nombre) > 50) {
        die(json_encode(["success" => false, "message" => "Nombre inválido."]));
    }

    if (!is_numeric($precio) || $precio <= 0) {
        die(json_encode(["success" => false, "message" => "Precio inválido."]));
    }

    if (count($materiales) < 2) {
        die(json_encode(["success" => false, "message" => "Seleccione al menos dos materiales."]));
    }

    if (strlen($descripcion) < 10 || strlen($descripcion) > 1000) {
        die(json_encode(["success" => false, "message" => "Descripción inválida."]));
    }

    $stmt = $pdo->prepare("SELECT id FROM productos WHERE codigo = ?");
    $stmt->execute([$codigo]);

    if ($stmt->fetch()) {
        die(json_encode(["success" => false, "message" => "El código ya está registrado."]));
    }

    // Insertar datos
    $stmt = $pdo->prepare("INSERT INTO productos (codigo, nombre, bodega_id, sucursal_id, moneda, precio, materiales, descripcion) 
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->execute([$codigo, $nombre, $bodega, $sucursal, $moneda, $precio, implode(", ", $materiales), $descripcion]);

    echo json_encode(["success" => true]);
}
?>
