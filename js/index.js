// Toggle between login and guest forms
document.getElementById('login-tab').addEventListener('click', () => {
    document.getElementById('login-form').style.display = 'block';
    document.getElementById('guest-view').style.display = 'none';
    document.getElementById('login-tab').classList.add('active');
    document.getElementById('guest-tab').classList.remove('active');

    // hide reset password form
    document.getElementById('reset-password-form').style.display = 'none';
    document.getElementById('verify-reset-form').style.display = 'none';
});

document.getElementById('guest-tab').addEventListener('click', (event) => {
    event.preventDefault(); // Prevent default behavior
    document.getElementById('guest-view').style.display = 'block';
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('guest-tab').classList.add('active');
    document.getElementById('login-tab').classList.remove('active');

    // hide reset password form
    document.getElementById('reset-password-form').style.display = 'none';
    document.getElementById('verify-reset-form').style.display = 'none';
});

// tab.active
document.getElementById('login-tab').classList.add('active');

const findButton = document.getElementById('findButton');

// Modal functionality
$('#guestForm').on('submit', function (event) {
    event.preventDefault();

    const trackingNumber = $('#trackingInput').val();

    // Show loading indicator
    findButton.disabled = true;
    findButton.innerHTML = 'Searching...';

    // Check tracking number in MongoDB
    $.ajax({
        url: 'conn/check_tracking.php',
        type: 'POST',
        data: {
            trackingNumber: trackingNumber
        },
        success: function (response) {
            response = JSON.parse(response);
            // alert(response.tracking_number);
            // alert(data);
            if (response.exists) {
                $('#modalTrackingNumber').text(response.tracking_number);
                $('#modalDocumentTitle').text(response.document_title);
                $('#modalDeadline').text(response.deadline);
                $('#modalPriorityStatus').text(response.priority_status);
                $('#modalStatus').text(response.status);
                $('#modalOriginatingOffice').text(response.document_origin);
                $('#modalDestinationOffice').text(response.document_destination);
                $('#modalRemarks').text(response.remarks);

                // modalRemarks display if not null
                if (response.remarks == null || response.remarks == '') {
                    $('#modalRemarks').parent().addClass('d-none');
                } else {
                    $('#modalRemarks').parent().removeClass('d-none');
                }
                // Hide loading indicator
                findButton.disabled = false;
                findButton.innerHTML = 'Find';

                $('#trackModal').modal('show');
            } else {
                // Hide loading indicator
                findButton.disabled = false;
                findButton.innerHTML = 'Find';

                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Tracking number not found!'
                });
            }
        }
    });
});

// Toggle Reset Password Form
document.getElementById('reset-password-link').addEventListener('click', (event) => {
    event.preventDefault();
    document.getElementById('login-form').style.display = 'none';
    document.getElementById('reset-password-form').style.display = 'block';

    // Add #recovery to the URL
    window.location.hash = 'recovery';
});

// Back to Login Form
document.getElementById('back-to-login').addEventListener('click', (event) => {
    event.preventDefault();
    document.getElementById('reset-password-form').style.display = 'none';
    document.getElementById('login-form').style.display = 'block';

    // Remove #recovery from the URL
    window.location.hash = '';
});

// Check URL hash on page load
document.addEventListener('DOMContentLoaded', () => {
    if (window.location.hash === '#recovery') {
        document.getElementById('login-form').style.display = 'none';
        document.getElementById('reset-password-form').style.display = 'block';
    }
});

// Handle Reset Password Form Submission
$('#resetPasswordForm').on('submit', function (event) {
    event.preventDefault();

    const email = $('#email').val();
    const resetPasswordButton = $('#resetPasswordButton');

    // Show loading indicator
    resetPasswordButton.prop('disabled', true).text('Sending...');

    // Send reset code to email
    $.ajax({
        url: 'conn/send_reset_code.php',
        type: 'POST',
        data: {
            email: email
        },
        success: function (response) {
            response = JSON.parse(response);
            console.log(response);
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Reset code sent to your email!'
                });
                // Toggle Reset Password Verification Form
                document.getElementById('reset-password-form').style.display = 'none';
                document.getElementById('verify-reset-form').style.display = 'block';
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Failed to send reset code.'
                });
            }
            resetPasswordButton.prop('disabled', false).text('Send Reset Code');
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred. Please try again.'
            });
            resetPasswordButton.prop('disabled', false).text('Send Reset Code');
        }
    });
});

// Back to Reset Password Form
document.getElementById('back-to-reset').addEventListener('click', (event) => {
    event.preventDefault();
    document.getElementById('verify-reset-form').style.display = 'none';
    document.getElementById('reset-password-form').style.display = 'block';
});

// Handle Reset Password Verification Form Submission
$('#verifyResetForm').on('submit', function (event) {
    event.preventDefault();

    const resetCode = $('#reset_code').val();
    const newPassword = $('#new_password').val();
    const verifyResetButton = $('#verifyResetButton');

    // Show loading indicator
    verifyResetButton.prop('disabled', true).text('Verifying...');

    // Verify reset code and update password
    $.ajax({
        url: 'conn/verify_reset_code.php',
        type: 'POST',
        data: {
            reset_code: resetCode,
            new_password: newPassword
        },
        success: function (response) {
            response = JSON.parse(response);
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Password reset successfully!'
                }).then(() => {
                    window.location.hash = '';
                    location.reload();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message || 'Failed to reset password.'
                });
            }
            verifyResetButton.prop('disabled', false).text('Reset Password');
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred. Please try again.'
            });
            verifyResetButton.prop('disabled', false).text('Reset Password');
        }
    });
});

// Prevent default behavior for guest tab click
document.getElementById('guest-tab').addEventListener('click', function (event) {
    event.preventDefault();
});

document.addEventListener('DOMContentLoaded', function () {
    const yearElement = document.getElementById('year');
    if (yearElement) {
        yearElement.textContent = new Date().getFullYear();
    }
});