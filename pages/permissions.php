<?php
    require_once('../connection.php');

    // Already set permissions
    $permissions = json_decode($_POST['permissions']);
    unset($_POST['permissions']);

    // New assigned permissions
    $data = [];
    foreach ($_POST as $key => $value) {
        $data[$key] = $value;
    }


    $insert = [];
    $delete = [];
    // Merging data of Already set and new permissions
    foreach ($data as $field => $content) {
        foreach ($permissions as $permission => $value) {
            if($permission == $field){
                if($content == "true"){
                    if(empty($value)){
                        $insert[] = $field;
                    }
                } else {
                    if(!empty($value)){
                        $delete[] = $field;
                    }
                }
            }
        }
    }

    $permissions_table = [
        'admin' => 1,
        'view' => 2,
        'edit' => 3,
        'insert' => 4,
        'delete' => 5,
        'print' => 6
    ];


    // Mounting SQL query based on grated/revoked permissions
    // INSERT
    $insert_values = [];
    $delete_values = [];
    foreach ($permissions_table as $permission => $value) {

        // INSERT
        foreach ($insert as $field) {
            if($permission == $field){
                $insert_values[] = "(" . $_POST['account_id'] . ", " . $value . ")";
            }
        }

        // DELETE
        foreach ($delete as $field) {
            if($permission == $field){
                $delete_values[] = "(" . $_POST['account_id'] . ", " . $value . ")";
            }
        }

    }


    // INSERT
    $insert_sql = "INSERT INTO account_permissions (user_id, permission_id) VALUES ";

    foreach ($insert_values as $key => $value) {
        if($value != end($insert_values)){
            $insert_sql .= $value . ", ";
        } else {
            $insert_sql .= $value;
        }
    }


    // DELETE
    $delete_sql = "DELETE FROM account_permissions WHERE (user_id, permission_id) IN (";

    foreach ($delete_values as $key => $value) {
        if($value != end($delete_values)){
            $delete_sql .= $value . ", ";
        } else {
            $delete_sql .= $value . ")";
        }
    }


    $insert = $con->query($insert_sql);
    $delete = $con->query($delete_sql);

    header("Location: admin.php");
    
?>
