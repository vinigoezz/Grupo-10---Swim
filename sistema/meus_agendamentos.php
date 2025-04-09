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
        WHERE c.id_usuario = $id_usuario
        ORDER BY a.data DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meus Agendamentos</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
  <h2>Minhas Manutenções Agendadas</h2>

  <?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="8">
      <tr>
        <th>Carro</th>
        <th>Placa</th>
        <th>Data</th>
        <th>Descrição</th>
        <th>Status</th>
      </tr>
      <?php while($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?php echo $row["modelo"]; ?></td>
    <td><?php echo $row["placa"]; ?></td>
    <td><?php echo $row["data"]; ?></td>
    <td><?php echo $row["descricao"]; ?></td>
    <td>
  <?php echo ucfirst($row["status"]); ?>
  <?php if ($row["status"] === "pendente"): ?>
  | <a href="editar_agendamento.php?id=<?php echo $row['id']; ?>">Editar</a>
  | <a href="concluir_agendamento.php?id=<?php echo $row['id']; ?>">Concluir</a>
<?php endif; ?>
  | <a href="excluir_agendamento.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este agendamento?');">Excluir</a>
</td>

  </tr>
<?php endwhile; ?>

    </table>
  <?php else: ?>
    <p>Você ainda não agendou nenhuma manutenção.</p>
  <?php endif; ?>

  <br><a href="painel.php">Voltar ao Painel</a>
  </div>
</body>
</html>
