<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Scanner</title>

<script src="https://unpkg.com/html5-qrcode"></script>

<style>
body{
    font-family: Arial;
    text-align: center;
    padding: 20px;
}

#reader{
    width: 300px;
    margin: auto;
}

input{
    padding: 10px;
    width: 300px;
    margin-top: 20px;
}
</style>
</head>

<body>

<h1>Scanner de Código</h1>

<div id="reader"></div>

<input
type="text"
id="codigo"
placeholder="Código lido aparecerá aqui">

<script>
function onScanSuccess(decodedText){
    document.getElementById("codigo").value = decodedText;

    setTimeout(function(){
        window.location.href = "recebimento.php?codigo=" + decodedText;
    }, 800);
}

new Html5QrcodeScanner(
    "reader",
    {
        fps: 10,
        qrbox: 250
    }
).render(onScanSuccess);
</script>

</body>
</html>