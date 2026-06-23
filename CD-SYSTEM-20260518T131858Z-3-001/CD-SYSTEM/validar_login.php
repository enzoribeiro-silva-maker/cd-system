<?php

session_start();

include "conectar.php";

$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios
WHERE email='$email'
AND senha='$senha'";

$resultado = mysqli_query($conn, $sql);

if(mysqli_num_rows($resultado) > 0){

    $usuario = mysqli_fetch_assoc($resultado);
    $_SESSION['usuario'] = $usuario['nome'];

    header("Location: menu.php");
    exit;

}else{

    $erro = true;

}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Login Inválido - FindWare</title>
<link rel="stylesheet" href="assets/style.css">

<style>
.login-erro {
    min-height: calc(100vh - 72px);
    display: flex;
    align-items: center;
    justify-content: center;
}

.erro-card {
    width: 100%;
    max-width: 500px;
    text-align: center;
}

.icone-erro {
    width: 66px;
    height: 66px;
    border-radius: 50%;
    background: #fee2e2;
    color: #991b1b;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 32px;
    font-weight: bold;
}
</style>
</head>

<body>

<div class="topo">
    <div>
        <h1>FindWare</h1>
        <span>Sistema Inteligente de Localização de Produtos</span>
    </div>

    <span>Acesso ao Sistema</span>
</div>

<div class="container login-erro">

    <div class="card erro-card">

        <div class="icone-erro">!</div>

        <div class="titulo">
            <h2>Login inválido</h2>
            <p>O e-mail ou senha informado não corresponde a nenhum usuário cadastrado.</p>
        </div>

        <div class="acoes">
            <a href="login.php" class="btn">Tentar Novamente</a>
            <a href="cadastro.php" class="btn btn-secundario">Criar Conta</a>
        </div>

    </div>

</div>
<script src="assets/tema.js"></script>
</body>
</html>