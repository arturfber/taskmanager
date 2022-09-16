<?php

function get_account_permissions($id){

        require_once('../connection.php');

        $sql = "SELECT user_id, accounts.name, permissions.permission FROM accounts
        INNER JOIN account_permissions on account_permissions.user_id = accounts.id
        INNER JOIN permissions on account_permissions.permission_id = permissions.id
        WHERE accounts.id = $id";

        // Ordening account/permission in a object
        $result = $con->query($sql);
        $accounts = [];
        if ($result->num_rows > 0) {
            $key = 0;
            while ($row = $result->fetch_assoc()) {
                $accounts[$row['name']][$key] = $row;
                $key++;
            }
        }

        foreach ($accounts as $key => $account) {

            // Getting all account permissions
            $permissions = [
                "admin" => "",
                "view" => "",
                "edit" => "",
                "insert" => "",
                "delete" => "",
                "print" => "",
            ];
            foreach ($account as $value) {
                $permissions[$value['permission']] = "true";
            }
        }

        return $permissions;
    }
