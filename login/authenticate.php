<?php

    $current = basename($_SERVER['PHP_SELF']);
    // print_r(json_encode($_SESSION));
    
    // Verifiy if a session variable is set and if not redirects user
    if(!isset($_SESSION['login'])){

        $_SESSION["login"] = false;

        header("Location: ../pages/welcome.php");
        exit;
        
    } else {

        if(isset($_SESSION['admin'])) {
            if($current != 'admin.php') header("Location: admin.php");
        } else {
            if($_SESSION['login'] === false AND $current != 'welcome.php') {
                header("Location: ../pages/welcome.php");
            } elseif($_SESSION['login'] === true AND $current != 'taskmanager.php') {
                header("Location: ../pages/taskmanager.php");
            } 
        }
    }
    
?>
