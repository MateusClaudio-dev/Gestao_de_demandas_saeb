<?php
session_start();
include_once "db.php";

// $sql = $db->query("SELECT id, title,  'start', 'end' FROM  events");
$sql = $db->query("SELECT * FROM events");

# Retorna uma coleção de array
$events = $sql->fetchall();

$array_event = [];

# Percorre o retorno da query (coleção de array)
foreach($events as $event) {
    # Transforma as key do array em variavies.
    extract($event); 

    # Armazena dentro do array vazio a coleção extraida (extract) do array percorrido 
    $array_event[] = [  
        'id' => $id,
        'title' => $title,
        'description' => $description,
        'start' => $start,
        'end' => $end,
    ];
}

# Transforma em json
echo json_encode($array_event);
