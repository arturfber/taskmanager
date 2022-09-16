<?php
require_once "../modules/header.php";
require_once "../tasks/list.php";


$edit = $_SESSION['permissions']['edit'] == "true" ? "<button type='button' class='btn btn-secondary ms-2 edit' data-bs-toggle='modal' data-bs-target='#edit_task_modal'><i class='bi bi-pencil-square fs-4'></i></button>" : '';

$insert = $_SESSION['permissions']['insert'] == "true" ? "<button type='button' class='btn btn-success ms-auto d-block' data-bs-toggle='modal' data-bs-target='#add_task_modal'><i class='bi bi-plus-circle me-2'></i>Adicionar Tarefa</button>" : '';

$delete = $_SESSION['permissions']['delete'] == "true" ? "<form method='post' action='../tasks/delete.php' delete'><input type='hidden' name='id'><button type='button' class='btn btn-danger m-auto d-block inline-delete'><i class='bi bi-trash'></i></button></form>" : '';

?>


<body>

    <main class="overflow-hidden">

        <h3 class="position-absolute mt-4 me-4 top-0 end-0">
            <span class="badge bg-success">Olá, <?php echo $_SESSION['name'] ?></span>
        </h3>

        <h4 class="position-absolute mt-4 me-4 bottom-0 start-0 ms-4 mb-4">
            <a class="badge bg-danger text-decoration-none py-2 px-3 color-black" href="../login/logout.php">
                <i class="bi bi-box-arrow-left me-2"></i>    
                Sair
            </a>
        </h4>

        <!-- Content -->
        <section class="row">
            <section class="col-12 d-flex flex-column justify-content-evenly vh-100 m-0 px-5 py-4 bg-light">

                <h1 class="text-black border-bottom border-5 border-black display-3 text-uppercase mb-3">Tarefas</h1>

                <div class="content overflow-auto border-bottom border-2 border-black">
                    <table class="table text-black main-table table-striped">
                        <thead class="h3">
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Criação</th>
                                <th scope="col">Conclusão</th>
                                <th scope="col">Status</th>
                                <th scope="col" class="edit">Editar</th>
                                <th scope="col" class="delete">Excluir</th>
                            </tr>
                        </thead>
                        <tbody class="h4">

                            <?php
                            foreach ($tasks as $key => $task) {

                                $creation_date = date("d/m/Y", strtotime($task['creation_date']));
                                $conclusion_date = $task['conclusion_date'] ? date("d/m/Y", strtotime($task['conclusion_date'])) : '-';

                                $badge = $task['status'] == 'Concluido' ? "success" : "danger";

                                if($_SESSION['permissions']['view'] == "true"){
                                    echo " 
                                        <tr>
                                            <td id='id'>$task[id]</td>
                                            <td><p id='name' class='m-0'>$task[name]</p></td>
                                            <td>
                                                <p id='description' class='m-0'>$task[description]</p>
                                            </td>
                                            <td>$creation_date</td>
                                            <td class='text-center'>$conclusion_date</td>
                                            <td><p id='status' class='m-0 badge bg-$badge'>$task[status]</p></td>
                                            <td>$edit</td>
                                            <td>$delete</td>
                                        </tr>";
                                }
                            }
                            ?>

                        </tbody>
                    </table>
                </div>

                <div class='mt-3 d-flex'>

                    <?php
                    if($_SESSION['permissions']['print'] == "true"){
                        echo "
                        <a href='../util/export_xls.php' class='btn btn-success ms-auto d-block'>
                            <i class='bi bi-file-earmark-spreadsheet me-1'></i>
                            Exportar em .XLS
                        </a>

                        <button class='btn btn-danger ms-auto d-block pdf'>
                            <i class='bi bi-file-earmark-pdf me-1'></i>
                            Exportar em .PDF
                        </button>";
                        }
                    ?>
                    
                
                    <?php echo $insert ?>
                </div>
                
            </section>
        </section>

        
        <!-- Add Task Modal -->
        <div class="modal fade" id="add_task_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="add_task_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Adicionar Tarefa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../tasks/create.php">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="name" name="name" class="form-control" id="name">
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <textarea class="form-control" id="description" rows="3" name="description"></textarea>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="account_id" value="<?php echo $_SESSION['id'] ?>">

                                <button type="reset" class="btn btn-secondary">Limpar</button>
                                <button type="submit" class="btn btn-success">Salvar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Task Modal -->
        <div class="modal fade" id="edit_task_modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="edit_task_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Editar Tarefa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="../tasks/edit.php" class="edit">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nome</label>
                                <input type="name" name="name" class="form-control" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição</label>
                                <textarea class="form-control" id="description" rows="3" name="description" required></textarea>
                            </div>

                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>

                                <select class="form-select" name="status" aria-label="Alterar status da tarefa" required>
                                    <option value="Concluido" selected>Concluído</option>
                                    <option value="Pendente">Pendente</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" name="id">

                                <button type="reset" class="btn btn-secondary">Limpar</button>
                                <button type="submit" class="btn btn-success">Salvar</button>
                        
                            </div>
                        </form>
                        <form method="post" action="../tasks/delete.php" class="position-absolute bottom-0 mb-4 pb-1 delete">
                            <input type="hidden" name="id" value="5">
                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php require_once "../modules/footer.php" ?>
</body>


</html>