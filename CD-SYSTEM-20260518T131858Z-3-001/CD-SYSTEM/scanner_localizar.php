<?php

include "conectar.php";

$codigo = $_GET['codigo'] ?? "";

$sql = "SELECT * FROM produtos WHERE codigo_barras='$codigo' OR codigo='$codigo'";
$resultado = mysqli_query($conn, $sql);
$produto = mysqli_fetch_assoc($resultado);

?>

<h1>Localização do Produto</h1>

<?php if($produto){ ?>

<h2><?php echo $produto['nome']; ?></h2>
<p>Código: <?php echo $codigo; ?></p>
<p>Localização: <?php echo $produto['corredor']; ?></p>
<p>Estoque: <?php echo $produto['estoque']; ?></p>

<a href="mapa.php?busca=<?php echo $codigo; ?>">Ver no mapa</a>

<?php } else { ?>

<p>Produto não encontrado.</p>

<?php } ?>