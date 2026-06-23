<?php

include "conectar.php";

$nome = $_POST['nome'];
$codigo = $_POST['codigo'];
$codigo_barras = $_POST['codigo_barras'];
$estoque = $_POST['estoque'];

$corredor = strtoupper($_POST['corredor']);

$prateleira = $_POST['prateleira'];
$nivel = $_POST['nivel'];

$sql = "INSERT INTO produtos
(
nome,
codigo,
codigo_barras,
corredor,
prateleira,
nivel,
estoque
)

VALUES
(
'$nome',
'$codigo',
'$codigo_barras',
'$corredor',
'$prateleira',
'$nivel',
'$estoque'
)";

if(mysqli_query($conn,$sql)){

    echo "<h2>Produto cadastrado com sucesso!</h2>";

    echo "<a href='cadastrar_produto.php'>
    Cadastrar outro produto
    </a>";

}else{

    echo "Erro: " . mysqli_error($conn);

}
?>