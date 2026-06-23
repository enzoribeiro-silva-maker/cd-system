<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Scanner CD - FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<script src="https://unpkg.com/html5-qrcode"></script>

<style>
.scanner-layout {
    display: grid;
    grid-template-columns: 360px 1fr;
    gap: 24px;
    align-items: start;
}

.operacoes {
    display: grid;
    gap: 12px;
}

.operacao-btn {
    background: #f9fafb;
    color: #17202c;
    border: 1px solid #d5dbe3;
    text-align: left;
    transition: 0.2s;
}

.operacao-btn:hover {
    background: #e5e7eb;
}

.operacao-btn.ativo {
    background: #17202c;
    color: white;
    border-color: #17202c;
}

.scanner-area {
    text-align: center;
}

#reader {
    width: 100%;
    max-width: 420px;
    margin: 20px auto;
    border-radius: 8px;
    overflow: hidden;
}

#resultado {
    margin-top: 18px;
    padding: 15px;
    background: #f9fafb;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    color: #374151;
    font-weight: bold;
}

.status-operacao {
    margin-top: 16px;
    padding: 14px;
    background: #eef2ff;
    border: 1px solid #c7d2fe;
    color: #3730a3;
    border-radius: 8px;
    font-size: 14px;
}

@media(max-width: 900px) {
    .scanner-layout {
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

    <span>Scanner CD</span>
</div>

<div class="container">

    <div class="titulo">
        <h2>Scanner do Centro de Distribuição</h2>
        <p>Escolha a operação desejada e escaneie o QR Code ou código do produto.</p>
    </div>

    <div class="scanner-layout">

        <div class="card">

            <div class="titulo">
                <h2>Operação</h2>
                <p>Selecione o tipo de ação antes de abrir a câmera.</p>
            </div>

            <div class="operacoes">
                <button type="button" class="operacao-btn" id="btnEntrada" onclick="selecionarOperacao('entrada')">
                    Entrada de Produto
                </button>

                <button type="button" class="operacao-btn" id="btnSaida" onclick="selecionarOperacao('saida')">
                    Saída de Produto
                </button>

                <button type="button" class="operacao-btn" id="btnLocalizar" onclick="selecionarOperacao('localizar')">
                    Localizar Produto
                </button>
            </div>

            <div class="status-operacao" id="statusOperacao">
                Nenhuma operação selecionada.
            </div>

            <div class="acoes">
                <a href="menu.php" class="btn btn-secundario">Voltar ao Menu</a>
            </div>

        </div>

        <div class="card scanner-area">

            <div class="titulo">
                <h2>Leitura do QR Code</h2>
                <p>Abra a câmera traseira e aponte para o código do produto.</p>
            </div>

            <button type="button" onclick="iniciarTraseira()">
                Abrir Câmera Traseira
            </button>

            <div id="reader"></div>

            <div id="resultado">
                Escolha a operação e escaneie o QR Code.
            </div>

        </div>

    </div>

</div>

<audio id="beep">
    <source src="beep.mp3" type="audio/mpeg">
</audio>

<script>
let scanner;
let operacao = "";

function selecionarOperacao(tipo) {
    operacao = tipo;

    document.getElementById("btnEntrada").classList.remove("ativo");
    document.getElementById("btnSaida").classList.remove("ativo");
    document.getElementById("btnLocalizar").classList.remove("ativo");

    if (tipo === "entrada") {
        document.getElementById("btnEntrada").classList.add("ativo");
        document.getElementById("statusOperacao").innerHTML = "Operação selecionada: Entrada de Produto";
    }

    if (tipo === "saida") {
        document.getElementById("btnSaida").classList.add("ativo");
        document.getElementById("statusOperacao").innerHTML = "Operação selecionada: Saída de Produto";
    }

    if (tipo === "localizar") {
        document.getElementById("btnLocalizar").classList.add("ativo");
        document.getElementById("statusOperacao").innerHTML = "Operação selecionada: Localizar Produto";
    }

    document.getElementById("resultado").innerHTML = "Agora abra a câmera e escaneie o QR Code.";
}

function onScanSuccess(codigo) {

    if (operacao == "") {
        alert("Escolha Entrada, Saída ou Localizar primeiro.");
        return;
    }

    document.getElementById("beep").play();
    document.getElementById("resultado").innerHTML = "Código lido: " + codigo;

    if (operacao == "entrada") {
        window.location.href = "scanner_entrada.php?codigo=" + encodeURIComponent(codigo);
    }

    if (operacao == "saida") {
        window.location.href = "scanner_saida.php?codigo=" + encodeURIComponent(codigo);
    }

    if (operacao == "localizar") {
        window.location.href = "scanner_localizar.php?codigo=" + encodeURIComponent(codigo);
    }
}

function iniciarTraseira() {

    if (operacao == "") {
        alert("Escolha uma operação antes de abrir a câmera.");
        return;
    }

    if (scanner) {
        return;
    }

    scanner = new Html5Qrcode("reader");

    scanner.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        onScanSuccess
    ).catch(function(error) {
        document.getElementById("resultado").innerHTML = "Não foi possível abrir a câmera.";
        scanner = null;
    });
}
</script>
<script src="assets/tema.js"></script>
</body>
</html>