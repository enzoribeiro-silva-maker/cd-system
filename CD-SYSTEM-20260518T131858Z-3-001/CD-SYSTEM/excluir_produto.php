<?php
include "conectar.php";

$id = $_GET['id'] ?? '';

if ($id == '') {
    $status = "erro";
    $titulo = "Produto não informado";
    $mensagem = "Nenhum produto foi selecionado para exclusão.";
} else {

    $sql = "DELETE FROM produtos WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        $status = "sucesso";
        $titulo = "Produto excluído com sucesso!";
        $mensagem = "O produto foi removido do cadastro do FindWare.";
    } else {
        $status = "erro";
        $titulo = "Erro ao excluir produto";
        $mensagem = mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Excluir Produto - FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<style>
.resultado {
    min-height: calc(100vh - 72px);
    display: flex;
    align-items: center;
    justify-content: center;
}

.resultado-card {
    width: 100%;
    max-width: 540px;
    text-align: center;
}

.icone-status {
    width: 66px;
    height: 66px;
    border-radius: 50%;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: bold;
}

.icone-status.sucesso {
    background: #dcfce7;
    color: #166534;
}

.icone-status.erro {
    background: #fee2e2;
    color: #991b1b;
}
</style>
</head>

<body>

<div class="topo">
    <div>
        <h1>FindWare</h1>
        <span>Sistema Inteligente de Localização de Produtos</span>
    </div>

    <span>Excluir Produto</span>
</div>

<div class="container resultado">

    <div class="card resultado-card">

        <div class="icone-status <?php echo $status; ?>">
            <?php echo $status == "sucesso" ? "✓" : "!"; ?>
        </div>

        <div class="titulo">
            <h2><?php echo $titulo; ?></h2>
            <p><?php echo $mensagem; ?></p>
        </div>

        <div class="acoes">
            <a href="dashboard.php" class="btn">Voltar ao Dashboard</a>
            <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
        </div>

    </div>

</div>
<script src="assets/tema.js"></script>
</body>
</html>