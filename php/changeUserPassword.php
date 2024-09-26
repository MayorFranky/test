<?php
require 'php/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['userId']) && isset($_POST['oldPassword']) && isset($_POST['newPassword']) && isset($_POST['confirmNewPassword'])) {
    $userId = $_POST['userId'];
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmNewPassword = $_POST['confirmNewPassword'];

    // Sprawdź, czy nowe hasło spełnia wymagania
    if (validatePassword($newPassword)) {
        $user = getUserById($userId);
        if ($user && password_verify($oldPassword, $user['password']) && $newPassword === $confirmNewPassword) {
            $user['password'] = encryptPassword($newPassword);
            updateUser($user);
            echo 'Hasło użytkownika zmienione!';
        } else {
            echo 'Niepoprawne stare hasło lub hasła nie są identyczne!';
        }
    } else {
        echo 'Nowe hasło musi mieć co najmniej 8 znaków.';
    }
} else {
    echo 'Wszystkie pola muszą być wypełnione.';
}
?>
