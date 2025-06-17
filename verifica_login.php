<?php

require_once("bd.php");

session_start();

if (!isset($_SESSION['logado']) and !$_SESSION['logado']) {
    header("Location: index.php");
} 

$sql = $conn->prepare("SELECT * FROM users WHERE id = :id");
$sql->bindValue(":id", $_SESSION['user_id']);
$sql->execute();

$user_logado = $sql->fetch(PDO::FETCH_OBJ);
