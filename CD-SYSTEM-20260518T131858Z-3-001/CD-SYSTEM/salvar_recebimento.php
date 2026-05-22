<?php

include "conectar.php";

$codigo_barras = $_POST['codigo_barras'];
$produto = $_POST['produto'];
$quantidade = $_POST['quantidade'];

$corredor = strtoupper($_POST['corredor']);
$prateleira = $_POST['prateleira'];
$nivel = $_POST['nivel'];

$local = $corredor . "-" . $prateleira . "-N" . $nivel;

$sql = "INSERT INTO produtos 
(nome, codigo_barras, estoque, corredor)

VALUES

('$produto', '$codigo_barras', '$quantidade', '$local')";

$sqlMovimentacao = "INSERT INTO movimentacoes 
(produto, quantidade, localizacao)

VALUES

('$produto', '$quantidade', '$local')";

if (mysqli_query($conn, $sql) && mysqli_query($conn, $sqlMovimentacao)) {

    echo "Recebimento salvo e movimentação registrada!";

} else {

    echo "Erro: " . mysqli_error($conn);

}

?>