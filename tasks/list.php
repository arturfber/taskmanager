<?php

    require_once('../database.php');

    $db = new db();

    $tasks = $db->select('tasks', '*', ['account_id' => $_SESSION['id']]);

?>
