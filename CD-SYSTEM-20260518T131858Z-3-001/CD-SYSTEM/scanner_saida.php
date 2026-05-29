<?php

include "conectar.php";

$codigo = $_GET['codigo'] ?? "";

$sql = "SELECT * FROM produtos WHERE codigo_barras='$codigo' OR codigo='$codigo'";
$resultado = mysqli_query($conn, $sql);
$produto = mysqli_fetch_assoc($resultado);

?>

<h1>Saída de Produto</h1>

<?php if($produto){ ?>

<h2><?php echo $produto['nome']; ?></h2>
<p>Código: <?php echo $codigo; ?></p>
<p>Estoque atual: <?php echo $produto['estoque']; ?></p>

<form action="salvar_saida.php" method="POST">

<input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

<input type="number" name="quantidade" placeholder="Quantidade para saída" required>

<br><br>

<button type="submit">Confirmar Saída</button>

</form>

<?php } else { ?>

<p>Produto não encontrado.</p>

<?php } ?>