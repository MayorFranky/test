<?php
require 'php/functions.php';

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $user = getUserById($userId);
    if ($user) {
        // Zmień hasło użytkownika
        $newPassword = $_POST['newPassword'];
        $user['password'] = encryptPassword($newPassword);
        updateUser($user);
        echo 'Hasło użytkownika zmienione!';
    } else {
        echo 'Użytkownik nie znaleziony!';
    }
}
?>
