<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}

include("conexao.php");

// Verifica se o ID do carro foi passado na URL
if (!isset($_GET['id'])) {
    echo "ID do carro não informado!";
    exit;
}

$id_carro = intval($_GET['id']);

// Busca os dados do carro no banco
$sql = "SELECT * FROM carros WHERE id = $id_carro AND id_usuario = " . $_SESSION['id'];
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Carro não encontrado ou você não tem permissão!";
    exit;
}

$carro = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Carro</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
  <div class="container">
    <h2>Editar Carro</h2>
    <form action="atualizar_carro.php" method="POST">
      <input type="hidden" name="id" value="<?php echo $carro['id']; ?>">

      <label>Modelo:</label><br>
      <input type="text" name="modelo" value="<?php echo $carro['modelo']; ?>" required><br><br>

      <label>Placa:</label><br>
      <input type="text" name="placa" value="<?php echo $carro['placa']; ?>" required><br><br>

      <label>Ano:</label><br>
      <input type="number" name="ano" value="<?php echo $carro['ano']; ?>" required><br><br>

      <button type="submit">Salvar Alterações</button>
    </form>

    <br><a href="meus_carros.php">Voltar</a>
  </div>
</body>
</html>
