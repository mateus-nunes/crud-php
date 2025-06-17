<?php

require_once __DIR__ . "/Classes/User.php";

//Pegando o ID 
$id = $_GET['id'];

//Busca os dados do usuário
$user = User::getById($id);

if (!$user) {
    die("Usuário não encontrado!");
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
        <h1 class="text-center">Visualização de usuário</h1>
        <h3 class="text-center"><?php echo $user->name; ?></h3>
        <img src="<?php echo User::getPathPhoto($user->image); ?>" style="max-width: 300px;" class="rounded mx-auto d-block" alt="Foto do usuário: <?php echo $user->name;?>" />
        <h4 class="text-center">Email: <?php echo $user->mail; ?></h4>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>