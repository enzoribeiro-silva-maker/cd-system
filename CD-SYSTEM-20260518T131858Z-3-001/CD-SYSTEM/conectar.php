<?php

$host = "127.0.0.1";
$user = "root";
$pass = "";
$db = "cd_system";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {

    die("Erro na conexão");

}

