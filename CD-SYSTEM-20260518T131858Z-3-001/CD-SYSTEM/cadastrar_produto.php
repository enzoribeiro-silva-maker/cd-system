<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Produto</title>
</head>
<body>

<h1>Cadastrar Produto</h1>

<form action="salvar_produto.php" method="POST">

    <input type="text" name="nome" placeholder="Nome do produto">

    <br><br>

    <input type="text" name="codigo" placeholder="Código">

    <br><br>

    <input type="text" name="corredor" placeholder="Corredor">

    <br><br>

    <input type="text" name="prateleira" placeholder="Prateleira">

    <br><br>

    <input type="number" name="estoque" placeholder="Estoque">

    <br><br>

    <button type="submit">
        Salvar Produto
    </button>

</form>

</body>
</html>