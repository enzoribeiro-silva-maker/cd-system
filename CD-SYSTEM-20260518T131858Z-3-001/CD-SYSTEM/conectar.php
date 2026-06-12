<?php
$host = "sql211.infinityfree.com";
$usuario = "if0_42079078";
$senha = "257319AM";
$banco = "if0_42079078_cd_system";

$conn = mysqli_connect($host, $usuario, $senha, $banco);

if (!$conn) {
    die("Erro ao conectar: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>