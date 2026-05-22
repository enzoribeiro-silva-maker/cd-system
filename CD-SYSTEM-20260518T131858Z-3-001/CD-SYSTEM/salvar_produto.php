<?php

include "conectar.php";

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$corredor = $_POST['corredor'];
$prateleira = $_POST['prateleira'];
$estoque = $_POST['estoque'];

$sql = "INSERT INTO produtos
(nome, codigo, corredor, prateleira, estoque)

VALUES

('$nome', '$codigo', '$corredor', '$prateleira', '$estoque')";

if(mysqli_query($conn, $sql)) {

    echo "Produto cadastrado!";

} else {

    echo "Erro ao cadastrar produto";
}