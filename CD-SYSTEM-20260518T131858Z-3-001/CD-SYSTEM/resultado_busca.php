<?php

include "conectar.php";

$busca = $_GET['busca'];

$sql = "SELECT * FROM produtos
WHERE nome LIKE '%$busca%'
OR codigo LIKE '%$busca%'";

$resultado = mysqli_query($conn, $sql);

while($produto = mysqli_fetch_assoc($resultado)) {

    echo "<h2>Produto Encontrado</h2>";

    echo "Nome: " . $produto['nome'];

    echo "<br><br>";

    echo "Código: " . $produto['codigo'];

    echo "<br><br>";

    echo "Corredor: " . $produto['corredor'];

    echo "<br><br>";

    echo "Prateleira: " . $produto['prateleira'];

    echo "<br><br>";

    echo "Estoque: " . $produto['estoque'];

    echo "<hr>";
}