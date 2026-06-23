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

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family: Arial, sans-serif;
}

body{
    background:#eef1f5;
    color:#1f2937;
}

.topo{
    height:72px;
    background:#17202c;
    color:white;
    display:flex;
    align-items:center;
    justify-content:space-between;
    padding:0 36px;
}

.topo h1{
    font-size:22px;
}

.topo span{
    font-size:14px;
    color:#cbd5e1;
}

.container{
    padding:28px 36px;
}

.indicadores{
    display:grid;
    grid-template-columns:repeat(5,1fr);
    gap:16px;
    margin-bottom:28px;
}

.card{
    background:white;
    border:1px solid #d5dbe3;
    border-radius:6px;
    padding:18px;
}

.card h3{
    font-size:14px;
    color:#4b5563;
    margin-bottom:10px;
    font-weight:600;
}

.numero{
    font-size:30px;
    font-weight:700;
    color:#111827;
}

.area{
    background:white;
    border:1px solid #d5dbe3;
    border-radius:6px;
    padding:22px;
}

.area h2{
    font-size:18px;
    margin-bottom:18px;
    color:#111827;
}

.menu{
    display:grid;
    grid-template-columns:repeat(3,1fr);
    gap:14px;
}

.botao{
    background:#f9fafb;
    border:1px solid #d5dbe3;
    padding:18px;
    text-decoration:none;
    color:#111827;
    font-weight:600;
    border-radius:5px;
}

.botao:hover{
    background:#e5e7eb;
}

.sair{
    background:#b91c1c;
    color:white;
    border:none;
}

.sair:hover{
    background:#991b1b;
}

.rodape{
    margin-top:18px;
    font-size:13px;
    color:#6b7280;
}

@media(max-width:1000px){
    .indicadores{
        grid-template-columns:repeat(2,1fr);
    }

    .menu{
        grid-template-columns:1fr;
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

    <div class="indicadores">
        <div class="card">
            <h3>Produtos cadastrados</h3>
            <div class="numero"><?php echo $totalProdutos['total']; ?></div>
        </div>

        <div class="card">
            <h3>Estoque total</h3>
            <div class="numero"><?php echo $totalEstoque['total'] ?? 0; ?></div>
        </div>

        <div class="card">
            <h3>Entradas</h3>
            <div class="numero"><?php echo $entradas['total']; ?></div>
        </div>

        <div class="card">
            <h3>Saídas</h3>
            <div class="numero"><?php echo $saidas['total']; ?></div>
        </div>

        <div class="card">
            <h3>Estoque baixo</h3>
            <div class="numero"><?php echo $estoqueBaixo['total']; ?></div>
        </div>
    </div>

    <div class="area">
        <h2>Operações do Sistema</h2>

        <div class="menu">
            <a class="botao" href="recebimento.php">Recebimento de Produtos</a>
            <a class="botao" href="saida_produto.php">Saída de Produtos</a>
            <a class="botao" href="cadastrar_produto.php">Cadastrar Produto</a>
            <a class="botao" href="localizar.php">Localizar Produto</a>
            <a class="botao" href="procurar_produto.php">Procurar Produto Perdido</a>
            <a class="botao" href="movimentacoes.php">Histórico de Movimentações</a>
            <a class="botao sair" href="logout.php">Sair do Sistema</a>
        </div>
    </div>

    <div class="rodape">
        FindWare • Sistema Inteligente de Localização de Produtos
    </div>

</div>

</body>
</html>