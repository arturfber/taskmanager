<?php 
require_once "../modules/header.php";

?>

<body>
    <section class="vh-100" style="background-color: #508bfc;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-6">
                    <div class="card shadow-2-strong" style="border-radius: 1rem;">

                        <form method="post" action="../login/create.php" id="register" class="card-body p-5 collapse show form">

                            <hr class="my-4">

                            <h3 class="mb-5 text-center">Criar uma conta</h3>

                            <div class="form-outline mb-2">
                                <label class="mb-1" for="user_register">Usuário</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Artur" required />
                            </div>

                            <div class="form-outline mb-2">
                                <label class="mb-1" for="phone">Telefone</label>
                                <input type="phone" name="phone" id="phone" class="form-control" placeholder="(31) 91234-5678" required />
                            </div>

                            <div class="form-outline mb-2">
                                <label class="mb-1" for="mail">E-mail</label>
                                <input type="mail" name="email" id="mail" class="form-control" placeholder="exemplo@exemplo.com" required/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="mb-1" for="password">Senha</label>
                                <input type="password" name="password" id="password" class="form-control mb-2" placeholder="*********" required />
                                <p class="h6 small"><small class="small">A senha deve conter pelo menos 8 dígitos, sendo um caractere especial, uma letra maiúscula, uma minúscula e um número</small></p>
                            </div>

                            <button class="btn btn-primary btn-md px-4 mt-3 d-block mx-auto" type="submit">Criar</button>

                            <?php
                                if(isset($_SESSION['error'])){
                                    echo "<p class='text-danger text-center d-block mt-4'>$_SESSION[error]</p>";
                                }
                            ?>
    
                            <hr class="my-4">
                            <small class="text-center d-block">Já possui uma conta? <button" class="btn p-0 text-decoration-underline text-primary" data-bs-toggle="collapse" data-bs-target=".form">Entre</button></small>
                        </form>

                        <form method="POST" action="../login/login.php" id="login" class="card-body p-5 collapse form">

                            <hr class="my-4">

                            <h3 class="mb-5 text-center">Entre</h3>

                            <div class="form-outline mb-2">
                                <label class="mb-1" for="user_register">E-mail</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Artur" required value="artur.fb.95@gmail.com"/>
                            </div>

                            <div class="form-outline mb-4">
                                <label class="mb-1" for="user_register">Senha</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="*********" required value="aB@1aaaa"/>
                            </div>

                            <button class="btn btn-primary mx-auto d-block px-4 mt-3" type="submit">Entrar</button>

                            <hr class="my-4">

                            <small class="text-center d-block">Não possui uma conta? <button" class="btn p-0 text-decoration-underline text-primary" data-bs-toggle="collapse" data-bs-target=".form">Crie</button></small>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script src="assets/js/phone-mask.js"></script>
<?php require_once "../modules/footer.php" ?>