<?php
require 'php/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // Wyświetl dane z formularza
    echo "Username: " . htmlspecialchars($username) . "<br>";
    echo "Password: " . htmlspecialchars($password) . "<br>";
    echo "Role: " . htmlspecialchars($role) . "<br>";

    // Sprawdź, czy nazwa użytkownika już istnieje
    if (getUserByUsername($username)) {
        echo 'Nazwa użytkownika już istnieje.';
    } elseif (validatePassword($password)) {
        // Haszuj hasło
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        echo "Hashed Password: " . htmlspecialchars($hashedPassword) . "<br>";

        // Pobierz istniejące dane użytkowników
        $users = json_decode(file_get_contents('data/users.json'), true) ?: [];
        echo "Existing Users: " . json_encode($users, JSON_PRETTY_PRINT) . "<br>";

        // Dodaj nowego użytkownika
        $newUser = [
            'id' => generateId(),
            'username' => $username,
            'password' => $hashedPassword,
            'role' => $role
        ];
        $users[] = $newUser;

        // Wyświetl aktualizowane dane użytkowników
        echo "Updated Users: " . json_encode($users, JSON_PRETTY_PRINT) . "<br>";

        // Zapisz dane użytkowników z powrotem do pliku
        $result = file_put_contents('data/users.json', json_encode($users, JSON_PRETTY_PRINT));
        if ($result === false) {
            echo "Error writing to file.";
        } else {
            echo "Data successfully written to file.";
        }

        // Przekieruj do strony logowania lub innej strony
        header('Location: login.php');
        exit;
    } else {
        echo 'Hasło musi mieć co najmniej 8 znaków.';
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Rejestracja</h1>
    <div class="container">
        <form method="POST">
            <label for="username">Nazwa użytkownika:</label>
            <input type="text" name="username" required>
            <label for="password">Hasło:</label>
            <input type="password" name="password" required>
            <label for="role">Rola:</label>
            <input type="text" name="role" required>
            <button type="submit">Zarejestruj się</button>
        </form>
    </div>
</body>
</html>
