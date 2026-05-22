<?php

include "conectar.php";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];

$sql = "INSERT INTO usuarios(nome, email, senha)
VALUES('$nome', '$email', '$senha')";

if(mysqli_query($conn, $sql)) {

    echo "Usuário cadastrado!";

} else {

    echo "Erro ao cadastrar";

}