<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = getUserByUsername($username);
    if ($user && password_verify($password, $user['password'])) {
        session_start();
        $_SESSION['user_id'] = $user['id'];
        header('Location: dashboard.php');
    } else {
        echo 'Niepoprawna nazwa użytkownika lub hasło.';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <form method="POST">
        <label for="username">Nazwa użytkownika:</label>
        <input type="text" name="username" required>
        <label for="password">Hasło:</label>
        <input type="password" name="password" required>
        <button type="submit">Zaloguj się</button>
    </form>
</body>
</html>