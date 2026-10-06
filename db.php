<?php
$host = 'localhost';
$dbname = 'app_calendario';
$user = 'root';
$pass = '';

try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    // echo 'Banco de dados conectado com sucesso';
} catch (PDOException $erro) {
    echo $erro->getMessage();
}