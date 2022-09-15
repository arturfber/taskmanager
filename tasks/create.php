<?php

    require_once('../database.php');

    $data = [];
    foreach ($_POST as $key => $value) {
        $data[$key] = $value;
    }
    $data['creation_date'] = date("Y/m/d");

    $db = new db();
    $result = $db->insert('tasks', $data);

    header("Location: ../pages/taskmanager.php")
    
?>
