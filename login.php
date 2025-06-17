<?php

require_once("bd.php");

session_start();

if (isset($_POST['email'])) {

    $sql = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
    $sql->bindValue(":mail", $_POST['email']);
    $sql->execute();

    $user = $sql->fetch(PDO::FETCH_OBJ);

    if ($user) {

        if (password_verify($_POST['pass'], $user->password)) {
            $_SESSION["logado"] = true;
            $_SESSION['user_id'] = $user->id;
            $_SESSION['role'] = $user->role;

            header("Location: list.php");
        } else {
            die("Credenciais inválidas");
        }

    } else {
        die("Credenciais inválidas");
    }

}

