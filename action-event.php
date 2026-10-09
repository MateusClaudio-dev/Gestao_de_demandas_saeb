<?php
session_start();
include_once 'db.php';

# Filtar os valores do form em um array.
$dados = filter_input_array(INPUT_POST);

# Valida se a operação é de exclusão. E prepara a query para exclusão dos dados.
if (!empty($dados['action']) && $dados['action'] === 'delete') {
    $sql = $db->prepare("DELETE FROM events WHERE id = :id ");
    $sql->bindValue(":id", $dados['id']);

    if (!$sql->execute()) {
        $_SESSION['msg'] = "<p class='alert-danger'>Erro ao tentar deletar. Tente novamente mais tarde!</p>";
        header('Location: index.php');
        exit;
    }
    $_SESSION['msg'] = "<p class='alert-success'>Evento excluido</p>";
    header('Location: index.php');
    exit;
}

# Destroi o valor da sessão.
unset($dados['action']);

# Valida se as datas estão preenchidas corretamente.
if ($dados['start'] >= $dados['end']) {
    $_SESSION['msg'] = "<p class='alert-danger'>Erro! Prencha as datas corretamente.</p>";
    header('Location: index.php');
    exit;
}

# Define quais campos são obrigatórios.
$required = ['title', 'start'];
$translate = [
    'title' => 'Titulo',
    'start' => 'Data de início'
];

# Valida se os valores obrigatórios foram preenchidos.
foreach($dados as $key => $value) {
    if (in_array($key, $required) && empty($value)) {
        $_SESSION['msg'] = "<p class='alert-danger'>O campo " . $translate[$key] . " é obrigatório</p>";
        header('Location: index.php');
        exit;
    }
}

# Seleciona os valores preenchidos pelo utilizador
$dados_tratados = []; 
foreach($dados as $key => $value) {
    if (empty($value)) continue;
    array_push($dados_tratados, $value);
    $field[] = $key . ' = :' . $key;
}

# Concatena as chaves utilizando a virgula (,) como separador
$field = implode(', ', $field);

# Query para fazer envio de dados para o banco de dados
if (!$dados['id']) {
    $sql = $db->prepare("INSERT INTO events SET $field");
    foreach($dados as $key => $value) {
        if (empty($value)) continue;
        $sql->bindValue(":" . $key, $value);
    }

    $sql->execute();
    $_SESSION['msg'] = "<p class='alert-success'>Agendamento salvo!</p>";
    header('Location: index.php');
    exit;

 } else {
    # Query para enviar edição dos dados para o banco de dados
    $sql = $db->prepare("UPDATE events SET $field WHERE id = :id");
    foreach($dados as $key => $value) {
        $sql->bindValue(':' . $key, $value);
    }
    $sql->execute();
    $_SESSION['msg'] = "<p class='alert-success'>Agendamento editado!</p>";
    header('Location: index.php');
    exit;
 }

