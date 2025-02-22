<?php
    include 'connection.php';
    session_start();
    ob_end_clean();
    // Check if the form is submitted
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Assign the form data to variables
        $username = $_POST['username'];
        $password = $_POST['password'];
        // Query the database for the user
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);
        // If the user exists, redirect to the dashboard
        if (mysqli_num_rows($result) > 0) {
            $_SESSION['username'] = $username;
            echo json_encode(array('status' => 'success', 'message' => 'Login successful'));
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Invalid username or password'));
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Username and password are required'));
    }
?>