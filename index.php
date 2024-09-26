<?php
require 'php/functions.php';
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Udostępnianie Pulpitu</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Udostępnianie Pulpitu</h1>
    <div class="container">
        <div class="form-container">
            <h2>Rejestracja</h2>
            <form action="register.php" method="POST">
                <label for="username">Nazwa użytkownika:</label>
                <input type="text" name="username" required>
                <label for="password">Hasło:</label>
                <input type="password" name="password" required>
                <label for="role">Rola:</label>
                <input type="text" name="role" required>
                <button type="submit">Zarejestruj się</button>
            </form>
        </div>
        <div class="form-container">
            <h2>Logowanie</h2>
            <form action="login.php" method="POST">
                <label for="login_username">Nazwa użytkownika:</label>
                <input type="text" name="login_username" required>
                <label for="login_password">Hasło:</label>
                <input type="password" name="login_password" required>
                <button type="submit">Zaloguj się</button>
            </form>
        </div>
    </div>
</body>
</html>
