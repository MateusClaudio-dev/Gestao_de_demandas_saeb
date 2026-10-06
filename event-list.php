<?php
session_start();
include_once "db.php";

// $sql = $db->query("SELECT id, title, color, 'start', 'end' FROM  events");
$sql = $db->query("SELECT * FROM events");
$events = $sql->fetchall();

$array_event = [];
foreach($events as $event) {
    extract($event);

    $array_event[] = [  
        'id' => $id,
        'title' => $title,
        'color' => $color,
        'start' => $start,
        'end' => $end,
    ];
}
echo json_encode($array_event);
