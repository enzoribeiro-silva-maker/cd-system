<?php
$codigo = $_GET['codigo'] ?? "";
?>

<h1>Entrada de Produto</h1>

<form action="salvar_recebimento.php" method="POST">

<input type="text" name="codigo_barras" value="<?php echo $codigo; ?>" placeholder="Código" required><br><br>

<input type="text" name="produto" placeholder="Produto" required><br><br>

<input type="number" name="quantidade" placeholder="Quantidade recebida" required><br><br>

<input type="text" name="corredor" placeholder="Corredor" required><br><br>

<input type="number" name="prateleira" placeholder="Prateleira" required><br><br>

<input type="number" name="nivel" placeholder="Nível" required><br><br>

<button type="submit">Confirmar Entrada</button>

</form>