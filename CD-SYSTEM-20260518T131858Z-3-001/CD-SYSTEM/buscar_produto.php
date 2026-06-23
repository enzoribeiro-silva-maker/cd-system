<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Buscar Produto - FindWare</title>
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

    <span>Buscar Produto</span>
</div>

<div class="container">

    <div class="card busca-box">

        <div class="titulo">
            <h2>Buscar Produto</h2>
            <p>Consulte um produto cadastrado pelo nome, código interno ou código de barras.</p>
        </div>

        <form action="resultado_busca.php" method="GET">

            <label>Nome ou código do produto</label>

            <div class="campo-busca">
                <input 
                    type="text" 
                    name="busca" 
                    placeholder="Digite o nome ou código"
                    required>

                <button type="submit">
                    Buscar
                </button>
            </div>

        </form>

        <div class="dicas">
            <h3>Exemplos de busca</h3>
            <p>Você pode pesquisar por nome do produto, código interno, código de barras ou QR Code.</p>
            <p>Para localizar no mapa, use a tela “Localizar Produto”.</p>
        </div>

        <div class="acoes">
            <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
        </div>

    </div>

</div>

</body>
</html>