<?php
require 'connection.php';
session_start();
ob_end_clean();

$database = $client->selectDatabase('dts_db');
$collection = $database->selectCollection('documents');

// Tracking page
if (isset($_POST['track'])){
    $filter = [];
    $filter['terminal_flag'] = 0;
    $filter['outgoing_flag'] = 0;
    $filter['incoming_flag'] = 0;
    $cursor = $collection->find($filter);
    $data = iterator_to_array($cursor);

    echo json_encode($data);
}

//Incoming page
if (isset($_POST['incoming'])){
    $filter = [];
    $filter['terminal_flag'] = 0;
    $filter['outgoing_flag'] = 0;
    $filter['incoming_flag'] = 1;
    $cursor = $collection->find($filter);
    $data = iterator_to_array($cursor);

    echo json_encode($data);
}

//outgoing page
if (isset($_POST['outgoing'])){
    $filter = [];
    $filter['terminal_flag'] = 0;
    $filter['outgoing_flag'] = 1;
    $filter['incoming_flag'] = 0;
    $cursor = $collection->find($filter);
    $data = iterator_to_array($cursor);

    echo json_encode($data);
}

//terminal page
if (isset($_POST['terminal'])){
    $filter = [];
    $filter['terminal_flag'] = 1;
    $filter['outgoing_flag'] = 0;
    $filter['incoming_flag'] = 0;
    $cursor = $collection->find($filter);
    $data = iterator_to_array($cursor);

    echo json_encode($data);
}

?>