<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}

include("conexao.php");

$id_usuario = $_SESSION['id'];

$sql = "SELECT id, modelo, placa FROM carros WHERE id_usuario = $id_usuario";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Agendar Manutenção</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
  <h2>Agendar Manutenção</h2>

  <form action="agendar_salvar.php" method="POST">
    <label>Selecione o carro:</label><br>
    <select name="id_carro" required>
      <option value="">-- Selecione --</option>
      <?php while ($row = $result->fetch_assoc()): ?>
        <option value="<?php echo $row['id']; ?>">
          <?php echo $row['modelo'] . " - " . $row['placa']; ?>
        </option>
      <?php endwhile; ?>
    </select><br><br>

    <label>Data da manutenção:</label><br>
    <input type="date" name="data" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao" rows="4" cols="40" required></textarea><br><br>

    <button type="submit">Agendar</button>
  </form>

  <br><a href="painel.php">Voltar ao Painel</a>
  </div>
</body>
</html>
