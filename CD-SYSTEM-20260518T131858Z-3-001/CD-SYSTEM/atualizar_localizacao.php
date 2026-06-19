<?php
include "conectar.php";

$codigo_barras = $_POST['codigo_barras'];
$corredor = strtoupper($_POST['corredor']);
$prateleira = $_POST['prateleira'];
$nivel = $_POST['nivel'];

$sql = "UPDATE produtos
        SET corredor = '$corredor',
            prateleira = '$prateleira',
            nivel = '$nivel'
        WHERE codigo_barras = '$codigo_barras'";

if (mysqli_query($conn, $sql)) {
    echo "<h2>Localização atualizada com sucesso!</h2>";
    echo "<a href='procurar_produto.php?busca=$codigo_barras'>Voltar ao produto</a><br>";
    echo "<a href='menu.php'>Voltar ao menu</a>";
} else {
    echo "Erro ao atualizar localização: " . mysqli_error($conn);
}
?>