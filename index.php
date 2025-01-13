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
        <div class="form-header">
            <div class="tab" id="login-tab">Login</div>
            <div class="tab" id="signup-tab">Sign Up</div>
        </div>

        <!-- Login Form -->
         <div id="logo">
            <img src="IMG/DepED logo.png" class="logo">
         </div>
        <div id="login-form" class="form">
            <h2>Login</h2>
            <form>
                <input type="username" placeholder="Username" required>
                <input type="password" placeholder="Password" required>
                <button type="submit">Log In</button>
            </form>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </div>

        <!-- Sign Up Form -->
        <div id="signup-form" class="form" style="display:none;">
            <h2>Sign Up</h2>
            <form>
                <input type="text" placeholder="Full Name ex. Archelly L. Bautista" required>
                <input type="email" placeholder="Email" required>
                <input type="password" placeholder="Password" required>
                <input type="password" placeholder="Confirm Password" required>
                <select name="usertype" placeholder="Choose User Type" required>
                    <option value="officedesignation">Choose User Type</option>
                    <option value="user1">User 1</option>
                    <option value="user2">User 2</option>
                </select>
                <select name="office" placeholder="Choose your Designated Office" required>
                <option value="officedesignation">Select Office Designation</option>
                <option value="ict">ICT Section</option>
                <option value="records">Records Section</option>
                <option value="osds">OSDS Section</option>
                <option value="asds">ASDS Section</option>
                <option value="legalunit">Legal Unit</option>
                <option value="sgod">SGOD Section</option>
                <option value="supply">Supply Section</option>
                <option value="personnel">Personnel Section</option>                
                <option value="accounting">Accounting Section</option>
                <option value="budget">Budget Section</option>
                <option value="cashier">Cashier Section</option>
                </select>
                <button type="submit">Sign Up</button>
            </form>
          
            </div>
        <!-- Guest Viewing Option -->
       
        <div class="guest-viewing">
        <p class="or">or</p>
            <p><a href="/guest-view">Continue as Guest</a></p>
        </div>
    </div>
    </div>

    <script>
        // Toggle between login and sign-up forms
        document.getElementById('login-tab').addEventListener('click', () => {
            document.getElementById('login-form').style.display = 'block';
            document.getElementById('signup-form').style.display = 'none';
            document.getElementById('login-tab').classList.add('active');
            document.getElementById('signup-tab').classList.remove('active');
        });

        document.getElementById('signup-tab').addEventListener('click', () => {
            document.getElementById('signup-form').style.display = 'block';
            document.getElementById('login-form').style.display = 'none';
            document.getElementById('signup-tab').classList.add('active');
            document.getElementById('login-tab').classList.remove('active');
        });
    </script>

    <footer>
        <p>&copy; <span id="year"></span> DepED Document Tracking System. All rights reserved. </p>
    </footer>
    <script>
        //footer
            document.getElementById('year').textContent =new Date().getFullYear();
    </script>
</body>
</html>
