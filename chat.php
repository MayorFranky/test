<?php
session_start();
require 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user = getUserById($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
    <h1>Chat</h1>
    <div id="chat"></div>
    <form id="chatForm">
        <input type="text" id="message" placeholder="Wpisz wiadomość..." required>
        <button type="submit">Wyślij</button>
    </form>
    <script src="../js/scripts.js"></script>
</body>
</html>