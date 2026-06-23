<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro de Produtos - FindWare</title>
<link rel="stylesheet" href="assets/style.css">
<script src="assets/tema.js" defer></script>

</head>

<body>

<div class="topo">
    <div>
        <h1>FindWare</h1>
        <span>Sistema Inteligente de Localização de Produtos</span>
    </div>

    <span>Cadastro de Produtos</span>
</div>

<div class="container">

    <div class="card">

        <div class="titulo">
            <h2>Cadastrar Produto</h2>
            <p>Registre um novo item no estoque e gere automaticamente seu código para localização.</p>
        </div>

        <form action="salvar_produto.php" method="POST">

            <div class="form-grid">

                <div class="form-group full">
                    <label>Nome do produto</label>
                    <input type="text" name="nome" placeholder="Ex: Mouse Gamer" required>
                </div>

                <div class="form-group">
                    <label>Código interno</label>
                    <input type="text" id="codigo" name="codigo" placeholder="Ex: 789123" required oninput="gerarQRCode()">
                </div>

                <div class="form-group">
                    <label>Código de barras / QR Code</label>
                    <input type="text" id="codigo_barras" name="codigo_barras" placeholder="Gerado automaticamente" readonly>
                </div>

                <div class="form-group">
                    <label>Quantidade em estoque</label>
                    <input type="number" name="estoque" placeholder="Ex: 10" min="0" required>
                </div>

                <div class="form-group">
                    <label>Corredor</label>
                    <input type="text" name="corredor" placeholder="Ex: A" required>
                </div>

                <div class="form-group">
                    <label>Prateleira</label>
                    <input type="number" name="prateleira" placeholder="Ex: 3" min="1" required>
                </div>

                <div class="form-group">
                    <label>Nível</label>
                    <input type="number" name="nivel" placeholder="Ex: 2" min="1" required>
                </div>

            </div>

            <div class="qr-box" id="qrBox">
                <div class="qr-content">
                    <img id="qrImg" src="">

                    <div class="qr-info">
                        <strong>QR Code gerado automaticamente</strong>
                        <p>Esse código poderá ser usado pelo scanner para entrada, saída e localização do produto.</p>
                    </div>
                </div>
            </div>

            <div class="acoes">
                <button type="submit">Salvar Produto</button>
                <a class="voltar" href="menu.php">Voltar ao Menu</a>
            </div>

        </form>

    </div>

</div>

<script>
function gerarQRCode() {
    let codigo = document.getElementById("codigo").value.trim();

    document.getElementById("codigo_barras").value = codigo;

    if (codigo !== "") {
        document.getElementById("qrBox").style.display = "block";
        document.getElementById("qrImg").src =
            "https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=" + encodeURIComponent(codigo);
    } else {
        document.getElementById("qrBox").style.display = "none";
        document.getElementById("qrImg").src = "";
    }
}
</script>

</body>
</html>