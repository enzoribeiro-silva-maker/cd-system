<?php

include "conectar.php";

$busca = $_GET['busca'] ?? '';

$sql = "SELECT * FROM produtos
WHERE nome LIKE '%$busca%'
OR codigo LIKE '%$busca%'
OR codigo_barras LIKE '%$busca%'";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Resultado da Busca - FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<style>
.tabela-container {
    width: 100%;
    overflow-x: auto;
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
    padding: 30px;
    color: #64748b;
}
</style>
</head>

<body>

<div class="topo">
    <div>
        <h1>FindWare</h1>
        <span>Sistema Inteligente de Localização de Produtos</span>
    </div>

    <span>Resultado da Busca</span>
</div>

<div class="container">

    <div class="card">

        <div class="titulo">
            <h2>Resultado da Busca</h2>
            <p>Busca realizada por: <strong><?php echo $busca; ?></strong></p>
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

                <?php if(mysqli_num_rows($resultado) > 0): ?>

                    <?php while($produto = mysqli_fetch_assoc($resultado)): ?>

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
                        </td>
                    </tr>

                    <?php endwhile; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="8" class="vazio">
                            Nenhum produto encontrado com essa busca.
                        </td>
                    </tr>

                <?php endif; ?>

            </table>

        </div>

        <div class="acoes">
            <a href="buscar_produto.php" class="btn">Nova Busca</a>
            <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
        </div>

    </div>

</div>
<script src="assets/tema.js"></script>
</body>
</html>