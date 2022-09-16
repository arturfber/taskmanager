<?php
require_once "../modules/header.php";
require_once "../tasks/list.php";
require_once "../util/functions.php";
?>


<body>

    <main class="overflow-hidden">

        <h3 class="position-absolute mt-4 me-4 top-0 end-0">
            <span class="badge bg-success">Olá, <?php echo $_SESSION['name'] ?></span>
        </h3>

        <h4 class="position-absolute mt-4 me-4 bottom-0 start-0 ms-4 mb-4">
            <a class="badge bg-danger" href="../login/logout.php">Sair</a>
        </h4>


        <!-- Content -->
        <section>
            <section class="d-flex flex-column justify-content-evenly vh-100 m-0 px-5 py-4 bg-info">

                <h1 class="text-white border-bottom border-5 border-white display-3 text-uppercase mb-3">Admin</h1>

                <div class="content overflow-auto border-bottom border-2 border-white">
                    <table class="table text-white admin">
                        <thead class="h3">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Admin</th>
                                <th scope="col">Visualizar</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Cadastrar</th>
                                <th scope="col">Excluir</th>
                                <th scope="col">Imprimir</th>
                                <th scope="col">Ação</th>
                            </tr>
                        </thead>
                        <tbody class="h4">

                            <?php

                            // Getting account IDs
                            $sql = "SELECT id FROM accounts";
                            $result = $con->query($sql);

                            $ids = [];
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $ids[] = $row;
                                }
                            }

                            foreach ($ids as $key => $id) {

                                $sql = "SELECT user_id, accounts.name, permissions.permission FROM accounts
                                INNER JOIN account_permissions on account_permissions.user_id = accounts.id
                                INNER JOIN permissions on account_permissions.permission_id = permissions.id
                                WHERE accounts.id = $id[id]";

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
                                        $permissions[$value['permission']] = "checked";
                                    }

                                    // Selecting the first permission, just for printing the <tr>'s
                                    $id = $account[0]['user_id'];
                                    $name = $account[0]['name'];
                                    $set_permissions = json_encode($permissions);

                                    echo " 
                                        <tr>
                                            <td id='id'>$id</td>
                                            <td><p id='name'>$name</p></td>
                                            <td>
                                                <input class='form-check-input' type='checkbox' name='admin' $permissions[admin]>
                                            </td>
                                            <td>
                                                <input class='form-check-input' type='checkbox' name='view' $permissions[view]>
                                            </td>
                                            <td>
                                                <input class='form-check-input' type='checkbox' name='edit' $permissions[edit]>
                                            </td>
                                            <td>
                                                <input class='form-check-input' type='checkbox' name='insert' $permissions[insert]>
                                            </td>
                                            <td>
                                                <input class='form-check-input' type='checkbox' name='delete' $permissions[delete]>
                                            </td>
                                            <td>
                                                <input class='form-check-input' type='checkbox' name='print' $permissions[print]>
                                            </td>
                                            <th>
                                                <form method='post' action='permissions.php'>
                                                    <button type='button' class='btn btn-success'>Salvar</button>

                                                    <input type='hidden' name='permissions' value='$set_permissions'>
                                                    <input type='hidden' name='account_id' value='$id'>
                                                    <input type='hidden' name='admin'>
                                                    <input type='hidden' name='view'>
                                                    <input type='hidden' name='edit'>
                                                    <input type='hidden' name='insert'>
                                                    <input type='hidden' name='delete'>
                                                    <input type='hidden' name='print'>
                                                </form>
                                            </th>
                                        </tr>";
                                }                                
                            }

                            ?>

                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    </main>

    <?php require_once "../modules/footer.php" ?>
</body>


</html>