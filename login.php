<?php
require 'php/functions.php';
session_start(); // Rozpocznij sesję na początku skryptu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];

    echo "Received login data:<br>";
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "Password: " . htmlspecialchars($password) . "<br>";

    $user = getUserByUsername($username);
    if ($user) {
        echo "User found:<br>";
        echo "User ID: " . htmlspecialchars($user['id']) . "<br>";
        echo "User Role: " . htmlspecialchars($user['role']) . "<br>";
        echo "Hashed Password: " . htmlspecialchars($user['password']) . "<br>";

        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: dashboard.php');
            exit;
        } else {
            echo 'Niepoprawna nazwa użytkownika lub hasło.';
        }
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
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Logowanie</h1>
    <div class="container">
        <form method="POST">
            <label for="login_username">Nazwa użytkownika:</label>
            <input type="text" name="login_username" required>
            <label for="login_password">Hasło:</label>
            <input type="password" name="login_password" required>
            <button type="submit">Zaloguj się</button>
        </form>
    </div>
</body>
</html>
