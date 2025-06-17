<?php

require_once("bd.php");

if (isset($_POST['email'])) {

    $sql = $conn->prepare("SELECT * FROM users WHERE mail = :mail");
    $sql->bindValue(":mail", $_POST['email']);
    $sql->execute();

    $user = $sql->fetch(PDO::FETCH_OBJ);

    if ($user) {

        if($user->senha_provisoria == $_POST['codigo']){

            $exp = new DateTime($user->senha_provisoria_validade,new DateTimeZone('America/Sao_Paulo'));
            $now = new DateTime("now",new DateTimeZone('America/Sao_Paulo'));

            if($now > $exp){
                die("Código expirado");
            }else{
                echo "FORM DE RESET DE SENHA";
            }

        }else{
            die("Código inválidas");
        }
        

    } else {
        die("Código inválidas");
    }

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Recupera senha</h1>

    <form action="" method="post">
        <input type="text" name="email" required>
        <br>
        <input type="text" name="codigo" required>
        <br>
        <input type="submit" value="Acessar">
    </form>
</body>
</html>