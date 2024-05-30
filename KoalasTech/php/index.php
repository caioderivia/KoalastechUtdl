<?php
include('conexao.php');

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);

    $sql = "SELECT * FROM registro WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuario = $result->fetch_assoc();

        if (password_verify($password, $usuario['senha'])) {
            if (!isset($_SESSION)) {
                session_start();
            }
            $_SESSION['id'] = $usuario['id'];
            $_SESSION['username'] = $usuario['username'];

            header("Location: painel.php");
            exit();
        } else {
            echo "Falha ao logar! E-mail ou senha incorretos.";
        }
    } else {
        echo "Falha ao logar! E-mail ou senha incorretos.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Preencha todos os campos!";
}
?>
