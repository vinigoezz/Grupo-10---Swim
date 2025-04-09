<?php
include("conexao.php");

$id_carro = $_POST['id_carro'];
$data = $_POST['data'];
$descricao = $_POST['descricao'];

$status = 'pendente'; // status inicial

$sql = "INSERT INTO agendamentos (id_carro, data, descricao, status)
        VALUES ('$id_carro', '$data', '$descricao', '$status')";

if ($conn->query($sql) === TRUE) {
    echo "Manutenção agendada com sucesso!";
} else {
    echo "Erro ao agendar: " . $conn->error;
}
?>
