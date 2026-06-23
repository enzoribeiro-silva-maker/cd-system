<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Localizar Produto - FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<style>
.busca-box {
    max-width: 720px;
}

.campo-busca {
    display: flex;
    gap: 12px;
}

.campo-busca input {
    margin-bottom: 0;
}

.campo-busca button {
    white-space: nowrap;
}

.dicas {
    margin-top: 22px;
    background: #f9fafb;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 16px;
}

.dicas h3 {
    font-size: 16px;
    margin-bottom: 10px;
    color: #111827;
}

.dicas p {
    color: #64748b;
    font-size: 14px;
    margin-bottom: 6px;
}

@media(max-width: 700px) {
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

    <span>Localizar Produto</span>
</div>

<div class="container">

    <div class="card busca-box">

        <div class="titulo">
            <h2>Localizar Produto no CD</h2>
            <p>Busque um produto pelo nome, código interno, código de barras ou QR Code.</p>
        </div>

        <form action="mapa.php" method="GET">

            <label>Produto ou código</label>

            <div class="campo-busca">
                <input 
                    type="text" 
                    name="busca"
                    placeholder="Digite o código ou nome do produto"
                    required>

                <button type="submit">
                    Buscar Produto
                </button>
            </div>

        </form>

        <div class="dicas">
            <h3>Como usar</h3>
            <p>Digite o código cadastrado no produto ou o nome do item.</p>
            <p>Após buscar, o sistema abrirá o mapa indicando a posição do produto no CD.</p>
        </div>

        <div class="acoes">
            <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
        </div>

    </div>

</div>
<script src="assets/tema.js"></script>
</body>
</html>