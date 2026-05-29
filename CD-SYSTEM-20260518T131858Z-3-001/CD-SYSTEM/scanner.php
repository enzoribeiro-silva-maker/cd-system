<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Scanner CD</title>

<script src="https://unpkg.com/html5-qrcode"></script>

<style>
body{
    font-family: Arial;
    text-align: center;
    padding: 20px;
}

#reader{
    width: 320px;
    margin: auto;
}

button{
    padding: 15px;
    margin: 8px;
    font-size: 18px;
}

#resultado{
    margin-top: 20px;
    font-size: 20px;
    font-weight: bold;
}
</style>
</head>

<body>

<h1>Scanner CD</h1>

<h3>Escolha a operação</h3>

<button onclick="operacao='entrada'">Entrada</button>
<button onclick="operacao='saida'">Saída</button>
<button onclick="operacao='localizar'">Localizar</button>

<br><br>

<button onclick="iniciarTraseira()">Abrir câmera traseira</button>

<div id="reader"></div>

<div id="resultado">Escolha a operação e escaneie o QR Code</div>

<audio id="beep">
    <source src="beep.mp3" type="audio/mpeg">
</audio>

<script>
let scanner;
let operacao = "";

function onScanSuccess(codigo){

    if(operacao == ""){
        alert("Escolha Entrada, Saída ou Localizar primeiro.");
        return;
    }

    document.getElementById("beep").play();

    if(operacao == "entrada"){
        window.location.href = "scanner_entrada.php?codigo=" + codigo;
    }

    if(operacao == "saida"){
        window.location.href = "scanner_saida.php?codigo=" + codigo;
    }

    if(operacao == "localizar"){
        window.location.href = "scanner_localizar.php?codigo=" + codigo;
    }
}

function iniciarTraseira(){

    scanner = new Html5Qrcode("reader");

    scanner.start(
        { facingMode: { exact: "environment" } },
        { fps: 10, qrbox: 250 },
        onScanSuccess
    );
}
</script>

</body>
</html>