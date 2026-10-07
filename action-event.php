<?php
session_start();
include_once 'db.php';

$dados = filter_input_array(INPUT_POST);


if (!empty($dados['action']) && $dados['action'] === 'delete') {
    $sql->$db->prepare("DELETE FROM events WHERE id = :id ");
    $sql->bindValue(":id", $dados['id']);

    if (!$sql->execute()) {
        $_SESSION['msg'] = "<p class='alert-danger'>Erro ao tentar deletar. Tente novamente mais tarde!</p>";
        header('Location: index.php');
        exit;
    }
    $_SESSION['msg'] = "<p class='alert-succes'>Sucesso!. Agendamento excluido</p>";
    header('Location: index.php');
    exit;
}

unset($dados['action']);

if ($dados['start'] >= $dados['end']) {
    $_SESSION['msg'] = "<p class='alert-danger'>Erro! Prencha as datas corretamente.</p>";
    header('Location: index.php');
    exit;
}

$required = ['title', 'start'];
$translate = [
    'title' => 'Titulo',
    'start' => 'Data de início'
];

foreach($dados as $key => $value) {
    if (in_array($key, $required) && empty($value)) {
        $_SESSION['msg'] = "<p class='alert-danger'>Erro!. O campo " . $translate[$key] . " é obrigatório</p>";
        header('Location: index.php');
        exit;
    }
}

















if (!empty($dados['action']) && dados['action'] === 'delete') {
    $sql->$db.prepare("DELETE FROM events WHERE id = :id ");
    $sql->bindValue(":id", $dados['id']);
    if (!$sql->execute()) {
        $_SESSION['msg'] = "<p class='alert-danger'>Erro ao tentar deletar. Tente novamente mais tarde!</p>";
        header('Location: index.php');
    }
}