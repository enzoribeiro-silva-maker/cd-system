<?php
?>

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
    background: #c62828;
    color: white;
    border: none;
}

button:hover{
    background: #b71c1c;
}
</style>
</head>

<body>

<h1>Saída de Produtos</h1>

<form action="salvar_saida.php" method="POST">

    <input
        type="text"
        name="codigo_barras"
        placeholder="Código de Barras"
        required>

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
        name="motivo"
        placeholder="Motivo da saída (Expedição, Perda, Transferência...)"
        required>

    <button type="submit">
        REGISTRAR SAÍDA
    </button>

</form>

<br>

<a href="menu.php">← Voltar ao Menu</a>

</body>
</html>