<?php

session_start();

include "conectar.php";

$email = $_POST['email'];

$senha = $_POST['senha'];

$sql = "SELECT * FROM usuarios
WHERE email='$email'
AND senha='$senha'";

$resultado = mysqli_query($conn, $sql);

if(mysqli_num_rows($resultado) > 0){

    $_SESSION['usuario'] = $email;

    header("Location: menu.php");

}else{

    echo "Login inválido";

}

?>