<?php
    session_start();
    require_once('../database.php');

    // Hashing user's password with ARGON2 hash
    // Argon2 is a key derivation function that was selected as the winner of the 2015 Password Hashing Competition. It was designed by Alex Biryukov, Daniel Dinu, and Dmitry Khovratovich from the University of Luxembourg (Wikipedia).
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_ARGON2I);
    
    $data = [];
    foreach ($_POST as $key => $value) {

        if($key == 'email') {
            $data[$key] = filter_var($value, FILTER_SANITIZE_EMAIL);
        } else {
            $data[$key] = $value;
        }
    }

    $db = new db();
    $duplicate = $db->select('accounts', "email", ['email' => $data['email']], '1'); 
    
    // Verifying if e-mail address alrealdy exists
    if(!$duplicate){
        $result = $db->insert('accounts', $data);
        $id = $db->select('accounts', "id", ['email' => $data['email']], '1')[0]['id']; 
        
        $_SESSION['logged'] = true;
        $_SESSION['name'] = $data['name'];
        $_SESSION['id'] = $id;
        $_SESSION['error'] = '';
        header("Location: route.php");

    } else{
        $_SESSION['error'] = "E-mail já cadastrado";
        header("Location: pages/welcome.php");
    }


    
?>
