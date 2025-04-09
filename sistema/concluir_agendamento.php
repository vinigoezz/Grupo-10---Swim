<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}

include("conexao.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "UPDATE agendamentos SET status = 'concluído' WHERE id = $id";
    if ($conn->query($sql) === TRUE) {
        header("Location: meus_agendamentos.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
} else {
    echo "ID inválido.";
}
?>
