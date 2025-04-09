<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}

include("conexao.php");

// Pegando os dados do formulário
$id_carro = intval($_POST['id']);
$modelo = $_POST['modelo'];
$placa = $_POST['placa'];
$ano = intval($_POST['ano']);

// Atualizando o carro no banco de dados
$sql = "UPDATE carros SET modelo = '$modelo', placa = '$placa', ano = $ano WHERE id = $id_carro AND id_usuario = " . $_SESSION['id'];

if ($conn->query($sql) === TRUE) {
    header("Location: meus_carros.php");
} else {
    echo "Erro ao atualizar carro: " . $conn->error;
}
?>
