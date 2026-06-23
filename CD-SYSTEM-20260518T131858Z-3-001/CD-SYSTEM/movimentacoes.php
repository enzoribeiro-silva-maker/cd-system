<?php
include "conectar.php";

$sql = "SELECT * FROM movimentacoes ORDER BY data_movimentacao DESC";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Histórico de Movimentações - FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<style>
.tabela-container {
    width: 100%;
    overflow-x: auto;
}

.badge {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: bold;
}

.badge.entrada {
    background: #dcfce7;
    color: #166534;
}

.badge.saida {
    background: #fee2e2;
    color: #991b1b;
}

.vazio {
    text-align: center;
    padding: 30px;
    color: #64748b;
}

.codigo {
    color: #64748b;
    font-size: 13px;
}
</style>
</head>

<body>

<div class="topo">
    <div>
        <h1>FindWare</h1>
        <span>Sistema Inteligente de Localização de Produtos</span>
    </div>

    <span>Histórico de Movimentações</span>
</div>

<div class="container">

    <div class="card">

        <div class="titulo">
            <h2>Histórico de Movimentações</h2>
            <p>Consulte todas as entradas e saídas registradas no estoque.</p>
        </div>

        <div class="tabela-container">

            <table>
                <tr>
                    <th>Produto</th>
                    <th>Código</th>
                    <th>Quantidade</th>
                    <th>Tipo</th>
                    <th>Localização / Motivo</th>
                    <th>Data</th>
                </tr>

                <?php if(mysqli_num_rows($resultado) > 0): ?>

                    <?php while($mov = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?php echo $mov['produto']; ?></td>

                        <td class="codigo">
                            <?php echo $mov['codigo_barras'] ?? '-'; ?>
                        </td>

                        <td><?php echo $mov['quantidade']; ?></td>

                        <td>
                            <span class="badge <?php echo strtolower($mov['tipo']); ?>">
                                <?php echo $mov['tipo']; ?>
                            </span>
                        </td>

                        <td><?php echo $mov['localizacao']; ?></td>

                        <td><?php echo $mov['data_movimentacao']; ?></td>
                    </tr>
                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="6" class="vazio">
                            Nenhuma movimentação registrada até o momento.
                        </td>
                    </tr>

                <?php endif; ?>

            </table>

        </div>

        <div class="acoes">
            <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
            <a href="recebimento.php" class="btn">Novo Recebimento</a>
            <a href="saida_produto.php" class="btn btn-secundario">Nova Saída</a>
        </div>

    </div>

</div>

</body>
</html>