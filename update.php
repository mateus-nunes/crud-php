<?php

require_once __DIR__ . "/Classes/User.php";

//Pegando o ID 
$id = $_GET['id'];

//Busca os dados do usuário
$user = User::getById($id);

if (!$user) {
    die("Usuário não encontrado!");
}

//Verifica se o form foi enviado
if (isset($_POST) and count($_POST) > 0) {

    //Valida se a foto foi selecionada
    $foto = isset($_FILES['imagem']) ? $_FILES['imagem'] : null;

    $userModel = new User();

    //Atualiza os dados do usuário
    $userModel->atualizar($user->id, $_POST['nome'], $_POST['email'], $_POST['senha'],$foto);

    //Redireciona para a pagina list.php
    header("Location:list.php");
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
        <h1 class="text-center">Atualização de usuário</h1>

        <form action="update.php?id=<?php echo $user->id; ?>" method="POST" enctype="multipart/form-data">

            <div class="row">
                <div class="col-12 col-md-6 mb-2">
                    <label for="nome" class="form-label">Nome: </label>
                    <input type="text" name="nome" value="<?php echo $user->name; ?>" class="form-control"
                        placeholder="Informe o nome">
                </div>
                <div class="col-12 col-md-6 mb-2">
                    <label for="email" class="form-label">Email: </label>
                    <input type="mail" name="email" value="<?php echo $user->mail; ?>" class="form-control"
                        placeholder="Informe o email">
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