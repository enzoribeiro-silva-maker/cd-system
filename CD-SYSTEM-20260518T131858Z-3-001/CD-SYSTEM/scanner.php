<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Scanner iPhone</title>

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
    margin: 10px;
    font-size: 18px;
}

#resultado{
    margin-top: 20px;
    font-size: 22px;
    font-weight: bold;
}
</style>
</head>

<body>

<h1>Scanner de Código</h1>

<button onclick="iniciarTraseira()">Abrir câmera traseira</button>
<button onclick="iniciarFrontal()">Abrir câmera frontal</button>

<div id="reader"></div>

<div id="resultado">Aguardando leitura...</div>

<audio id="beep">
    <source src="beep.mp3" type="audio/mpeg">
</audio>

<script>
let scanner;

function produtoPorCodigo(codigo){
    if(codigo == "789123") return "Mouse Gamer";
    if(codigo == "456789") return "Teclado Mecânico";
    if(codigo == "111222") return "Monitor LG";
    return "Produto não cadastrado";
}

function onScanSuccess(codigo){
    document.getElementById("beep").play();

    let produto = produtoPorCodigo(codigo);

    document.getElementById("resultado").innerHTML =
        "Código: " + codigo + "<br>Produto: " + produto;
}

function pararScanner(){
    if(scanner){
        scanner.stop().catch(function(){});
    }
}

function iniciarTraseira(){
    pararScanner();

    scanner = new Html5Qrcode("reader");

    scanner.start(
        { facingMode: { exact: "environment" } },
        { fps: 10, qrbox: 250 },
        onScanSuccess
    ).catch(function(){
        alert("Não consegui abrir a traseira. Clique em câmera frontal e depois tente novamente.");
    });
}

function iniciarFrontal(){
    pararScanner();

    scanner = new Html5Qrcode("reader");

    scanner.start(
        { facingMode: "user" },
        { fps: 10, qrbox: 250 },
        onScanSuccess
    );
}
</script>

</body>
</html>