<?php
require 'conexion.php';

if (!isset($_GET["bodega"]) || empty($_GET["bodega"])) {
    echo json_encode([]);
    exit;
}

$bodega_id = $_GET["bodega"];

$stmt = $pdo->prepare("SELECT id, nombre FROM sucursales WHERE bodega_id = ?");
$stmt->execute([$bodega_id]);
$sucursales = $stmt->fetchAll();

header("Content-Type: application/json");
echo json_encode($sucursales);
?>
