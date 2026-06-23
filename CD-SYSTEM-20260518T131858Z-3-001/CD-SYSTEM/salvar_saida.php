<?php
include "conectar.php";

$codigo_barras = $_POST['codigo_barras'];
$produto = $_POST['produto'];
$quantidade = intval($_POST['quantidade']);
$motivo = $_POST['motivo'];

$verifica = mysqli_query($conn, "SELECT * FROM produtos 
WHERE codigo_barras = '$codigo_barras'
OR codigo = '$codigo_barras'");

if(mysqli_num_rows($verifica) == 0){
    die("Produto não encontrado.<br><a href='saida_produto.php'>Voltar</a>");
}

$dado = mysqli_fetch_assoc($verifica);
$estoqueAtual = intval($dado['estoque']);

if($estoqueAtual < $quantidade){
    die("Estoque insuficiente. Estoque atual: $estoqueAtual<br><a href='saida_produto.php'>Voltar</a>");
}

$sqlProduto = "UPDATE produtos
               SET estoque = estoque - $quantidade
               WHERE codigo_barras = '$codigo_barras'
               OR codigo = '$codigo_barras'";

mysqli_query($conn, $sqlProduto);

$sqlMov = "INSERT INTO movimentacoes
(codigo_barras, produto, quantidade, localizacao, tipo, data_movimentacao)
VALUES
('$codigo_barras', '$produto', $quantidade, '$motivo', 'SAIDA', NOW())";

if(mysqli_query($conn, $sqlMov)){
    echo "<h2>Saída registrada com sucesso!</h2>";
    echo "<a href='saida_produto.php'>Nova saída</a><br>";
    echo "<a href='movimentacoes.php'>Ver movimentações</a><br>";
    echo "<a href='menu.php'>Voltar ao menu</a>";
}else{
    echo "Erro: " . mysqli_error($conn);
}
?>