<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>FindWare - Login</title>

<style>

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#eef1f5;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
}

.card{
    background:white;
    width:420px;
    padding:40px;
    border-radius:8px;
    border:1px solid #d5dbe3;
    box-shadow:0 2px 10px rgba(0,0,0,0.08);
}

.logo{
    text-align:center;
    margin-bottom:30px;
}

.logo h1{
    color:#17202c;
    font-size:36px;
}

.logo p{
    color:#64748b;
    margin-top:5px;
}

input{
    width:100%;
    padding:14px;
    border:1px solid #cbd5e1;
    border-radius:5px;
    margin-bottom:15px;
}

button{
    width:100%;
    padding:14px;
    background:#17202c;
    color:white;
    border:none;
    border-radius:5px;
    cursor:pointer;
    font-weight:bold;
}

button:hover{
    background:#0f172a;
}

</style>
</head>

<body>

<div class="card">

    <div class="logo">
        <h1>FindWare</h1>
        <p>Sistema Inteligente de Localização de Produtos</p>
    </div>

    <form action="validar_login.php" method="POST">

        <input
            type="text"
            name="email"
            placeholder="Usuário ou E-mail"
            required>

        <input
            type="password"
            name="senha"
            placeholder="Senha"
            required>

        <button type="submit">
            Entrar no Sistema
        </button>

    </form>

</div>

</body>
</html>