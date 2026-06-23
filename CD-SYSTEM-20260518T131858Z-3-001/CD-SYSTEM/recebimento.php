<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Recebimento de Produtos</title>

<style>
body{
    font-family: Arial, sans-serif;
    padding: 40px;
    background: #f4f4f4;
}

h1{
    margin-bottom: 30px;
}

input{
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

<h1>Recebimento de Produtos</h1>

<form action="salvar_recebimento.php" method="POST">

    <input
        type="text"
        id="codigo_barras"
        name="codigo_barras"
        placeholder="Bipe ou leia o QR Code"
        autofocus
        required>

    <button type="button" onclick="abrirScanner()">
        📷 Ler QR Code
    </button>

    <div id="reader"></div>

    <input
        type="text"
        name="produto"
        placeholder="Produto"
        required>

    <input
        type="number"
        name="quantidade"
        placeholder="Quantidade"
        required>

    <input
        type="text"
        name="corredor"
        placeholder="Corredor"
        required>

    <input
        type="number"
        name="prateleira"
        placeholder="Prateleira"
        required>

    <input
        type="number"
        name="nivel"
        placeholder="Nível"
        required>

    <button type="submit">
        SALVAR
    </button>

</form>

<script>
const campos = document.querySelectorAll("input");

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
        {
            facingMode: "environment"
        },
        {
            fps: 10,
            qrbox: 250
        },

        function(decodedText){

            document.getElementById("codigo_barras").value = decodedText;
buscarProduto(decodedText);

            scanner.stop().then(() => {
                scanner.clear();
                scanner = null;
            });

        },

        function(errorMessage){
            // Ignora erros de leitura
        }

    );
    function buscarProduto(codigo){
    fetch("buscar_por_codigo.php?codigo=" + encodeURIComponent(codigo))
    .then(response => response.json())
    .then(data => {
        if(data.encontrado){
            document.querySelector('input[name="produto"]').value = data.nome;
            document.querySelector('input[name="corredor"]').value = data.corredor;
            document.querySelector('input[name="prateleira"]').value = data.prateleira;
            document.querySelector('input[name="nivel"]').value = data.nivel;
        }else{
            alert("Produto não encontrado no cadastro.");
        }
    });
}

}
</script>

</body>
</html>