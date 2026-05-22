
<?php

include "conectar.php";

$sql = "SELECT * FROM movimentacoes
ORDER BY data_movimentacao DESC";

$resultado = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">

<title>Movimentações</title>

<style>

body{

    font-family:Arial;
    padding:40px;
    background:#f4f4f4;

}

table{

    width:100%;
    border-collapse:collapse;
    background:white;

}

th, td{

    border:1px solid #ddd;
    padding:12px;
    text-align:center;

}

th{

    background:#333;
    color:white;

}

</style>

</head>

<body>

<h1>Histórico de Movimentações</h1>

<table>

<tr>

<th>Produto</th>
<th>Quantidade</th>
<th>Local</th>
<th>Data</th>

</tr>

<?php

while($mov = mysqli_fetch_assoc($resultado)){

    echo "<tr>";

    echo "<td>".$mov['produto']."</td>";

    echo "<td>".$mov['quantidade']."</td>";

    echo "<td>".$mov['localizacao']."</td>";

    echo "<td>".$mov['data_movimentacao']."</td>";

    echo "</tr>";

}

?>

</table>

</body>
</html>