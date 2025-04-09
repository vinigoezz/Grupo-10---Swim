<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}

include("conexao.php");

$id_usuario = $_SESSION['id'];

$sql = "SELECT * FROM carros WHERE id_usuario = $id_usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Meus Carros</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
  <h2>Meus Carros Cadastrados</h2>

  <?php if ($result->num_rows > 0): ?>
    <table border="1" cellpadding="8">
      <tr>
        <th>ID</th>
        <th>Modelo</th>
        <th>Placa</th>
        <th>Ano</th>
        <th>Ações</th>
      </tr>
      <?php while ($row = $result->fetch_assoc()): ?>
  <tr>
    <td><?php echo $row['modelo']; ?></td>
    <td><?php echo $row['placa']; ?></td>
    <td><?php echo $row['ano']; ?></td>
    <td>
  <a href="editar_carro.php?id=<?php echo $row['id']; ?>">Editar</a> |
  <a href="excluir_carro.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Tem certeza que deseja excluir este carro?')">Excluir</a>
</td>
  </tr>
<?php endwhile; ?>

    </table>
  <?php else: ?>
    <p>Você ainda não cadastrou nenhum carro.</p>
  <?php endif; ?>

  <br><a href="painel.php">Voltar ao Painel</a>
  </div>
</body>
</html>
