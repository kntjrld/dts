<?php
require 'connection.php';
session_start();
ob_end_clean();

$database = $client->selectDatabase('dts_db');
$collection = $database->selectCollection('documents');

if (isset($_POST['history'])) {
    // Query to get distinct month-year values in MMM-YYYY format
    $pipeline = [
        [
            '$project' => [
                'monthYear' => [
                    '$dateToString' => ['format' => '%b-%Y', 'date' => ['$toDate' => '$created_date']]
                ]
            ]
        ],
        [
            '$group' => [
                '_id' => '$monthYear'
            ]
        ],
        [
            '$sort' => ['_id' => -1]
        ]
    ];

    $cursor = $collection->aggregate($pipeline);

    $monthYears = [];
    foreach ($cursor as $document) {
        $monthYears[] = $document['_id'];
    }

    // Output the distinct month-year values
    header('Content-Type: application/json');
    echo json_encode($monthYears);
}

// Get count of documents by type (incoming, outgoing, terminal) for a specific month-year
if (isset($_POST['getCount'])) {
    $monthYear = $_POST['monthYear'];

    // Convert month-year to date range
    $startDate = new MongoDB\BSON\UTCDateTime(strtotime("first day of $monthYear 00:00:00") * 1000);
    $endDate = new MongoDB\BSON\UTCDateTime(strtotime("last day of $monthYear 23:59:59") * 1000);

    // Query to count documents by type using flags and converting created_date to a valid date
    $pipeline = [
        [
            '$addFields' => [
                'created_date_parsed' => [
                    '$dateFromString' => [
                        'dateString' => '$created_date',
                        'format' => '%Y-%m-%d %H:%M:%S'
                    ]
                ]
            ]
        ],
        [
            '$match' => [
                'created_date_parsed' => [
                    '$gte' => $startDate,
                    '$lte' => $endDate
                ]
            ]
        ],
        [
            '$group' => [
                '_id' => null,
                'incomingCount' => ['$sum' => ['$toInt' => '$incoming_flag']],
                'outgoingCount' => ['$sum' => ['$toInt' => '$outgoing_flag']],
                'terminalDocsCount' => ['$sum' => ['$toInt' => '$terminal_flag']]
            ]
        ]
    ];

    $cursor = $collection->aggregate($pipeline);

    $counts = [
        'incomingCount' => 0,
        'outgoingCount' => 0,
        'terminalDocsCount' => 0
    ];

    foreach ($cursor as $document) {
        $counts['incomingCount'] = $document['incomingCount'] ?? 0;
        $counts['outgoingCount'] = $document['outgoingCount'] ?? 0;
        $counts['terminalDocsCount'] = $document['terminalDocsCount'] ?? 0;
    }

    // Output the counts
    header('Content-Type: application/json');
    echo json_encode($counts);
}

// get all documents count by type (incoming, outgoing, terminal)
if (isset($_POST['getAllCount'])) {
    // Query to count documents by type using flags
    $pipeline = [
        [
            '$group' => [
                '_id' => null,
                'incomingCount' => ['$sum' => ['$toInt' => '$incoming_flag']],
                'outgoingCount' => ['$sum' => ['$toInt' => '$outgoing_flag']],
                'terminalDocsCount' => ['$sum' => ['$toInt' => '$terminal_flag']]
            ]
        ]
    ];

    $cursor = $collection->aggregate($pipeline);

    $counts = [
        'incomingCount' => 0,
        'outgoingCount' => 0,
        'terminalDocsCount' => 0
    ];

    foreach ($cursor as $document) {
        $counts['incomingCount'] = $document['incomingCount'] ?? 0;
        $counts['outgoingCount'] = $document['outgoingCount'] ?? 0;
        $counts['terminalDocsCount'] = $document['terminalDocsCount'] ?? 0;
    }

    // Output the counts
    header('Content-Type: application/json');
    echo json_encode($counts);
}

?>