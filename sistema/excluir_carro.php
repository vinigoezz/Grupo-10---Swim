<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}

include("conexao.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Verifica se ainda há agendamentos pendentes ou em andamento
    $check = $conn->query("SELECT * FROM agendamentos WHERE id_carro = $id AND status != 'concluido'");
    if ($check->num_rows > 0) {
        echo "Não é possível excluir este carro porque ele possui agendamentos pendentes ou em andamento.";
        exit;
    }

    // Exclui agendamentos concluídos relacionados a este carro
    $conn->query("DELETE FROM agendamentos WHERE id_carro = $id AND status = 'concluido'");

    // Agora pode excluir o carro
    $sql = "DELETE FROM carros WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: meus_carros.php");
        exit;
    } else {
        echo "Erro ao excluir o carro: " . $conn->error;
    }
} else {
    echo "ID inválido.";
}
?>
