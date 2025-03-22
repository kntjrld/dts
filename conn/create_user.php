<?php
require 'connection.php';
session_start();
ob_end_clean();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $office = $_POST['office'];
    $position = $_POST['position'];

    // Validate the data (you can add more validation as needed)
    if (empty($username) || empty($fullname) || empty($email) || empty($office) || empty($position)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Prepare the MongoDB document
    $database = $client->selectDatabase('dts_db');
    $collection = $database->selectCollection('users');
    $document = [
        'username' => $username,
        'fullname' => $fullname,
        'email' => $email,
        'office' => $office,
        'position' => $position
        // 'created_at' => new MongoDB\BSON\UTCDateTime()
    ];

    // Insert the document into the collection
    try {
        $result = $collection->insertOne($document);
        if ($result->getInsertedCount() === 1) {
            echo json_encode(['status' => 'success', 'message' => 'User created successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to create user.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}
?>