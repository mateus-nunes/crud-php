<?php
require_once  __DIR__ . "/Classes/User.php"
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <title>Lista de usuários</title>
</head>

<body>

    <?php
    require __DIR__ . "/partials/menu.php";
    ?>

    <main class="container">
        <h1 class="text-center">Lista de usuários</h1>

        <a href="create.php" class="btn btn-primary">Cadastrar</a>

        <table class="table table-striped mt-2">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th> </th>
                    <th> </th>
                </tr>
            </thead>
            <tbody>
                <?php
                //Consulta
                $users = User::getAll();

                foreach ($users as $user) {
                    ?>
                    <tr>
                        <td><?php echo $user->id; ?></td>
                        <td><?php echo $user->name; ?></td>
                        <td><?php echo $user->mail; ?></td>
                        <td><a href="update.php?id=<?php echo $user->id; ?>">Editar</a></td>
                        <td><a href="delete.php?id=<?php echo $user->id; ?>">Apagar</a></td>
                        <td><a href="visualize.php?id=<?php echo $user->id; ?>">Visualizar</a></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>