<?php
include "conectar.php";

$busca = $_GET['busca'] ?? '';

if ($busca == '') {
    echo "Nenhum produto informado.<br><a href='localizar.php'>Voltar</a>";
    exit;
}

$sql = "SELECT * FROM produtos 
        WHERE codigo_barras = '$busca'
        OR codigo = '$busca'
        OR nome LIKE '%$busca%'";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    die("Erro na consulta: " . mysqli_error($conn));
}

$produto = mysqli_fetch_assoc($resultado);

if (!$produto) {
    echo "Produto não encontrado.<br><a href='localizar.php'>Voltar</a>";
    exit;
}

$corredorProduto = $produto['corredor'];
$prateleiraProduto = $produto['prateleira'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Mapa do CD</title>

<style>
body{
    font-family: Arial;
    padding: 40px;
    background: #f4f4f4;
}

.grade{
    display: grid;
    grid-template-columns: repeat(4, 80px);
    gap: 15px;
    margin-top: 30px;
}

.posicao{
    width: 80px;
    height: 80px;
    background: #ddd;
    border: 2px solid #999;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

.ativo{
    background: red;
    color: white;
    border: 3px solid black;
}
</style>
</head>

<body>

<h1>Mapa do CD</h1>

<p><strong>Produto:</strong> <?php echo $produto['nome']; ?></p>
<p><strong>Estoque:</strong> <?php echo $produto['estoque']; ?></p>
<p><strong>Localização:</strong> Corredor <?php echo $produto['corredor']; ?> - Prateleira <?php echo $produto['prateleira']; ?> - Nível <?php echo $produto['nivel']; ?></p>

<div class="grade">

<?php
$corredores = ['A','B','C'];

foreach($corredores as $corredor){
    for($p = 1; $p <= 4; $p++){

        $ativo = ($corredor == $corredorProduto && $p == $prateleiraProduto) ? "ativo" : "";

        echo "<div class='posicao $ativo'>$corredor$p</div>";
    }
}
?>

</div>

<br>
<a href="localizar.php">Voltar</a>
<audio id="beep" src="beep.mp3"></audio>

<button onclick="tocarSom()">🔊 Testar som</button>

<script>
function tocarSom(){
    document.getElementById("beep").play();
}
</script>

</body>
</html>