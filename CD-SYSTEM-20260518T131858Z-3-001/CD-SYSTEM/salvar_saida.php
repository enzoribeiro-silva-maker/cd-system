<?php
include "conectar.php";

$codigo_barras = $_POST['codigo_barras'];
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];
$motivo = $_POST['motivo'];

$sql = "INSERT INTO movimentacoes 
(produto, quantidade, localizacao, tipo, data)
VALUES 
('$produto', '$quantidade', '$motivo', 'SAIDA', NOW())";

if (mysqli_query($conn, $sql)) {
    echo "<h2>Saída registrada com sucesso!</h2>";
    echo "<a href='saida_produto.php'>Registrar nova saída</a><br>";
    echo "<a href='historico.php'>Ver histórico</a>";
} else {
    echo "Erro ao registrar saída: " . mysqli_error($conn);
}
?>