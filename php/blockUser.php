<?php
require 'functions.php';

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $user = getUserById($userId);
    if ($user) {
        $user['role'] = 'blocked';
        updateUser($user);
        echo 'Użytkownik zablokowany!';
    } else {
        echo 'Użytkownik nie znaleziony!';
    }
}
?>
