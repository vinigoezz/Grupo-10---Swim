<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}

include("conexao.php");

if (!isset($_GET['id'])) {
    echo "ID do agendamento não informado.";
    exit;
}

$id_agendamento = intval($_GET['id']);
$id_usuario = $_SESSION['id'];

// Buscar dados do agendamento, verificando se o carro pertence ao usuário logado
$sql = "SELECT a.*, c.modelo, c.placa
        FROM agendamentos a
        JOIN carros c ON a.id_carro = c.id
        WHERE a.id = $id_agendamento AND c.id_usuario = $id_usuario";

$result = $conn->query($sql);

if ($result->num_rows === 0) {
    echo "Agendamento não encontrado ou não pertence a você.";
    exit;
}

$agendamento = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Agendamento</title>
</head>
<body>
    <h2>Editar Agendamento</h2>

    <p><strong>Carro:</strong> <?php echo $agendamento['modelo']; ?> - <?php echo $agendamento['placa']; ?></p>

    <form action="atualizar_agendamento.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $agendamento['id']; ?>">

        <label>Data:</label><br>
        <input type="date" name="data" value="<?php echo $agendamento['data']; ?>" required><br><br>

        <label>Descrição:</label><br>
        <textarea name="descricao" required><?php echo $agendamento['descricao']; ?></textarea><br><br>

        <button type="submit">Salvar Alterações</button>
    </
