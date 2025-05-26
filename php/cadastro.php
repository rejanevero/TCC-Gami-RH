<?php
require 'db.php';

$nome = $_POST['nome'] ?? '';
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';
$equipe = $_POST['equipe'] ?? '';

$erros = [];

if (empty($nome)) $erros[] = "Nome é obrigatório.";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $erros[] = "E-mail inválido.";
if (empty($senha) || strlen($senha) < 6) $erros[] = "Senha deve ter ao menos 6 caracteres.";
if (empty($equipe)) $erros[] = "Selecione uma equipe.";

if (count($erros) > 0) {
  foreach ($erros as $erro) {
    echo "<p style='color:red;'>$erro</p>";
  }
  exit;
}

// Evita duplicidade de e-mail
$sqlCheck = "SELECT id FROM colaboradores WHERE email = ?";
$stmtCheck = $conn->prepare($sqlCheck);
$stmtCheck->bind_param("s", $email);
$stmtCheck->execute();
$stmtCheck->store_result();

if ($stmtCheck->num_rows > 0) {
  echo "<p style='color:red;'>E-mail já cadastrado.</p>";
  exit;
}

// Hash da senha
$senhaHash = password_hash($senha, PASSWORD_DEFAULT);

$sql = "INSERT INTO colaboradores (nome, email, senha, equipe) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nome, $email, $senhaHash, $equipe);

if ($stmt->execute()) {
  echo "<p style='color:green;'>Cadastro realizado com sucesso!</p>";
} else {
  echo "<p style='color:red;'>Erro ao cadastrar: " . $conn->error . "</p>";
}
?>