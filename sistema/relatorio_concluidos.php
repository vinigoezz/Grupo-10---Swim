<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}

include("conexao.php");

$id_usuario = $_SESSION['id'];

$sql = "SELECT a.*, c.modelo, c.placa 
        FROM agendamentos a
        JOIN carros c ON a.id_carro = c.id
        WHERE c.id_usuario = $id_usuario AND a.status = 'concluido'
        ORDER BY a.data DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Relatório de Manutenções Concluídas</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
  <h2>Relatório de Manutenções Concluídas</h2>

  <?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="8">
      <tr>
        <th>Carro</th>
        <th>Placa</th>
        <th>Data</th>
        <th>Descrição</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row["modelo"]; ?></td>
        <td><?php echo $row["placa"]; ?></td>
        <td><?php echo $row["data"]; ?></td>
        <td><?php echo $row["descricao"]; ?></td>
      </tr>
      <?php endwhile; ?>
    </table>
  <?php else: ?>
    <p>Você ainda não tem manutenções concluídas.</p>
  <?php endif; ?>

  <br><a href="painel.php">Voltar ao Painel</a>
  </div>
</body>
</html>
