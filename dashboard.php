<?php
require 'php/functions.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$user = getUserById($_SESSION['user_id']);

if (!$user) {
    header('Location: index.php');
    exit;
}

$updates = getUpdates($user['id']);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="js/script.js"></script>
</head>
<body>
    <h1>Dashboard</h1>
    <div class="container">
        <h2>Witaj, <?= $user['username'] ?></h2>
        <div class="updates">
            <h3>Powiadomienia</h3>
            <ul>
                <?php foreach ($updates['notifications'] as $notification) : ?>
                    <li>
                        <?= $notification['type'] === 'invite' ? 'Zaproszenie do sesji zdalnej' : $notification['message'] ?>
                        od <?= $notification['from'] ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="messages">
            <h3>Wiadomości</h3>
            <ul>
                <?php foreach ($updates['messages'] as $message) : ?>
                    <li>
                        <?= $message['message'] ?>
                        od <?= $message['from'] ?>
                    </li>
                <?php endforeach; ?>
            </ul>
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
        <div class="change-password">
            <h3>Zmień hasło</h3>
            <form action="" method="post">
                <label for="old-password">Stare hasło:</label>
                <input type="password" name="old-password" id="old-password" required>
                <label for="new-password">Nowe hasło:</label>
                <input type="password" name="new-password" id="new-password" required>
                <label for="confirm-password">Potwierdź nowe hasło:</label>
                <input type="password" name="confirm-password" id="confirm-password" required>
                <button type="submit">Zmień hasło</button>
            </form>
            <?php if (isset($_POST['old-password']) && isset($_POST['new-password']) && isset($_POST['confirm-password'])) {
                changeUserPassword($_SESSION['user_id'], $_POST['old-password'], $_POST['new-password'], $_POST['confirm-password']);
                echo 'Hasło zmienione!';
            } ?>
        </div>
    </div>
</body>
</html>
