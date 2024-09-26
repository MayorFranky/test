<?php
session_start();

if (isset($_POST['admin_login'])) {
    $adminUsername = $_POST['admin_username'];
    $adminPassword = $_POST['admin_password'];

    echo "Username: " . htmlspecialchars($adminUsername) . "<br>";
    echo "Password: " . htmlspecialchars($adminPassword) . "<br>";

    // Pobierz dane administratora z pliku users.json
    $users = json_decode(file_get_contents('data/users.json'), true) ?: [];
    foreach ($users as $user) {
        if ($user['username'] === $adminUsername && password_verify($adminPassword, $user['password']) && $user['role'] === 'admin') {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['user_id'] = $user['id'];
            header('Location: admin-dashboard.php');
            exit;
        }
    }
    $error = 'Niepoprawna nazwa użytkownika lub hasło.';
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administracyjny</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Panel Administracyjny</h1>
    <div class="container">
        <h2>Logowanie administratora</h2>
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?= $error ?></p>
        <?php endif; ?>
        <form method="POST" autocomplete="off">
            <label for="admin_username">Nazwa użytkownika:</label>
            <input type="text" name="admin_username" id="admin_username" required>
            <label for="admin_password">Hasło:</label>
            <input type="password" name="admin_password" id="admin_password" required>
            <input type="submit" name="admin_login" value="Zaloguj się">
        </form>
    </div>
</body>
</html>