$(document).ready(function () {
    // Load fetch connection response
    fetch('conn/session.php')
        .then(response => response.json())
        .then(loginDetails => {
            if (loginDetails.status == 'success') {
                // Store loginDetails to localStorage
                localStorage.setItem('loginDetails', JSON.stringify(loginDetails));
                console.log(loginDetails);
            } else {
                // alert(loginDetails.message)
                console.log(loginDetails);
                // route to index
                window.location.href = 'index';
            }
        });
});