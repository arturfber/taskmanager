<?php

    require_once('../database.php');

    $id = $_POST['id'];
    unset($_POST['id']);

    $data = [];
    foreach ($_POST as $key => $value) {
        $data[$key] = $value;
    }

    if($data['status'] == 'Concluido'){
        $data['conclusion_date'] = date("Y/m/d");
    } elseif($data['status'] == 'Pendente'){
        $data['conclusion_date'] = 'NULL';
    }

    $db = new db();
    $result = $db->update('tasks', $data, $id);

    header("Location: ../pages/taskmanager.php")
    
?>
