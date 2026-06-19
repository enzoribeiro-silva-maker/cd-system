<?php
include "conectar.php";

$totalProdutos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produtos"));
$totalEstoque = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(estoque) AS total FROM produtos"));
$entradas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM movimentacoes WHERE tipo = 'ENTRADA'"));
$saidas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM movimentacoes WHERE tipo = 'SAIDA'"));
$estoqueBaixo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produtos WHERE estoque <= 5"));

$ultimas = mysqli_query($conn, "SELECT * FROM movimentacoes ORDER BY data_movimentacao DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<style>
body{
    font-family: Arial;
    background: #f4f4f4;
    padding: 40px;
}

.cards{
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.card{
    background: white;
    width: 220px;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px #ccc;
}

.numero{
    font-size: 35px;
    font-weight: bold;
    color: green;
}

table{
    margin-top: 30px;
    width: 100%;
    border-collapse: collapse;
    background: white;
}

th, td{
    padding: 12px;
    border: 1px solid #ccc;
    text-align: left;
}

th{
    background: #222;
    color: white;
}

a{
    display:inline-block;
    margin-top:20px;
}
</style>
</head>

<body>

<h1>Dashboard do CD</h1>

<div class="cards">
    <div class="card">
        <h3>Total de Produtos</h3>
        <div class="numero"><?php echo $totalProdutos['total']; ?></div>
    </div>

    <div class="card">
        <h3>Total em Estoque</h3>
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
        <h3>Estoque Baixo</h3>
        <div class="numero"><?php echo $estoqueBaixo['total']; ?></div>
    </div>
</div>

<h2>Últimas Movimentações</h2>

<table>
<tr>
    <th>Produto</th>
    <th>Quantidade</th>
    <th>Tipo</th>
    <th>Localização</th>
    <th>Data</th>
</tr>

<?php while($mov = mysqli_fetch_assoc($ultimas)): ?>
<tr>
    <td><?php echo $mov['produto']; ?></td>
    <td><?php echo $mov['quantidade']; ?></td>
    <td><?php echo $mov['tipo']; ?></td>
    <td><?php echo $mov['localizacao']; ?></td>
    <td><?php echo $mov['data_movimentacao']; ?></td>
</tr>
<?php endwhile; ?>

</table>

<a href="menu.php">Voltar ao menu</a>

</body>
</html>