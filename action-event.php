<?php
session_start();
include_once 'db.php';

# Filtar os valores do form em um array.
$dados = filter_input_array(INPUT_POST);

# Valida se a operação é de exclusão. E prepara a query para exclusão dos dados.
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

# Destroi o valor da sessão.
unset($dados['action']);

# Valida se as datas estão preenchidas corretamente.
if ($dados['start'] <= $dados['end']) {
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

# Remove o campo id que guarda um espaço vazio
// if ($dados['id'] === "") unset($dados['id']);

# Valida se os valores obrigatórios foram preenchidos.
foreach($dados as $key => $value) {
    if (in_array($key, $required) && empty($value)) {
        $_SESSION['msg'] = "<p class='alert-danger'>O campo " . $translate[$key] . " é obrigatório</p>";
        header('Location: index.php');
        exit;
    }

    # Pega todas as chaves do array '$dados' preenchidas
    // if ($key === 'id' && empty($value)) {
    //     continue; 
    // }
    $set[] = $key . ' = :' . $key;
}

// $dados_tratados = [];
// foreach($dados as $key) {
//     if ($key === "") continue;
//     array_push($dados_tratados, $key);
//     $atributte[] = $key . ' = :' . $key;
// }

# Concatena as chaves utilizando a virgula (,) como separador
$set = implode(', ', $set);
// $atributte = implode(', ', $atributte);

# Query para fazer envio de dados para o banco de dados
if (!$dados['id']) {
    $sql = $db->prepare("INSERT INTO events SET $set");
    foreach($dados as $key => $value) {
        $sql->bindValue(":" . $key, $value);
    }

    $sql->execute();
    $_SESSION['msg'] = "<p class='alert-success'>Agendamento salvo!.</p>";
    header('Location: index.php');
    exit;

 } else {
    # Query para enviar edição dos dados para o banco de dados
    $sql->$db->prepare("UPDATE events SET $set WHERE = :id");
    foreach($dados as $key => $value) {
        $sql->bindValue(':' . $key, $value);
    }
    $sql->execute();
    $_SESSION['msg'] = "<p class='alert-success'>Agendamento editado!.</p>";
    header('Location: index.php');
    exit;
 }

