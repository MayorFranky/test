<?php
require 'functions.php';

if (isset($_POST['message']) && isset($_POST['senderId']) && isset($_POST['recipientId'])) {
    sendMessage($_POST['senderId'], $_POST['recipientId'], $_POST['message']);
    echo 'Wiadomość wysłana!';
}

function getSessionData($userId) {
    // Pobierz dane sesji z bazy danych lub pliku
    // Zwróć dane w formacie JSON
    return json_encode(['session_data' => 'Przykładowe dane sesji']);
}

function updateUser($user) {
    $users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
    foreach ($users as &$existingUser) {
        if ($existingUser['id'] === $user['id']) {
            $existingUser = $user;
            break;
        }
    }
    file_put_contents(USER_DATA_FILE, json_encode($users));
}

function sendMessage($senderId, $recipientId, $message) {
    // Zapisz wiadomość w bazie danych lub pliku
    // Wyślij powiadomienie do odbiorcy
}
?>