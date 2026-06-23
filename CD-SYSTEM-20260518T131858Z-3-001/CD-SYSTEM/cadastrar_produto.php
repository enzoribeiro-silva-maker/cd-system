<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Cadastro de Produtos - FindWare</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:Arial,sans-serif;}

body{background:#eef1f5;}

.topo{
    background:#17202c;
    color:white;
    padding:20px 35px;
}

.topo p{color:#cbd5e1;}

.container{padding:30px;}

.card{
    background:white;
    max-width:760px;
    padding:25px;
    border-radius:8px;
    border:1px solid #d5dbe3;
}

input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    background:#17202c;
    color:white;
    border:none;
    padding:12px 20px;
    border-radius:5px;
    cursor:pointer;
}

.qr-box{
    margin:15px 0;
    padding:15px;
    background:#f9fafb;
    border:1px solid #d5dbe3;
    display:none;
}

.qr-box img{
    width:160px;
    height:160px;
}

.voltar{
    display:inline-block;
    margin-top:15px;
    text-decoration:none;
    color:#17202c;
    font-weight:bold;
}
</style>
</head>

<body>

<div class="topo">
    <h1>FindWare</h1>
    <p>Sistema Inteligente de Localização de Produtos</p>
</div>

<div class="container">
<div class="card">

<h2>Cadastro de Produto</h2>
<br>

<form action="salvar_produto.php" method="POST">

<input type="text" name="nome" placeholder="Nome do produto" required>

<input type="text" id="codigo" name="codigo" placeholder="Código interno" required oninput="gerarQRCode()">

<input type="text" id="codigo_barras" name="codigo_barras" placeholder="Código de barras / QR Code" readonly>

<div class="qr-box" id="qrBox">
    <strong>QR Code gerado:</strong><br><br>
    <img id="qrImg" src="">
</div>

<input type="number" name="estoque" placeholder="Quantidade em estoque" required>

<input type="text" name="corredor" placeholder="Corredor (A, B, C...)" required>

<input type="number" name="prateleira" placeholder="Prateleira" required>

<input type="number" name="nivel" placeholder="Nível" required>

<button type="submit">Salvar Produto</button>

</form>

<br>
<a class="voltar" href="menu.php">← Voltar ao Menu</a>

</div>
</div>

<script>
function gerarQRCode(){
    let codigo = document.getElementById("codigo").value.trim();

    document.getElementById("codigo_barras").value = codigo;

    if(codigo !== ""){
        document.getElementById("qrBox").style.display = "block";
        document.getElementById("qrImg").src =
            "https://api.qrserver.com/v1/create-qr-code/?size=160x160&data=" + encodeURIComponent(codigo);
    }else{
        document.getElementById("qrBox").style.display = "none";
        document.getElementById("qrImg").src = "";
    }
}
</script>

</body>
</html>