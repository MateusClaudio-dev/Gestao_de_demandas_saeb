<?php
$host = 'localhost';
$dbname = 'app_calendario';
$user = 'root';
$pass = '';

# Conecta banco de dados
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
} catch (PDOException $erro) {
    echo $erro->getMessage();
}