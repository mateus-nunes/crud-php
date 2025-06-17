<?php

require_once __DIR__ . "/Classes/User.php";

//Pegando o ID 
$id = $_GET['id'];

//Exclui o usuário
User::delete($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuário apagado</title>
</head>

<body>
    <h1>Usuário deletado</h1>
    <a href="list.php">Voltar o inicio</a>
</body>

</html>