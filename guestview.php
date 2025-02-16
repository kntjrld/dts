<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DepED Document Tracking System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">

        <!-- Tracking Form -->
         <div id="logo">
            <img src="IMG/DepED logo.png" class="logo">
         </div>
        <div id="login-form" class="form">
            <h2>Track Document</h2>
            <form>
                <input type="trackingnum" placeholder="Type the document track number here" required>
                <button type="submit">Find</button>
            </form>
            <a href="index.php" class="forgot-password">Login or Sign Up</a>
        </div>
            </div>


    <footer>
        <p>&copy; <span id="year"></span> DepED Document Tracking System. All rights reserved. </p>
    </footer>
    <script>
        //footer
            document.getElementById('year').textContent =new Date().getFullYear();
    </script>
</body>
</html>
