<?php
require_once "../modules/header.php";
require_once "../tasks/list.php";
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
                    <table class="table text-white">
                        <thead class="h3">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
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
                            $sql = "SELECT id FROM accounts";
                            $result = $con->query($sql);

                            // Getting users IDs
                            $ids = [];
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $ids[] = $row;
                                }
                            }

                            foreach ($ids as $key => $id) {

                                $sql = "SELECT user_id, name, permission FROM `account_permissions` INNER JOIN permissions on permissions.id = account_permissions.permission_id INNER JOIN accounts on accounts.id - account_permissions.user_id WHERE user_id = $id[id]";

                                $result = $con->query($sql);
                                $accounts = [];
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $accounts[] = $row;
                                    }
                                }


                                foreach ($accounts as $key => $account) {

                                    echo " 
                                        <tr>
                                            <form>
                                                <th id='id'>$account[user_id]</th>
                                                <td><p id='name'>$account[name]</p></td>
                                                <td>
                                                    <div class='form-check'>
                                                        <input class='form-check-input' type='checkbox' value='true' name='view'>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class='form-check'>
                                                        <input class='form-check-input' type='checkbox' value='true' name='edit'>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class='form-check'>
                                                        <input class='form-check-input' type='checkbox' value='true' name='insert'>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class='form-check'>
                                                        <input class='form-check-input' type='checkbox' value='true' name='delete'>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class='form-check'>
                                                        <input class='form-check-input' type='checkbox' value='true' name='print'>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type='submit' class='btn btn-success'>Salvar</button>
                                                </td>
                                            </form> 
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