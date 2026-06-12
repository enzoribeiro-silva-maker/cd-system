<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Saída de Produtos</title>

<style>
body{
    font-family: Arial, sans-serif;
    padding: 40px;
    background: #f4f4f4;
}

input, select{
    padding: 10px;
    width: 320px;
    margin-bottom: 15px;
    display: block;
}

button{
    padding: 10px 20px;
    cursor: pointer;
    margin-bottom: 15px;
}

#reader{
    width: 320px;
    margin-bottom: 20px;
}
</style>
</head>

<body>

<h1>Saída de Produtos</h1>

<form action="salvar_saida.php" method="POST">

    <input
        type="text"
        id="codigo_barras"
        name="codigo_barras"
        placeholder="Bipe ou leia o QR Code"
        autofocus
        required>

    <button type="button" onclick="abrirScanner()">📷 Ler QR Code</button>

    <div id="reader"></div>

    <input
        type="text"
        name="produto"
        placeholder="Produto"
        required>

    <input
        type="number"
        name="quantidade"
        placeholder="Quantidade retirada"
        required>

    <select name="motivo" required>
        <option value="">Selecione o motivo da saída</option>
        <option value="Expedição">Expedição</option>
        <option value="Venda">Venda</option>
        <option value="Transferência">Transferência</option>
        <option value="Perda">Perda</option>
        <option value="Avaria">Avaria</option>
    </select>

    <button type="submit">REGISTRAR SAÍDA</button>

</form>

<script>
const campos = document.querySelectorAll("input, select");

campos.forEach((campo, index) => {
    campo.addEventListener("keydown", function(event) {
        if(event.key === "Enter"){
            event.preventDefault();

            if(campos[index + 1]){
                campos[index + 1].focus();
            }else{
                document.querySelector("form").submit();
            }
        }
    });
});
</script>

<script src="https://unpkg.com/html5-qrcode"></script>

<script>
let scanner;

function abrirScanner(){
    if(scanner){
        return;
    }

    scanner = new Html5Qrcode("reader");

    scanner.start(
        { facingMode: "environment" },
        {
            fps: 10,
            qrbox: 250
        },
        function(decodedText){
            document.getElementById("codigo_barras").value = decodedText;

            scanner.stop().then(() => {
                scanner.clear();
                scanner = null;
            });
        },
        function(errorMessage){}
    );
}
</script>

</body>
</html>