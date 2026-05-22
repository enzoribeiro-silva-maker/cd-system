<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro</title>
</head>
<body>

<h1>Cadastro de Usuário</h1>

<form action="salvar_usuario.php" method="POST">

    <input type="text" name="nome" placeholder="Nome">

    <br><br>

    <input type="email" name="email" placeholder="Email">

    <br><br>

    <input type="password" name="senha" placeholder="Senha">

    <br><br>

    <button type="submit">
        Cadastrar
    </button>

</form>

</body>
</html>