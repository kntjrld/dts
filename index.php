<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DepED Document Tracking System</title>
    <!-- icon -->
    <link rel="icon" href="media/DepED logo.png">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- default.css -->
    <!-- <link rel="stylesheet" href="css/default.css"> -->
    <!-- index.css -->
    <link rel="stylesheet" href="css/index.css">
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- swalfire -->
    <link rel="stylesheet" href="css/swalfire.css">
    <!-- default css -->
    <link rel="stylesheet" href="css/default.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div class="form-container">
        <div class="form-header">
            <div class="tab" id="login-tab">Login</div>
            <div class="tab" id="guest-tab">Guest</div>
        </div>

        <!-- Login Form -->
        <div id="logo">
            <img src="media/DepED.png" class="logo">
        </div>
        <!-- Login Form -->
        <div id="login-form" class="form">
            <h2>Login</h2>
            <form id="loginForm" name="loginForm" method="POST">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                    </div>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                        required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                        required>
                </div>
                <button type="submit" class="login btn btn-primary" id="login">Log In</button>
                <a href="#recovery" id="reset-password-link" class="forgot-password">Forgot Password?</a>
            </form>
        </div>

        <!-- Reset Password Form -->
        <div id="reset-password-form" class="form" style="display:none;">
            <h2>Reset Password</h2>
            <form id="resetPasswordForm" name="resetPasswordForm" method="POST">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </div>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                </div>
                <button type="submit" class="btn btn-primary" id="resetPasswordButton">Send Reset Code</button>
                <!-- back -->
                <a href="#" id="back-to-login" class="forgot-password">Back to Login</a>
            </form>
        </div>

        <!-- Reset Password Verification Form -->
        <div id="verify-reset-form" class="form" style="display:none;">
            <h2>Verify Reset Code</h2>
            <form id="verifyResetForm" name="verifyResetForm" method="POST">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                    </div>
                    <input type="text" name="reset_code" id="reset_code" class="form-control" placeholder="Enter Reset Code" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" name="new_password" id="new_password" class="form-control" placeholder="Enter New Password" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </div>
                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm New Password" required>
                </div>
                <button type="submit" class="btn btn-primary" id="verifyResetButton">Reset Password</button>
                <a href="#" id="back-to-reset" class="forgot-password">Back</a>
            </form>
        </div>

        <!-- Guest View -->
        <div id="guest-view" class="form" style="display:none;">
            <h2>Track Document</h2>
            <form id="guestForm">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                    </div>
                    <input type="text" id="trackingInput" class="form-control" placeholder="Tracking Number" required>
                </div>
                <button type="submit" id="findButton" class="btn btn-primary">Find</button>
            </form>
        </div>
    </div>

    <!-- Track Modal -->
    <div class="modal fade" id="trackModal" tabindex="-1" role="dialog" aria-labelledby="trackModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="trackModalLabel">Track Document Details</h5>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row mb-3">
                            <div class="col-md-6 font-weight-bold">Tracking Number:</div>
                            <div class="col-md-6" id="modalTrackingNumber"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 font-weight-bold">Document Title:</div>
                            <div class="col-md-6" id="modalDocumentTitle"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 font-weight-bold">Deadline:</div>
                            <div class="col-md-6" id="modalDeadline"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 font-weight-bold">Priority Status:</div>
                            <div class="col-md-6" id="modalPriorityStatus"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 font-weight-bold">Status:</div>
                            <div class="col-md-6" id="modalStatus"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 font-weight-bold">Originating Office:</div>
                            <div class="col-md-6" id="modalOriginatingOffice"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 font-weight-bold">Destination Office:</div>
                            <div class="col-md-6" id="modalDestinationOffice"></div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6 font-weight-bold">Remarks:</div>
                            <div class="col-md-6" id="modalRemarks"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="js/login.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <!-- connection js -->
    <script src="js/connection.js"></script>
    <!-- index js -->
    <script src="js/index.js"></script>
    <footer>
        <p>&copy; <span id="year"></span> DepED Document Tracking System. All rights reserved. </p>
    </footer>
</body>

</html>