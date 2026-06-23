<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Recebimento de Produtos - FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<style>
.scanner-box {
    margin-bottom: 20px;
    padding: 18px;
    background: #f9fafb;
    border: 1px dashed #cbd5e1;
    border-radius: 8px;
}

#reader {
    width: 100%;
    max-width: 360px;
    margin-top: 15px;
}

.info-texto {
    color: #64748b;
    font-size: 14px;
    margin-bottom: 15px;
}
</style>
</head>

<body>

<div class="topo">
    <div>
        <h1>FindWare</h1>
        <span>Sistema Inteligente de Localização de Produtos</span>
    </div>

    <span>Recebimento de Produtos</span>
</div>

<div class="container">

    <div class="card">

        <div class="titulo">
            <h2>Recebimento de Produtos</h2>
            <p>Registre a entrada de produtos no estoque utilizando código manual, leitor ou QR Code.</p>
        </div>

        <form action="salvar_recebimento.php" method="POST">

            <div class="scanner-box">
                <label>Código de barras / QR Code</label>

                <input
                    type="text"
                    id="codigo_barras"
                    name="codigo_barras"
                    placeholder="Bipe ou leia o QR Code"
                    autofocus
                    required>

                <p class="info-texto">
                    Use o leitor físico ou clique no botão abaixo para abrir a câmera.
                </p>

                <button type="button" onclick="abrirScanner()">
                    Ler QR Code
                </button>

                <div id="reader"></div>
            </div>

            <div class="form-grid">

                <div class="form-group full">
                    <label>Produto</label>
                    <input
                        type="text"
                        name="produto"
                        placeholder="Nome do produto"
                        required>
                </div>

                <div class="form-group">
                    <label>Quantidade</label>
                    <input
                        type="number"
                        name="quantidade"
                        placeholder="Ex: 10"
                        min="1"
                        required>
                </div>

                <div class="form-group">
                    <label>Corredor</label>
                    <input
                        type="text"
                        name="corredor"
                        placeholder="Ex: A"
                        required>
                </div>

                <div class="form-group">
                    <label>Prateleira</label>
                    <input
                        type="number"
                        name="prateleira"
                        placeholder="Ex: 3"
                        min="1"
                        required>
                </div>

                <div class="form-group">
                    <label>Nível</label>
                    <input
                        type="number"
                        name="nivel"
                        placeholder="Ex: 2"
                        min="1"
                        required>
                </div>

            </div>

            <div class="acoes">
                <button type="submit">Salvar Recebimento</button>
                <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
            </div>

        </form>

    </div>

</div>

<script>
const campos = document.querySelectorAll("input");

campos.forEach((campo, index) => {
    campo.addEventListener("keydown", function(event) {

        if (event.key === "Enter") {

            event.preventDefault();

            if (campos[index + 1]) {
                campos[index + 1].focus();
            } else {
                document.querySelector("form").submit();
            }

        }

    });
});
</script>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let scanner;

function abrirScanner() {

    if (scanner) {
        return;
    }

    scanner = new Html5Qrcode("reader");

    scanner.start(
        {
            facingMode: "environment"
        },
        {
            fps: 10,
            qrbox: 250
        },

        function(decodedText) {

            document.getElementById("codigo_barras").value = decodedText;
            buscarProduto(decodedText);

            scanner.stop().then(() => {
                scanner.clear();
                scanner = null;
            });

        },

        function(errorMessage) {
            // Ignora erros de leitura
        }
    );
}

function buscarProduto(codigo) {
    fetch("buscar_por_codigo.php?codigo=" + encodeURIComponent(codigo))
    .then(response => response.json())
    .then(data => {
        if (data.encontrado) {
            document.querySelector('input[name="produto"]').value = data.nome;
            document.querySelector('input[name="corredor"]').value = data.corredor;
            document.querySelector('input[name="prateleira"]').value = data.prateleira;
            document.querySelector('input[name="nivel"]').value = data.nivel;
        } else {
            alert("Produto não encontrado no cadastro.");
        }
    });
}
</script>

</body>
</html>