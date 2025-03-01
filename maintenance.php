<!-- Session -->
<?php
    include 'conn/session.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maintenance</title>
    <!-- icon -->
    <link rel="icon" href="media/DepED logo.png">
    <!-- maintenance css -->
    <link rel="stylesheet" href="css/maintenance.css">
    <!-- default.css -->
    <link rel="stylesheet" href="css/default.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div id="default-container"></div>
    <!-- modals -->
    <div id="modal-container"></div>
    <div class="content">
        <!-- title admin details, display username, fullname, office and position -->
        <div class="admin-details">
            <h3>Admin Details</h3>
            <div class="admin-details-container">
                <!-- icon/profile -->
                <div class="admin-details-profile">
                    <img src="media/user.png" alt="profile">
                </div>
                <div class="admin-details-content">
                    <div class="admin-details-content-left">
                        <label for="username">Username:</label>
                        <label for="fullname">Fullname:</label>
                        <label for="office">Office:</label>
                        <label for="position">Position:</label>
                    </div>
                    <div class="admin-details-content-right">
                        <label id="username"><?php echo $_SESSION['username']; ?></label>
                        <label id="fullname"><?php echo $_SESSION['fullname']; ?></label>
                        <label id="office"><?php echo $_SESSION['office']; ?></label>
                        <label id="position"><?php echo $_SESSION['position']; ?></label>
                    </div>
                </div>
                <!-- button update -->
                <div class="admin-details-button">
                    <button class="btn btn-primary" id="update">Update</button>
                </div>
            </div>
        </div>
    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/default.js"></script>
</body>

</html>