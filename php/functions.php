<?php
require 'config.php';

function generateId() {
    return rand(100000, 999999) . chr(rand(65, 90)) . chr(rand(65, 90));
}

function encryptPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}

function validatePassword($password) {
    return strlen($password) >= 8;
}

function saveUser($user) {
    $users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
    $users[] = $user;
    file_put_contents(USER_DATA_FILE, json_encode($users, JSON_PRETTY_PRINT));
    echo "User saved: " . json_encode($user, JSON_PRETTY_PRINT) . "<br>";
}

function getUserByUsername($username) {
    $users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
    foreach ($users as $user) {
        if ($user['username'] === $username) {
            return $user;
        }
    }
    return null;
}

function getUserById($id) {
    $users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
    foreach ($users as $user) {
        if ($user['id'] === $id) {
            return $user;
        }
    }
    return null;
}

function getAllUsers() {
    return json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
}

function isAdmin($id) {
    $user = getUserById($id);
    return $user && $user['role'] === 'admin';
}

function getUpdates($userId) {
    // Pobierz aktualizacje z bazy danych lub pliku JSON
    // Zwróć dane w formacie JSON
    return json_encode([
        'notifications' => [
            ['type' => 'invite', 'from' => 'User123', 'message' => 'Zaproszenie do sesji zdalnej']
        ],
        'messages' => [
            ['from' => 'Admin', 'message' => 'Witaj w systemie']
        ]
    ]);
}

function sendMessage($senderId, $recipientId, $message) {
    // Zapisz wiadomość w bazie danych lub pliku
    // Wyślij powiadomienie do odbiorcy
    // Przykładowo zapis do pliku
    $chatLog = 'chat.log';
    $logEntry = date('Y-m-d H:i:s') . ' - ' . $senderId . ': ' . $message . "\n";
    file_put_contents($chatLog, $logEntry, FILE_APPEND);
    echo "Message sent: " . $logEntry . "<br>";
}

function blockUser($userId) {
    $users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
    foreach ($users as &$user) {
        if ($user['id'] === $userId) {
            $user['role'] = 'blocked';
            break;
        }
    }
    file_put_contents(USER_DATA_FILE, json_encode($users, JSON_PRETTY_PRINT));
    echo "User blocked: " . $userId . "<br>";
}

function banUser($userId) {
    $users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
    foreach ($users as &$user) {
        if ($user['id'] === $userId) {
            $user['role'] = 'banned';
            break;
        }
    }
    file_put_contents(USER_DATA_FILE, json_encode($users, JSON_PRETTY_PRINT));
    echo "User banned: " . $userId . "<br>";
}

function viewSession($userId) {
    // Pobierz dane sesji użytkownika
    // Zwróć dane w formacie JSON
    return json_encode(['session_data' => 'Przykładowe dane sesji']);
}

function changeRole($userId) {
    $users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
    foreach ($users as &$user) {
        if ($user['id'] === $userId) {
            if ($user['role'] === 'user') {
                $user['role'] = 'admin';
            } else {
                $user['role'] = 'user';
            }
            break;
        }
    }
    file_put_contents(USER_DATA_FILE, json_encode($users, JSON_PRETTY_PRINT));
    echo "Role changed for user: " . $userId . "<br>";
}

function changePassword($userId, $newPassword) {
    $users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
    foreach ($users as &$user) {
        if ($user['id'] === $userId) {
            $user['password'] = encryptPassword($newPassword);
            break;
        }
    }
    file_put_contents(USER_DATA_FILE, json_encode($users, JSON_PRETTY_PRINT));
    echo "Password changed for user: " . $userId . "<br>";
}

function changeUserPassword($userId, $oldPassword, $newPassword, $confirmNewPassword) {
    $users = json_decode(file_get_contents(USER_DATA_FILE), true) ?: [];
    foreach ($users as &$user) {
        if ($user['id'] === $userId && password_verify($oldPassword, $user['password']) && $newPassword === $confirmNewPassword) {
            $user['password'] = encryptPassword($newPassword);
            break;
        }
    }
    file_put_contents(USER_DATA_FILE, json_encode($users, JSON_PRETTY_PRINT));
    echo "User password changed: " . $userId . "<br>";
}
?>
