<?php
include "conectar.php";

$codigo_barras = $_POST['codigo_barras'];
$produto = $_POST['produto'];
$quantidade = intval($_POST['quantidade']);
$corredor = strtoupper($_POST['corredor']);
$prateleira = $_POST['prateleira'];
$nivel = $_POST['nivel'];

$localizacao = $corredor . "-" . $prateleira . "-N" . $nivel;

$verifica = mysqli_query($conn, "SELECT * FROM produtos WHERE codigo_barras = '$codigo_barras'");

if (mysqli_num_rows($verifica) > 0) {

    $sqlProduto = "UPDATE produtos
                   SET estoque = estoque + $quantidade,
                       corredor = '$corredor',
                       prateleira = '$prateleira',
                       nivel = '$nivel'
                   WHERE codigo_barras = '$codigo_barras'";

} else {

    $sqlProduto = "INSERT INTO produtos
                   (codigo_barras, nome, corredor, prateleira, nivel, estoque)
                   VALUES
                   ('$codigo_barras', '$produto', '$corredor', '$prateleira', '$nivel', $quantidade)";
}

mysqli_query($conn, $sqlProduto);

$sqlMov = "INSERT INTO movimentacoes
(codigo_barras, produto, quantidade, localizacao, tipo, data_movimentacao)
VALUES
('$codigo_barras', '$produto', $quantidade, '$localizacao', 'ENTRADA', NOW())";

if(mysqli_query($conn, $sqlMov)){

    echo "<h2>Recebimento salvo com sucesso!</h2>";
    echo "<a href='recebimento.php'>Novo recebimento</a><br>";
    echo "<a href='movimentacoes.php'>Ver movimentações</a><br>";
    echo "<a href='menu.php'>Voltar ao menu</a>";

}else{

    echo "Erro: " . mysqli_error($conn);

}
?>