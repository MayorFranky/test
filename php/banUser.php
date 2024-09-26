<?php
require 'functions.php';

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $user = getUserById($userId);
    if ($user) {
        $user['role'] = 'banned';
        updateUser($user);
        echo 'Użytkownik zbanowany!';
    } else {
        echo 'Użytkownik nie znaleziony!';
    }
}
?>
