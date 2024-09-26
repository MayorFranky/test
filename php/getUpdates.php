<?php
require 'functions.php';

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $updates = getUpdates($userId);
    echo $updates;
}
?>