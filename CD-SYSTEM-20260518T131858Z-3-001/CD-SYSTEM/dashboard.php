<?php
include "conectar.php";

$totalProdutos = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produtos"));
$totalEstoque = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(estoque) AS total FROM produtos"));
$entradas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM movimentacoes WHERE tipo = 'ENTRADA'"));
$saidas = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM movimentacoes WHERE tipo = 'SAIDA'"));
$estoqueBaixo = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM produtos WHERE estoque <= 5"));

$produtos = mysqli_query($conn, "SELECT * FROM produtos ORDER BY nome ASC");
$ultimas = mysqli_query($conn, "SELECT * FROM movimentacoes ORDER BY data_movimentacao DESC LIMIT 5");
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Dashboard - FindWare</title>
<link rel="stylesheet" href="assets/style.css">
<script src="assets/tema.js" defer></script>

<style>
.cards-dashboard {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 16px;
    margin-bottom: 24px;
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
    font-size: 34px;
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

.badge-estoque {
    display: inline-block;
    padding: 6px 10px;
    border-radius: 999px;
    font-size: 12px;
    font-weight: bold;
}

.estoque-ok {
    background: #dcfce7;
    color: #166534;
}

.estoque-baixo {
    background: #fee2e2;
    color: #991b1b;
}

.vazio {
    text-align: center;
    padding: 28px;
    color: #64748b;
}

.card + .card {
    margin-top: 24px;
}
.acoes-tabela {
    display: flex;
    gap: 8px;
    flex-wrap: wrap;
}

.acoes-tabela .btn {
    padding: 8px 12px;
    font-size: 13px;
}

.btn-perigo {
    background: #b91c1c;
    color: white;
}

.btn-perigo:hover {
    background: #991b1b;
}

@media(max-width: 1100px) {
    .cards-dashboard {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media(max-width: 650px) {
    .cards-dashboard {
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

    <span>Dashboard do CD</span>
</div>

<div class="container">

    <div class="titulo">
        <h2>Dashboard do Centro de Distribuição</h2>
        <p>Visão geral dos produtos, estoque e movimentações do sistema.</p>
    </div>

    <div class="cards-dashboard">

        <div class="card-indicador">
            <h3>Total de Produtos</h3>
            <div class="numero">
                <?php echo $totalProdutos['total']; ?>
            </div>
        </div>

        <div class="card-indicador">
            <h3>Total em Estoque</h3>
            <div class="numero">
                <?php echo $totalEstoque['total'] ?? 0; ?>
            </div>
        </div>

        <div class="card-indicador">
            <h3>Entradas</h3>
            <div class="numero entrada">
                <?php echo $entradas['total']; ?>
            </div>
        </div>

        <div class="card-indicador">
            <h3>Saídas</h3>
            <div class="numero saida">
                <?php echo $saidas['total']; ?>
            </div>
        </div>

        <div class="card-indicador">
            <h3>Estoque Baixo</h3>
            <div class="numero alerta">
                <?php echo $estoqueBaixo['total']; ?>
            </div>
        </div>

    </div>

    <div class="card">

        <div class="titulo">
            <h2>Produtos Cadastrados</h2>
            <p>Lista completa dos produtos cadastrados no sistema.</p>
        </div>

        <div class="tabela-container">

            <table>
                <tr>
                    <th>Produto</th>
                    <th>Código</th>
                    <th>Código de Barras</th>
                    <th>Corredor</th>
                    <th>Prateleira</th>
                    <th>Nível</th>
                    <th>Estoque</th>
                    <th>Ações</th>
                </tr>

                <?php if(mysqli_num_rows($produtos) > 0): ?>

                    <?php while($produto = mysqli_fetch_assoc($produtos)): ?>

                    <tr>
                        <td><?php echo $produto['nome']; ?></td>
                        <td><?php echo $produto['codigo']; ?></td>
                        <td><?php echo $produto['codigo_barras']; ?></td>
                        <td><?php echo $produto['corredor']; ?></td>
                        <td><?php echo $produto['prateleira']; ?></td>
                        <td><?php echo $produto['nivel']; ?></td>

                        <td>
                            <span class="badge-estoque <?php echo $produto['estoque'] <= 5 ? 'estoque-baixo' : 'estoque-ok'; ?>">
                                <?php echo $produto['estoque']; ?>
                            </span>
                        </td>

                        <td>
                            <a href="mapa.php?busca=<?php echo $produto['codigo']; ?>" class="btn">
                                Ver Mapa
                            </a>

                            <a 
                               href="excluir_produto.php?id=<?php echo $produto['id']; ?>" class="btn btn-perigo"
                               onclick="return confirm('Tem certeza que deseja excluir este produto?')">
                                Excluir
                            </a>
                        </td>
                    </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="vazio">
                            Nenhum produto cadastrado até o momento.
                        </td>
                    </tr>

                <?php endif; ?>

            </table>

        </div>

    </div>

    <div class="card">

        <div class="titulo">
            <h2>Resumo das Últimas Movimentações</h2>
            <p>Confira os últimos registros de entrada e saída do estoque.</p>
        </div>

        <div class="tabela-container">

            <table>
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Tipo</th>
                    <th>Localização / Motivo</th>
                    <th>Data</th>
                </tr>

                <?php if(mysqli_num_rows($ultimas) > 0): ?>

                    <?php while($mov = mysqli_fetch_assoc($ultimas)): ?>

                    <tr>
                        <td><?php echo $mov['produto']; ?></td>
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
                        <td colspan="5" class="vazio">
                            Nenhuma movimentação registrada até o momento.
                        </td>
                    </tr>

                <?php endif; ?>

            </table>

        </div>

        <div class="acoes">
            <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
            <a href="movimentacoes.php" class="btn">Ver Histórico Completo</a>
        </div>

    </div>

</div>
<script src="assets/tema.js"></script>
</body>
</html>