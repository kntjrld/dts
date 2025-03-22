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
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];

    // Validate the data (you can add more validation as needed)
    if (empty($username) || empty($fullname) || empty($email) || empty($office) || empty($position) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'All fields are required.']);
        exit;
    }

    // Prepare the MongoDB document
    $database = $client->selectDatabase('dts_db');
    $collection = $database->selectCollection('users');
    $new_user = [
        'username' => $username,
        'fullname' => $fullname,
        'email_address' => $email,
        'office' => $office,
        'position' => $position,
        'user_type' => $user_type,
        'password' => $password
    ];

    // Insert the document into the collection
    try {
        $result = $collection->insertOne($new_user);
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