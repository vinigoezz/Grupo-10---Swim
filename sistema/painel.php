<?php
session_start();

// Se não estiver logado, redireciona pro login
if (!isset($_SESSION['id'])) {
    header("Location: index.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Painel</title>
  <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="container">
  <h2>Bem-vindo, <?php echo $_SESSION['nome']; ?>!</h2>
  <p>Tipo de usuário: <?php echo $_SESSION['tipo']; ?></p>

  <ul>
  <li><a href="form_carro.php">Cadastrar Carro</a></li>
  <li><a href="form_agendar.php">Agendar Manutenção</a></li>
  <li><a href="meus_carros.php">Ver Meus Carros</a></li>
  <li><a href="meus_agendamentos.php">Ver Agendamentos</a></li> 
  <li><a href="relatorio_concluidos.php">Ver Manutenções Concluídas</a></li>
  <li><a href="logout.php">Sair</a></li>
</ul>
</div>
</body>
</html>
