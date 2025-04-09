<?php
include("conexao.php");

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$tipo = $_POST['tipo'];

// Protege os dados contra SQL Injection
$nome = mysqli_real_escape_string($conn, $nome);
$email = mysqli_real_escape_string($conn, $email);
$senha = mysqli_real_escape_string($conn, $senha);
$tipo = mysqli_real_escape_string($conn, $tipo);

// Insere no banco de dados
$sql = "INSERT INTO usuarios (nome, email, senha, tipo) 
        VALUES ('$nome', '$email', '$senha', '$tipo')";

if ($conn->query($sql) === TRUE) {
    echo "Usuário cadastrado com sucesso!";
    // Você pode redirecionar para o login se quiser
    // header("Location: index.html");
} else {
    echo "Erro: " . $conn->error;
}
?>
