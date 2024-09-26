<?php
require 'functions.php';

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $user = getUserById($userId);
    if ($user) {
        if ($user['role'] === 'user') {
            $user['role'] = 'admin';
        } else {
            $user['role'] = 'user';
        }
        updateUser($user);
        echo 'Rola użytkownika zmieniona!';
    } else {
        echo 'Użytkownik nie znaleziony!';
    }
}
?>
