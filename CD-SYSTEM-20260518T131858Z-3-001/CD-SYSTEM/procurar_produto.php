<?php
include "conectar.php";

$produto = null;

if (isset($_GET['busca'])) {
    $busca = $_GET['busca'];

    $sql = "SELECT * FROM produtos 
            WHERE codigo_barras = '$busca'
            OR codigo = '$busca'
            OR nome LIKE '%$busca%'";

    $resultado = mysqli_query($conn, $sql);
    $produto = mysqli_fetch_assoc($resultado);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Procurar Produto Perdido</title>

<style>
body{
    font-family: Arial;
    padding: 40px;
    background: #f4f4f4;
}

input{
    padding: 10px;
    width: 320px;
    margin-bottom: 15px;
    display: block;
}

button{
    padding: 12px 20px;
    cursor: pointer;
    margin: 5px;
}

.caixa{
    background: white;
    padding: 20px;
    width: 430px;
    border-radius: 8px;
    margin-top: 20px;
}

#status{
    font-size: 22px;
    font-weight: bold;
    margin-top: 20px;
}

.barra{
    width: 100%;
    height: 30px;
    background: #ddd;
    border-radius: 20px;
    overflow: hidden;
    margin-top: 15px;
}

#progresso{
    width: 0%;
    height: 100%;
    background: green;
    transition: 0.5s;
}

#formAtualizar{
    display:none;
    margin-top:20px;
    padding:15px;
    background:#eee;
}
</style>
</head>

<body>

<h1>Procurar Produto Perdido</h1>

<form method="GET">
    <input 
        type="text" 
        name="busca" 
        placeholder="Digite ou bipe o código do produto"
        required>

    <button type="submit">Buscar Produto</button>
</form>

<?php if ($produto): ?>

<div class="caixa">
    <h2><?php echo $produto['nome']; ?></h2>

    <p><strong>Código:</strong> <?php echo $produto['codigo_barras']; ?></p>
    <p><strong>Estoque:</strong> <?php echo $produto['estoque']; ?></p>

    <p>
        <strong>Local cadastrado:</strong>
        Corredor <?php echo $produto['corredor']; ?> -
        Prateleira <?php echo $produto['prateleira']; ?> -
        Nível <?php echo $produto['nivel']; ?>
    </p>

    <button onclick="iniciarBusca()">Iniciar busca pelo CD</button>

    <button onclick="pararBusca()" style="background:green;color:white;">
        Produto encontrado
    </button>

    <div id="status">Aguardando busca...</div>

    <div class="barra">
        <div id="progresso"></div>
    </div>

    <form id="formAtualizar" action="atualizar_localizacao.php" method="POST">
        <h3>Atualizar localização do produto</h3>

        <input type="hidden" name="codigo_barras" value="<?php echo $produto['codigo_barras']; ?>">

        <input type="text" name="corredor" placeholder="Novo corredor" required>

        <input type="number" name="prateleira" placeholder="Nova prateleira" required>

        <input type="number" name="nivel" placeholder="Novo nível" required>

        <button type="submit">Salvar nova localização</button>
    </form>
</div>

<audio id="beep" src="beep.mp3" loop></audio>

<script>
let sinal = 0;
let intervalo;

function iniciarBusca(){
    sinal = 0;
    document.getElementById("status").innerHTML = "Buscando sinal do produto...";
    document.getElementById("progresso").style.width = "0%";
    document.getElementById("formAtualizar").style.display = "none";

    intervalo = setInterval(() => {
        sinal += 20;

        document.getElementById("progresso").style.width = sinal + "%";

        if(sinal < 40){
            document.getElementById("status").innerHTML = "Sinal fraco...";
        }else if(sinal < 80){
            document.getElementById("status").innerHTML = "Sinal médio...";
        }else{
            document.getElementById("status").innerHTML = "Sinal forte! Produto próximo!";
            document.getElementById("beep").play();
            clearInterval(intervalo);
        }

    }, 1500);
}

function pararBusca(){
    clearInterval(intervalo);

    let beep = document.getElementById("beep");
    beep.pause();
    beep.currentTime = 0;

    document.getElementById("status").innerHTML = "Produto encontrado!";
    document.getElementById("formAtualizar").style.display = "block";
}
</script>

<?php elseif(isset($_GET['busca'])): ?>

<p>Produto não encontrado.</p>

<?php endif; ?>

<br>
<a href="menu.php">Voltar ao menu</a>

</body>
</html>