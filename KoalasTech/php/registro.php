<?php
include('conexao.php');

// Obtenha os valores do formulário
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm-password'];

// Verifique se todos os campos estão preenchidos
if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
    $conn->close();
    header("Location: erro.html"); // Redireciona para erro.html se algum campo estiver vazio
    exit();
}

// Verifique se as senhas coincidem
if ($password !== $confirm_password) {
    $conn->close();
    header("Location: erro.html"); // Redireciona para erro.html se as senhas não coincidirem
    exit();
}

// Prepare o statement SQL
$stmt = $conn->prepare("INSERT INTO registro (username, email, senha) VALUES (?, ?, ?)");
if (!$stmt) {
    $conn->close();
    header("Location: erro.html"); // Redireciona para erro.html em caso de falha na preparação do statement
    exit();
}

// Criptografe a senha
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$stmt->bind_param("sss", $username, $email, $hashed_password);

// Execute o statement
if (!$stmt->execute()) {
    $stmt->close();
    $conn->close();
    header(Location: "./index.html"); // Redireciona para erro.html em caso de falha na execução
    exit();
}

// Feche o statement e a conexão
$stmt->close();
$conn->close();

// Redirecione para a página de login
header("Location: login.html");
exit();
?>
