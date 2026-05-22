<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Recebimento</title>

<style>
body{
    font-family:Arial;
    padding:40px;
    background:#f4f4f4;
}

input{
    padding:10px;
    width:300px;
    margin-bottom:15px;
}

button{
    padding:10px;
    cursor:pointer;
}
</style>
</head>

<body>

<h1>Recebimento de Produtos</h1>

<form action="salvar_recebimento.php" method="POST">

<input
type="text"
name="codigo_barras"
placeholder="Bipe o código de barras"
autofocus
required>

<br>

<input
type="text"
name="produto"
placeholder="Produto"
required>

<br>

<input
type="number"
name="quantidade"
placeholder="Quantidade"
required>

<br>

<input
type="text"
name="corredor"
placeholder="Corredor"
required>

<br>

<input
type="number"
name="prateleira"
placeholder="Prateleira"
required>

<br>

<input
type="number"
name="nivel"
placeholder="Nível"
required>

<br>

<button type="submit">SALVAR</button>

</form>

</body>
</html>