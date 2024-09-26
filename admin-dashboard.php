<?php
require 'php/functions.php';
session_start();

if (!isset($_SESSION['admin_logged_in']) || !$_SESSION['admin_logged_in']) {
    header('Location: admin.php');
    exit;
}

$users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
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
        <h2>Użytkownicy</h2>
        <table class="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nazwa użytkownika</th>
                    <th>Rola</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td><?= $user['id'] ?></td>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['role'] ?></td>
                        <td>
                            <button onclick="blockUser('<?= $user['id'] ?>')">Blokuj</button>
                            <button onclick="banUser('<?= $user['id'] ?>')">Banuj</button>
                            <button onclick="viewSession('<?= $user['id'] ?>')">Podgląd sesji</button>
                            <button onclick="changeRole('<?= $user['id'] ?>')">Zmień rolę</button>
                            <button onclick="changePassword('<?= $user['id'] ?>')">Zmień hasło</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <h2>Sesje</h2>
        <table class="sessions-table">
            <thead>
                <tr>
                    <th>ID sesji</th>
                    <th>Użytkownik</th>
                    <th>Status</th>
                    <th>Akcje</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dodaj tutaj tabele sesji -->
            </tbody>
        </table>
        <h2>Wiadomości</h2>
        <form action="" method="post">
            <label for="message">Wiadomość:</label>
            <textarea name="message" id="message" required></textarea>
            <button type="submit">Wyślij</button>
        </form>
        <?php if (isset($_POST['message'])) {
            sendMessage($_SESSION['user_id'], null, $_POST['message']);
            echo 'Wiadomość wysłana!';
        } ?>
    </div>
    <form method="post" style="text-align: right;">
        <button type="submit" name="logout">Wyloguj się</button>
    </form>
    <script>
        function blockUser(userId) {
            fetch('/php/blockUser.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId: userId })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        }

        function banUser(userId) {
            fetch('/php/banUser.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId: userId })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        }

        function viewSession(userId) {
            fetch('/php/viewSession.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId: userId })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        }

        function changeRole(userId) {
            fetch('/php/changeRole.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId: userId })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        }

        function changePassword(userId) {
            fetch('/php/changePassword.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ userId: userId })
            })
            .then(response => response.json())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>