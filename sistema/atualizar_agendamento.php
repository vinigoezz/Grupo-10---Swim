<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}

include("conexao.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = intval($_POST['id']);
    $data = $conn->real_escape_string($_POST['data']);
    $descricao = $conn->real_escape_string($_POST['descricao']);
    $id_usuario = $_SESSION['id'];

    // Verifica se o agendamento pertence ao usuário e ainda está pendente
    $sql = "SELECT a.*, c.id_usuario 
            FROM agendamentos a
            JOIN carros c ON a.id_carro = c.id
            WHERE a.id = $id AND c.id_usuario = $id_usuario AND a.status = 'pendente'";

    $result = $conn->query($sql);

    if ($result->num_rows === 0) {
        echo "Agendamento não encontrado, já concluído ou você não tem permissão para editar.";
        exit;
    }

    // Atualiza a data e descrição
    $update = "UPDATE agendamentos 
               SET data = '$data', descricao = '$descricao' 
               WHERE id = $id";

    if ($conn->query($update) === TRUE) {
        header("Location: meus_agendamentos.php");
        exit;
    } else {
        echo "Erro ao atualizar o agendamento: " . $conn->error;
    }
} else {
    echo "Requisição inválida.";
}
?>
