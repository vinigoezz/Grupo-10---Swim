<?php
include("conexao.php");

$id_usuario = $_POST['id_usuario'];
$modelo = $_POST['modelo'];
$placa = $_POST['placa'];
$ano = $_POST['ano'];

$sql = "INSERT INTO carros (id_usuario, modelo, placa, ano)
        VALUES ('$id_usuario', '$modelo', '$placa', '$ano')";

if ($conn->query($sql) === TRUE) {
    echo "Carro cadastrado com sucesso!";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}
?>
