<?php
include "conectar.php";

$busca = $_GET['busca'] ?? '';

$status = "";
$titulo = "";
$mensagem = "";
$produto = null;

if ($busca == '') {
    $status = "erro";
    $titulo = "Nenhum produto informado";
    $mensagem = "Volte para a tela de localização e informe um produto ou código.";
} else {

    $sql = "SELECT * FROM produtos 
            WHERE codigo_barras = '$busca'
            OR codigo = '$busca'
            OR nome LIKE '%$busca%'";

    $resultado = mysqli_query($conn, $sql);

    if (!$resultado) {
        $status = "erro";
        $titulo = "Erro na consulta";
        $mensagem = mysqli_error($conn);
    } else {
        $produto = mysqli_fetch_assoc($resultado);

        if (!$produto) {
            $status = "erro";
            $titulo = "Produto não encontrado";
            $mensagem = "Nenhum produto foi encontrado com a busca informada.";
        } else {
            $status = "sucesso";
            $titulo = "Produto localizado";
            $mensagem = "A posição do produto foi destacada no mapa do centro de distribuição.";

            $corredorProduto = $produto['corredor'];
            $prateleiraProduto = $produto['prateleira'];
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Mapa do CD - FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<style>
.layout-mapa {
    display: grid;
    grid-template-columns: 360px 1fr;
    gap: 24px;
    align-items: start;
}

.info-produto {
    background: #f9fafb;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 18px;
}

.info-produto p {
    margin-bottom: 12px;
    color: #374151;
}

.info-produto strong {
    color: #111827;
}

.mapa-area {
    background: white;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 24px;
}

.legenda {
    display: flex;
    gap: 18px;
    margin-bottom: 20px;
    font-size: 14px;
    color: #64748b;
}

.legenda-item {
    display: flex;
    align-items: center;
    gap: 8px;
}

.quadrado-legenda {
    width: 18px;
    height: 18px;
    border-radius: 4px;
    border: 1px solid #cbd5e1;
    background: #f1f5f9;
}

.quadrado-legenda.ativo-legenda {
    background: #b91c1c;
    border-color: #7f1d1d;
}

.grade {
    display: grid;
    grid-template-columns: repeat(4, 90px);
    gap: 14px;
}

.posicao {
    width: 90px;
    height: 90px;
    background: #f1f5f9;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    color: #334155;
    transition: 0.2s;
}

.posicao:hover {
    background: #e5e7eb;
}

.ativo {
    background: #b91c1c;
    color: white;
    border: 3px solid #7f1d1d;
    box-shadow: 0 0 0 4px rgba(185, 28, 28, 0.18);
    animation: destaque 1s infinite alternate;
}

@keyframes destaque {
    from {
        transform: scale(1);
    }
    to {
        transform: scale(1.05);
    }
}

.erro-box {
    max-width: 620px;
}

.audio-box {
    margin-top: 18px;
    padding: 16px;
    background: #f9fafb;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
}

@media(max-width: 900px) {
    .layout-mapa {
        grid-template-columns: 1fr;
    }

    .grade {
        grid-template-columns: repeat(3, 90px);
    }
}

@media(max-width: 420px) {
    .grade {
        grid-template-columns: repeat(2, 90px);
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

    <span>Mapa do CD</span>
</div>

<div class="container">

<?php if($status == "erro"){ ?>

    <div class="card erro-box">
        <div class="titulo">
            <h2><?php echo $titulo; ?></h2>
            <p><?php echo $mensagem; ?></p>
        </div>

        <div class="acoes">
            <a href="localizar.php" class="btn">Voltar para Localização</a>
            <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
        </div>
    </div>

<?php } else { ?>

    <div class="titulo">
        <h2>Mapa do Centro de Distribuição</h2>
        <p><?php echo $mensagem; ?></p>
    </div>

    <div class="layout-mapa">

        <div class="card">

            <div class="titulo">
                <h2><?php echo $produto['nome']; ?></h2>
                <p>Informações do produto localizado.</p>
            </div>

            <div class="info-produto">
                <p><strong>Código:</strong> <?php echo $produto['codigo']; ?></p>
                <p><strong>Código de barras:</strong> <?php echo $produto['codigo_barras']; ?></p>
                <p><strong>Estoque:</strong> <?php echo $produto['estoque']; ?></p>
                <p><strong>Corredor:</strong> <?php echo $produto['corredor']; ?></p>
                <p><strong>Prateleira:</strong> <?php echo $produto['prateleira']; ?></p>
                <p><strong>Nível:</strong> <?php echo $produto['nivel']; ?></p>
            </div>

            <div class="audio-box">
                <p style="margin-bottom: 12px; color:#64748b;">
                    Use o som para auxiliar na localização do produto.
                </p>

                <audio id="beep" src="beep.mp3"></audio>

                <button onclick="tocarSom()">Testar Som</button>
            </div>

            <div class="acoes">
                <a href="localizar.php" class="btn btn-secundario">Nova Busca</a>
                <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
            </div>

        </div>

        <div class="mapa-area">

            <div class="legenda">
                <div class="legenda-item">
                    <div class="quadrado-legenda"></div>
                    Posição livre
                </div>

                <div class="legenda-item">
                    <div class="quadrado-legenda ativo-legenda"></div>
                    Produto encontrado
                </div>
            </div>

            <div class="grade">

                <?php
                $corredores = ['A','B','C'];

                foreach($corredores as $corredor){
                    for($p = 1; $p <= 4; $p++){

                        $ativo = ($corredor == $corredorProduto && $p == $prateleiraProduto) ? "ativo" : "";

                        echo "<div class='posicao $ativo'>$corredor$p</div>";
                    }
                }
                ?>

            </div>

        </div>

    </div>

<?php } ?>

</div>

<script>
function tocarSom() {
    document.getElementById("beep").play();
}
</script>
<script src="assets/tema.js"></script>
</body>
</html>