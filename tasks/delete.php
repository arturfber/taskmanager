<?php
    require_once('../database.php');

    $db = new db();
    $result = $db->delete('tasks', $_POST['id']);

    header("Location: ../pages/taskmanager.php")
?>
