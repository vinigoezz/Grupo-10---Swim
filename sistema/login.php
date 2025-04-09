<?php
session_start();
include("conexao.php");

$email = $_POST['email'];
$senha = $_POST['senha'];

// Proteção contra SQL Injection
$email = mysqli_real_escape_string($conn, $email);
$senha = mysqli_real_escape_string($conn, $senha);

$sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $usuario = $result->fetch_assoc();

    // Armazenar dados na sessão
    $_SESSION['id'] = $usuario['id'];
    $_SESSION['nome'] = $usuario['nome'];
    $_SESSION['tipo'] = $usuario['tipo'];

    header("Location: painel.php");
} else {
    echo "Email ou senha incorretos!";
}

?>
