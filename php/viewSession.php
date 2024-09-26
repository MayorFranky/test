<?php
require 'functions.php';

if (isset($_POST['userId'])) {
    $userId = $_POST['userId'];
    $sessionData = viewSession($userId);
    echo $sessionData;
}


?>