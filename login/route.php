<?php

    // Verifying if logged user is a admin
    session_start();
    require_once('../connection.php');

    $sql = "SELECT accounts.id FROM accounts INNER JOIN user_permissions user_perm on user_perm.user_id = $_SESSION[id] INNER JOIN permissions on permissions.id = user_perm.permission_id WHERE accounts.id = $_SESSION[id] AND permissions.id = 1";

    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        header("Location: ../pages/admin.php");
        $_SESSION['admin'] = true;
    } else {
        header("Location: ../pages/taskmanager.php");
    }

?>