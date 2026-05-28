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

.resultado{
    margin-top: 20px;
    font-size: 22px;
    font-weight: bold;
}

button{
    padding: 12px;
    margin-top: 15px;
}
</style>
</head>

<body>

<h1>Scanner de Código</h1>

<div id="reader"></div>

<div class="resultado" id="resultado">
Aguardando leitura...
</div>

<audio id="beep">
    <source src="beep.mp3" type="audio/mpeg">
</audio>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>

function onScanSuccess(decodedText, decodedResult) {

    alert("Código lido: " + decodedText);

    document.getElementById("codigo").value = decodedText;
}

const html5QrCode = new Html5Qrcode("reader");

Html5Qrcode.getCameras().then(devices => {

    if (devices && devices.length) {

        let cameraId = devices[0].id;

        html5QrCode.start(
            cameraId,
            {
                fps: 10,
                qrbox: 250
            },
            onScanSuccess
        );
    }

}).catch(err => {
    alert("Erro ao abrir câmera");
});

</script>

</body>
</html>