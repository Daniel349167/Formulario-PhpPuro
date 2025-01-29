<?php
require 'conexion.php';

$stmt = $pdo->query("SELECT id, nombre FROM bodegas ORDER BY nombre ASC");
$bodegas = $stmt->fetchAll();

header("Content-Type: application/json");
echo json_encode($bodegas);
?>
