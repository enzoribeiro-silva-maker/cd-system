<?php

include "conectar.php";

$busca = $_GET['busca'];

$sql = "SELECT * FROM produtos
WHERE nome LIKE '%$busca%'
OR codigo LIKE '%$busca%'";

$resultado = mysqli_query($conn, $sql);

$produto = mysqli_fetch_assoc($resultado);

$corredorProduto = strtoupper($produto['corredor']);
$prateleiraProduto = $produto['prateleira'];

$rota = "";

// ROTAS

if($corredorProduto == "A"){

    $rota = "ENTRADA → A1 → A2 → A3 → A4";

}

elseif($corredorProduto == "B"){

    $rota = "ENTRADA → B1 → B2 → B3 → B4";

}

elseif($corredorProduto == "C"){

    $rota = "ENTRADA → C1 → C2 → C3 → C4";

}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Mapa do CD</title>

<style>

body{
    font-family: Arial;
}

.linha{
    margin-bottom:20px;
}

.local{

    display:inline-block;
    width:80px;
    height:80px;
    border:1px solid black;
    text-align:center;
    line-height:80px;
    margin:5px;

}

.produto{

    background-color: yellow;
    font-weight:bold;

}

.rota{

    margin-top:30px;
    font-size:22px;
    color:green;
    font-weight:bold;

}

</style>

</head>

<body>

<h1>Mapa do CD</h1>

<h2>
Produto: <?php echo $produto['nome']; ?>
</h2>

<h3>

Localização:
Corredor <?php echo $produto['corredor']; ?>
-
Prateleira <?php echo $produto['prateleira']; ?>

</h3>

<?php

$corredores = ['A', 'B', 'C'];

foreach($corredores as $corredor){

    echo "<div class='linha'>";

    for($i = 1; $i <= 4; $i++){

        $classe = "local";

        if($corredor == $corredorProduto
           && $i == $prateleiraProduto){

            $classe .= " produto";
        }

        echo "<div class='$classe'>";

        echo $corredor . $i;

        echo "</div>";
    }

    echo "</div>";
}

?>

<div class="rota">

<?php
echo $rota;
?>

</div>

<br><br>

<button onclick="tocarSom()">

TESTAR SOM

</button>

<audio id="beep">
    <source src="beep.mp3" type="audio/mpeg">
</audio>
<script>

function tocarSom(){

    document.getElementById("beep").play();

}

// TOCA AUTOMATICAMENTE

window.onload = function(){

    tocarSom();

}

</script>

</body>
</html>