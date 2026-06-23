<?php
include "conectar.php";

$produto = null;

if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];

    $sql = "SELECT * FROM produtos 
            WHERE codigo_barras = '$busca'
            OR codigo = '$busca'
            OR nome LIKE '%$busca%'";

    $resultado = mysqli_query($conn, $sql);
    $produto = mysqli_fetch_assoc($resultado);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Procurar Produto Perdido - FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<style>
.busca-card {
    max-width: 760px;
}

.campo-busca {
    display: flex;
    gap: 12px;
}

.campo-busca input {
    margin-bottom: 0;
}

.produto-layout {
    display: grid;
    grid-template-columns: 360px 1fr;
    gap: 22px;
    margin-top: 22px;
}

.info-produto {
    background: #f9fafb;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 18px;
}

.info-produto p {
    margin-bottom: 10px;
    color: #374151;
}

.info-produto strong {
    color: #111827;
}

.busca-sinal {
    background: white;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 24px;
}

.status {
    font-size: 22px;
    font-weight: bold;
    color: #17202c;
    margin-top: 18px;
    margin-bottom: 14px;
}

.barra {
    width: 100%;
    height: 32px;
    background: #e5e7eb;
    border-radius: 999px;
    overflow: hidden;
    border: 1px solid #cbd5e1;
}

#progresso {
    width: 0%;
    height: 100%;
    background: #16a34a;
    transition: 0.5s;
}

.form-atualizar {
    display: none;
    margin-top: 22px;
    padding: 18px;
    background: #f9fafb;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
}

.btn-encontrado {
    background: #16a34a;
}

.btn-encontrado:hover {
    background: #15803d;
}

.btn-busca {
    background: #17202c;
}

.nao-encontrado {
    max-width: 620px;
}

@media(max-width: 900px) {
    .produto-layout {
        grid-template-columns: 1fr;
    }

    .campo-busca {
        flex-direction: column;
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

    <span>Procurar Produto Perdido</span>
</div>

<div class="container">

    <div class="card busca-card">

        <div class="titulo">
            <h2>Procurar Produto Perdido</h2>
            <p>
                Simule a busca de um produto dentro do centro de distribuição usando sinal de proximidade e alerta sonoro.
            </p>
        </div>

        <form method="GET">

            <label>Produto ou código</label>

            <div class="campo-busca">
                <input
                    type="text"
                    name="busca"
                    placeholder="Digite ou bipe o código do produto"
                    required>

                <button type="submit">
                    Buscar Produto
                </button>
            </div>

        </form>

        <div class="acoes">
            <a href="menu.php" class="btn btn-secundario">
                Voltar ao Menu
            </a>
        </div>

    </div>

    <?php if ($produto): ?>

        <div class="produto-layout">

            <div class="card">

                <div class="titulo">
                    <h2><?php echo $produto['nome']; ?></h2>
                    <p>Produto encontrado no cadastro.</p>
                </div>

                <div class="info-produto">
                    <p><strong>Código:</strong> <?php echo $produto['codigo_barras']; ?></p>
                    <p><strong>Estoque:</strong> <?php echo $produto['estoque']; ?></p>
                    <p><strong>Corredor:</strong> <?php echo $produto['corredor']; ?></p>
                    <p><strong>Prateleira:</strong> <?php echo $produto['prateleira']; ?></p>
                    <p><strong>Nível:</strong> <?php echo $produto['nivel']; ?></p>
                </div>

                <div class="acoes">
                    <a href="mapa.php?busca=<?php echo $produto['codigo_barras']; ?>" class="btn">
                        Ver no Mapa
                    </a>

                    <a href="menu.php" class="btn btn-secundario">
                        Voltar ao Menu
                    </a>
                </div>

            </div>

            <div class="busca-sinal">

                <div class="titulo">
                    <h2>Busca por proximidade</h2>
                    <p>
                        Inicie a busca para simular a aproximação do operador até o produto.
                    </p>
                </div>

                <div class="acoes">
                    <button onclick="iniciarBusca()" class="btn-busca" type="button">
                        Iniciar Busca
                    </button>

                    <button onclick="pararBusca()" class="btn-encontrado" type="button">
                        Produto Encontrado
                    </button>
                </div>

                <div id="status" class="status">
                    Aguardando busca...
                </div>

                <div class="barra">
                    <div id="progresso"></div>
                </div>

                <form
                    id="formAtualizar"
                    class="form-atualizar"
                    action="atualizar_localizacao.php"
                    method="POST">

                    <div class="titulo">
                        <h2>Atualizar localização</h2>
                        <p>
                            Use esta área caso o produto tenha sido encontrado em outro local.
                        </p>
                    </div>

                    <input
                        type="hidden"
                        name="codigo_barras"
                        value="<?php echo $produto['codigo_barras']; ?>">

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Novo corredor</label>
                            <input
                                type="text"
                                name="corredor"
                                placeholder="Ex: B"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Nova prateleira</label>
                            <input
                                type="number"
                                name="prateleira"
                                placeholder="Ex: 2"
                                min="1"
                                required>
                        </div>

                        <div class="form-group">
                            <label>Novo nível</label>
                            <input
                                type="number"
                                name="nivel"
                                placeholder="Ex: 1"
                                min="1"
                                required>
                        </div>

                    </div>

                    <div class="acoes">
                        <button type="submit">
                            Salvar Nova Localização
                        </button>
                    </div>

                </form>

            </div>

        </div>

        <audio id="beep" src="beep.mp3" loop></audio>

    <?php elseif (isset($_GET['busca'])): ?>

        <div class="card nao-encontrado">

            <div class="titulo">
                <h2>Produto não encontrado</h2>
                <p>
                    Nenhum produto foi encontrado com o código ou nome informado.
                </p>
            </div>

            <div class="acoes">
                <a href="procurar_produto.php" class="btn">
                    Tentar Novamente
                </a>

                <a href="menu.php" class="btn btn-secundario">
                    Voltar ao Menu
                </a>
            </div>

        </div>

    <?php endif; ?>

</div>

<script>
let sinal = 0;
let intervalo;

function iniciarBusca() {
    sinal = 0;

    document.getElementById("status").innerHTML = "Buscando sinal do produto...";
    document.getElementById("progresso").style.width = "0%";
    document.getElementById("formAtualizar").style.display = "none";

    intervalo = setInterval(() => {
        sinal += 20;

        document.getElementById("progresso").style.width = sinal + "%";

        if (sinal < 40) {
            document.getElementById("status").innerHTML = "Sinal fraco...";
        } else if (sinal < 80) {
            document.getElementById("status").innerHTML = "Sinal médio...";
        } else {
            document.getElementById("status").innerHTML = "Sinal forte! Produto próximo!";
            document.getElementById("beep").play();
            clearInterval(intervalo);
        }

    }, 1500);
}

function pararBusca() {
    clearInterval(intervalo);

    let beep = document.getElementById("beep");

    if (beep) {
        beep.pause();
        beep.currentTime = 0;
    }

    document.getElementById("status").innerHTML = "Produto encontrado!";
    document.getElementById("formAtualizar").style.display = "block";
}
</script>
<script src="assets/tema.js"></script>
</body>
</html>