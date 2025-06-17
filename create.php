<?php

require_once __DIR__ . "/Classes/User.php";

if (isset($_POST) and count($_POST) > 0) {

    $userModel = new User();

    $foto = isset($_FILES['imagem']) ? $_FILES['imagem'] : null;

    $userId = $userModel->inserir($_POST['nome'], $_POST['email'], $_POST['senha'], $foto);

    //Redireciona para a pagina list.php
    header("Location:visualize.php?id=".$userId);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <title>Cadastro de usuários</title>
</head>

<body>

    <?php
    require __DIR__ . "/partials/menu.php";
    ?>

    <main class="container">
        <h1 class="text-center">Cadastro de usuário</h1>

        <form action="create.php" method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-12 col-md-6 mb-2">
                    <label for="nome" class="form-label">Nome: </label>
                    <input type="text" name="nome" class="form-control" placeholder="Informe o nome">
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <label for="email" class="form-label">Email: </label>
                    <input type="mail" name="email" class="form-control" placeholder="Informe o email">
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <label for="senha" class="form-label">Senha: </label>
                    <input type="password" name="senha" class="form-control" placeholder="Informe a senha">
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <label for="imagem" class="form-label">Imagem de perfil</label>
                    <input class="form-control" type="file" name="imagem" id="imagem">
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary w-50">Salvar</button>
                </div>
            </div>

        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>