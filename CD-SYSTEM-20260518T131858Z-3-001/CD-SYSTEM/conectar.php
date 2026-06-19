<?php
$conn = mysqli_connect("localhost", "root", "", "cd_system");

if (!$conn) {
    die("Erro ao conectar: " . mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
?>