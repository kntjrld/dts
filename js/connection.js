document.addEventListener("DOMContentLoaded", function () {
    const preloader = document.getElementById("preloader");

    // Show the preloader
    if (preloader) {
        preloader.style.display = "flex";
    }

    // Load fetch connection response
    fetch('conn/session.php')
        .then(response => response.json())
        .then(loginDetails => {
            // Hide the preloader
            if (preloader) {
                preloader.style.display = "none";
            }

            if (loginDetails.status == 'success') {
                // Store loginDetails to localStorage
                localStorage.setItem('loginDetails', JSON.stringify(loginDetails));
                console.log(loginDetails);
            } else {
                console.log(loginDetails);
                // Route to index
                window.location.href = 'index';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            // Hide the preloader in case of an error
            if (preloader) {
                preloader.style.display = "none";
            }
        });
});