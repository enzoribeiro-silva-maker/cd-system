<?php
include "conectar.php";

$sql = "SELECT * FROM movimentacoes ORDER BY data_movimentacao DESC";
$resultado = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Histórico de Movimentações</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:Arial, sans-serif;
}

body{
    background:#eef1f5;
    color:#1f2937;
}

.topo{
    background:#17202c;
    color:white;
    padding:22px 36px;
}

.container{
    padding:28px 36px;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border:1px solid #d5dbe3;
}

th, td{
    padding:12px;
    border-bottom:1px solid #e5e7eb;
    text-align:left;
}

th{
    background:#1f2937;
    color:white;
}

.entrada{
    color:green;
    font-weight:bold;
}

.saida{
    color:#b91c1c;
    font-weight:bold;
}

.voltar{
    display:inline-block;
    margin-top:20px;
    background:#1f2937;
    color:white;
    padding:12px 18px;
    text-decoration:none;
    border-radius:5px;
}
</style>
</head>

<body>

<div class="topo">
    <h1>Histórico de Movimentações</h1>
</div>

<div class="container">

<table>
<tr>
    <th>Produto</th>
    <th>Quantidade</th>
    <th>Tipo</th>
    <th>Localização / Motivo</th>
    <th>Data</th>
</tr>

<?php while($mov = mysqli_fetch_assoc($resultado)): ?>
<tr>
    <td><?php echo $mov['produto']; ?></td>
    <td><?php echo $mov['quantidade']; ?></td>
    <td class="<?php echo strtolower($mov['tipo']); ?>">
        <?php echo $mov['tipo']; ?>
    </td>
    <td><?php echo $mov['localizacao']; ?></td>
    <td><?php echo $mov['data_movimentacao']; ?></td>
</tr>
<?php endwhile; ?>

</table>

<a class="voltar" href="menu.php">Voltar ao menu</a>

</div>

</body>
</html>