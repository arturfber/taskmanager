<?php
    session_start();
    require_once('../database.php');
    require_once "../util/functions.php";
    

    $data = [];
    foreach ($_POST as $key => $value) {

        if($key == 'email') {
            $data[$key] = filter_var($value, FILTER_SANITIZE_EMAIL);
        } else {
            $data[$key] = $value;
        }
    }

    $db = new db();
    $result = $db->select('accounts', 'id, name, password', ['email' => $data['email']], '1');


    if($result){
        $result = $result[0];

        if(password_verify($data['password'], $result['password'])){
            $_SESSION['logged'] = true;
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['name'];
            $_SESSION['permissions'] = get_account_permissions($result['id']);
            $_SESSION['error'] = '';
            header("Location: route.php");
        } else {
            $_SESSION['error'] = "E-mail ou senha inválidos";
            header("Location: ../pages/welcome.php");
        }
    } else {
        $_SESSION['error'] = "E-mail ou senha inválidos";
        header("Location: ../pages/welcome.php");
    }

?>
