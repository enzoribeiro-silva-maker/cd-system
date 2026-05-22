<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Localizar Produto</title>

    <style>

    body{
        font-family:Arial;
        background:#f4f4f4;
        padding:40px;
    }

    input{
        padding:10px;
        width:300px;
    }

    button{
        padding:10px;
        cursor:pointer;
    }

    </style>

</head>
<body>

<h1>Localizar Produto no CD</h1>

<form action="mapa.php" method="GET">

    <input 
        type="text" 
        name="busca"
        placeholder="Digite código ou nome">

    <button type="submit">
        Buscar
    </button>

</form>

</body>
</html>