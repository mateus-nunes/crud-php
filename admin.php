<?php

require_once "verifica_login.php";

if($_SESSION['role']!= "admin"){
    die("Acesso negado! Área restrita a administradores!");
}

echo "Área administrativa, admin: ". $user_logado->name;