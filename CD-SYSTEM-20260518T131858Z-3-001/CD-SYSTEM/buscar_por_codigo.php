<?php
include "conectar.php";

$codigo = $_GET['codigo'] ?? '';

$sql = "SELECT * FROM produtos 
        WHERE codigo_barras = '$codigo'
        OR codigo = '$codigo'
        LIMIT 1";

$resultado = mysqli_query($conn, $sql);
$produto = mysqli_fetch_assoc($resultado);

header('Content-Type: application/json');

if($produto){
    echo json_encode([
        "encontrado" => true,
        "nome" => $produto['nome'],
        "codigo_barras" => $produto['codigo_barras'],
        "codigo" => $produto['codigo'],
        "corredor" => $produto['corredor'],
        "prateleira" => $produto['prateleira'],
        "nivel" => $produto['nivel']
    ]);
}else{
    echo json_encode([
        "encontrado" => false
    ]);
}
?>
