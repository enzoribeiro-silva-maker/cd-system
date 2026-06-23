<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro de Produtos - FindWare</title>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

body {
    background: #eef1f5;
    color: #17202c;
}

.topo {
    height: 72px;
    background: #17202c;
    color: white;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 36px;
}

.topo h1 {
    font-size: 22px;
}

.topo span {
    color: #cbd5e1;
    font-size: 14px;
}

.container {
    padding: 30px 36px;
}

.card {
    background: white;
    border: 1px solid #d5dbe3;
    border-radius: 8px;
    padding: 28px;
    max-width: 900px;
}

.titulo {
    margin-bottom: 25px;
}

.titulo h2 {
    font-size: 24px;
    color: #111827;
}

.titulo p {
    color: #64748b;
    margin-top: 6px;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 18px;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group.full {
    grid-column: span 2;
}

label {
    font-size: 14px;
    font-weight: bold;
    color: #374151;
    margin-bottom: 6px;
}

input {
    width: 100%;
    padding: 13px;
    border: 1px solid #cbd5e1;
    border-radius: 6px;
    font-size: 15px;
    background: #fff;
}

input:focus {
    outline: none;
    border-color: #17202c;
}

.qr-box {
    margin-top: 20px;
    padding: 20px;
    background: #f9fafb;
    border: 1px dashed #cbd5e1;
    border-radius: 8px;
    display: none;
}

.qr-content {
    display: flex;
    gap: 20px;
    align-items: center;
}

.qr-box img {
    width: 150px;
    height: 150px;
    border: 1px solid #d5dbe3;
    padding: 6px;
    background: white;
}

.qr-info strong {
    display: block;
    font-size: 16px;
    margin-bottom: 8px;
}

.qr-info p {
    color: #64748b;
    font-size: 14px;
}

.acoes {
    margin-top: 25px;
    display: flex;
    gap: 12px;
    align-items: center;
}

button {
    background: #17202c;
    color: white;
    border: none;
    padding: 13px 22px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

button:hover {
    background: #0f172a;
}

.voltar {
    text-decoration: none;
    color: #17202c;
    font-weight: bold;
    padding: 12px 18px;
    border-radius: 6px;
    border: 1px solid #d5dbe3;
    background: #f9fafb;
}

.voltar:hover {
    background: #e5e7eb;
}

@media(max-width: 800px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .form-group.full {
        grid-column: span 1;
    }

    .qr-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .acoes {
        flex-direction: column;
        align-items: stretch;
    }

    button, .voltar {
        width: 100%;
        text-align: center;
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