<?php

    $current = basename($_SERVER['PHP_SELF']);

    // Verifiy if a session variable is set and if not redirects user
    if(!isset($_SESSION['logged'])){

        $_SESSION["logged"] = false;

        header("Location: /projeto/pages/welcome.php");
        exit;
        
    } else {

        if(isset($_SESSION['admin'])) {
            if($current != 'admin.php') header("Location: /projeto/admin.php");
        } else {
            if($_SESSION['logged'] === false AND $current != 'welcome.php') {
                header("Location: /projeto/pages/welcome.php");
            } elseif($_SESSION['logged'] === true AND $current != 'taskmanager.php') {
                header("Location: /projeto/pages/taskmanager.php");
            } 
        }
    }
    
?>
