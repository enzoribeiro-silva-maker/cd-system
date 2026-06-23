<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit;
}

include "conectar.php";

$totalProdutos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produtos"));
$totalEstoque = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(estoque) AS total FROM produtos"));
$entradas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM movimentacoes WHERE tipo='ENTRADA'"));
$saidas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM movimentacoes WHERE tipo='SAIDA'"));
$estoqueBaixo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produtos WHERE estoque <= 5"));
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<style>
.indicadores {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
    margin-bottom: 28px;
}

.card-indicador {
    background: white;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 20px;
}

.card-indicador h3 {
    font-size: 14px;
    color: #64748b;
    margin-bottom: 10px;
}

.numero {
    font-size: 32px;
    font-weight: bold;
    color: #17202c;
}

.numero.entrada {
    color: #166534;
}

.numero.saida {
    color: #991b1b;
}

.numero.alerta {
    color: #b45309;
}

.area-menu {
    background: white;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 25px;
}

.area-menu h2 {
    font-size: 22px;
    margin-bottom: 8px;
    color: #111827;
}

.area-menu p {
    color: #64748b;
    margin-bottom: 20px;
}

.menu-operacoes {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
}

.item-menu {
    background: #f9fafb;
    border: 1px solid #d5dbe3;
    padding: 18px;
    text-decoration: none;
    color: #111827;
    font-weight: bold;
    border-radius: 8px;
    transition: 0.2s;
}

.item-menu:hover {
    background: #e5e7eb;
    transform: translateY(-2px);
}

.item-sair {
    background: #b91c1c;
    color: white;
    border-color: #b91c1c;
}

.item-sair:hover {
    background: #991b1b;
}

.rodape {
    margin-top: 18px;
    font-size: 13px;
    color: #64748b;
}

@media(max-width: 1100px) {
    .indicadores {
        grid-template-columns: repeat(2, 1fr);
    }

    .menu-operacoes {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 650px) {
    .indicadores,
    .menu-operacoes {
        grid-template-columns: 1fr;
    }
}
</style>
</head>

<body>

<div class="topo">
    <div>
        <h1>FindWare</h1>
        <span>Sistema Inteligente de Localização de Produtos</span>
    </div>

    <span>Usuário: <?php echo $_SESSION['usuario']; ?></span>
</div>

<div class="container">

    <div class="titulo">
        <h2>Painel Principal</h2>
        <p>Controle de estoque, localização, recebimento, saída e movimentações do CD.</p>
    </div>

    <div class="indicadores">

        <div class="card-indicador">
            <h3>Produtos cadastrados</h3>
            <div class="numero"><?php echo $totalProdutos['total']; ?></div>
        </div>

        <div class="card-indicador">
            <h3>Estoque total</h3>
            <div class="numero"><?php echo $totalEstoque['total'] ?? 0; ?></div>
        </div>

        <div class="card-indicador">
            <h3>Entradas</h3>
            <div class="numero entrada"><?php echo $entradas['total']; ?></div>
        </div>

        <div class="card-indicador">
            <h3>Saídas</h3>
            <div class="numero saida"><?php echo $saidas['total']; ?></div>
        </div>

        <div class="card-indicador">
            <h3>Estoque baixo</h3>
            <div class="numero alerta"><?php echo $estoqueBaixo['total']; ?></div>
        </div>

    </div>

    <div class="area-menu">

        <h2>Operações do Sistema</h2>
        <p>Escolha uma funcionalidade para continuar.</p>

        <div class="menu-operacoes">
            <a class="item-menu" href="dashboard.php">Dashboard Completo</a>
            <a class="item-menu" href="recebimento.php">Recebimento de Produtos</a>
            <a class="item-menu" href="saida_produto.php">Saída de Produtos</a>
            <a class="item-menu" href="cadastrar_produto.php">Cadastrar Produto</a>
            <a class="item-menu" href="buscar_produto.php">Buscar Produto</a>
            <a class="item-menu" href="localizar.php">Localizar Produto</a>
            <a class="item-menu" href="procurar_produto.php">Procurar Produto Perdido</a>
            <a class="item-menu" href="movimentacoes.php">Histórico de Movimentações</a>
            <a class="item-menu" href="scanner.php">Scanner</a>
            <a class="item-menu item-sair" href="logout.php">Sair do Sistema</a>
        </div>

    </div>

    <div class="rodape">
        FindWare • Sistema Inteligente de Localização de Produtos
    </div>

</div>

</body>
</html>