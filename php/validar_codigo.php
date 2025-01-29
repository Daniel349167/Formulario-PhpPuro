<?php
require 'conexion.php';

if (!isset($_GET["codigo"]) || empty($_GET["codigo"])) {
    echo json_encode(["unico" => false]);
    exit;
}

$codigo = $_GET["codigo"];

$stmt = $pdo->prepare("SELECT COUNT(*) FROM productos WHERE codigo = ?");
$stmt->execute([$codigo]);
$existe = $stmt->fetchColumn() > 0;

header("Content-Type: application/json");
echo json_encode(["unico" => !$existe]);
?>
