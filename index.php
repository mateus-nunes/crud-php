<?php
session_start();

if (isset($_SESSION['logado']) and $_SESSION['logado']) {
    header("Location: area_restrita.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <title>Login</title>
</head>

<body class="bg-dark-subtle">

    <div class="bg-body-tertiary container mt-5 p-4" style="max-width: 400px">
        <h1 class="text-center">Login</h1>

        <form action="login.php" method="post">
            <div class="form-floating">
                <input type="email" class="form-control" name="email" id="email" required placeholder="nome@ifto.edu.br">
                <label for="email">Email</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="pass" id="pass" required placeholder="******">
                <label for="pass">Senha</label>
            </div>
            <button type="submit" class="btn btn-primary w-100 py-2 mt-2">Acessar</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>