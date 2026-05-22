<?php

session_start();

if(!isset($_SESSION['usuario'])){

    header("Location: login.php");

    exit;

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Menu Principal</title>

<style>
body{
    font-family:Arial;
    background:#f4f4f4;
    padding:40px;
}

a{
    display:block;
    width:250px;
    background:#222;
    color:white;
    padding:15px;
    margin-bottom:15px;
    text-decoration:none;
    border-radius:8px;
}

a:hover{
    background:green;
}
</style>

</head>
<body>

<h1>Sistema de Localização do CD</h1>

<a href="dashboard.php">Dashboard</a>
<a href="recebimento.php">Recebimento de Produtos</a>
<a href="cadastrar_produto.php">Cadastrar Produto</a>
<a href="localizar.php">Localizar Produto</a>
<a href="movimentacoes.php">Histórico de Movimentações</a>
<a href="logout.php">Sair do Sistema</a>

</body>
</html>