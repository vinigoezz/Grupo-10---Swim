<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastro de Carro</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <div class="container">
    <h2>Cadastro de Carro</h2>
    <form action="cadastrar_carro.php" method="POST">
      <label>Modelo:</label>
      <input type="text" name="modelo" required><br>

      <label>Placa:</label>
      <input type="text" name="placa" required><br>

      <label>Ano:</label>
      <input type="number" name="ano" required><br>

      <button type="submit">Cadastrar Carro</button>
    </form>

    <br>
    <a href="painel.php">
      <button type="button">Voltar ao Painel</button>
    </a>
  </div>
</body>
</html>
