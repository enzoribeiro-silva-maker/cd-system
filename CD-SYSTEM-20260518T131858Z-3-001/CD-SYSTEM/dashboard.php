<?php

include "conectar.php";

// TOTAL DE PRODUTOS

$sqlProdutos = "SELECT COUNT(*) as total FROM produtos";

$resultadoProdutos = mysqli_query($conn, $sqlProdutos);

$totalProdutos = mysqli_fetch_assoc($resultadoProdutos);


// TOTAL DE ESTOQUE

$sqlEstoque = "SELECT SUM(estoque) as estoque_total FROM produtos";

$resultadoEstoque = mysqli_query($conn, $sqlEstoque);

$totalEstoque = mysqli_fetch_assoc($resultadoEstoque);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Dashboard</title>

<style>

body{

    font-family:Arial;
    background:#f4f4f4;
    padding:40px;

}

h1{

    margin-bottom:30px;

}

.card{

    background:white;
    width:300px;
    padding:20px;
    margin-bottom:20px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,0.1);

}

.numero{

    font-size:40px;
    font-weight:bold;
    color:green;

}

</style>

</head>

<body>

<h1>Dashboard do CD</h1>

<div class="card">

<h2>Total de Produtos</h2>

<div class="numero">

<?php
echo $totalProdutos['total'];
?>

</div>

</div>

<div class="card">

<h2>Total em Estoque</h2>

<div class="numero">

<?php
echo $totalEstoque['estoque_total'];
?>

</div>

</div>

</body>
</html>