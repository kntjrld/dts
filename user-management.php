<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- icon -->
    <link rel="icon" href="media/DepED logo.png">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- connection js -->
    <script src="js/connection.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- default.css -->
    <link rel="stylesheet" href="css/default.css">
    <!-- track css -->
    <link rel="stylesheet" href="css/track.css">
    <!-- management css -->
    <link rel="stylesheet" href="css/management.css">
    <!-- swalfire.css -->
    <link rel="stylesheet" href="css/swalfire.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div id="default-container"></div>
    <!-- modals -->
    <div id="modal-container"></div>
    <!-- Custom Modal -->
    <div class="modal fade" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="customModalLabel">Create User</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Modal content goes here -->
                    <form id="CreateUserForm">
                        <div class="form-group flex-container">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="form-group flex-container">
                            <label for="fullname">Fullname</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" required>
                        </div>
                        <div class="form-group flex-container">
                            <label for="email">Email Address</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group flex-container">
                            <label for="office">Office</label>
                            <select class="form-control" id="office" name="office" required>
                                <!-- Options will be populated here -->
                            </select>
                        </div>
                        <div class="form-group flex-container">
                            <label for="type">User type</label>
                            <select class="form-control" id="type" name="type" required>
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>
                        </div>
                        <div class="form-group flex-container">
                            <label for="position">Position</label>
                            <input type="text" class="form-control" id="position" name="position" required>
                        </div>
                        <!-- <div class="form-group flex-container">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group flex-container">
                            <label for="password_confirm">Confirm Password</label>
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm"
                                required>
                        </div> -->
                    </form>
                    <div class="invalid-feedback" id="invalid-feedback" style="display: none;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="saveChanges">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <div class="container-header">
                <h3>Users</h3>
                <i class="fa-solid fa-user-plus" data-toggle="modal" data-target="#customModal"></i>
            </div>
            <!-- Search Input -->
            <div class="search-container">
                <!-- label -->
                <label for="searchInput">Search:</label>
                <div class="input-group">
                    <input class="searchInput" id="searchInput" type="text" placeholder="&#xf002;">
                </div>
            </div>
            <div class="table-container">
                <!-- h5 title -->
                <dv class="x-title">
                    <h5>List of users</h5>
                </dv>
                <!-- Table -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Username</th>
                            <th>Fullname</ht>
                            <th>Office</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <!-- Table rows will go here -->
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation" class="nav-pagination">
                <ul class="pagination" id="paginationLinks">
                    <!-- Pagination links will go here -->
                </ul>
            </nav>
        </div>
    </div>
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/default.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/table.js"></script>

    <script>
    $(document).ready(function() {
        // Fetch document destinations from the server
        $.ajax({
            url: 'conn/manage_db.php',
            method: 'POST',
            dataType: 'json',
            data: {
                admin: true
            },
            success: function(response) {
                const destinationSelect = $('#office');
                response.forEach(off => {
                    const option = $('<option></option>').attr('value', off
                        .office_name).text(off.office_name);
                    destinationSelect.append(option);
                });
            },
            error: function(error) {
                // alert(error);
                console.error('Error fetching destinations:', error);
            }
        });
    });
    </script>

    <!-- Search and Pagination Script -->
    <script>
    let data = [];
    const rowsPerPage = 5; // Number of rows per page
    let currentPage = 1; // Current page

    // Function to fetch data from the server
    function fetchData() {
        $.ajax({
            url: 'conn/users_db.php',
            method: 'POST',
            dataType: 'json',
            data: {
                admin: true
            },
            success: function(response) {
                data = response;
                const filteredData = filterData();
                displayTable(filteredData);
                createPagination(filteredData);
            },
            error: function(error) {
                alert(error);
                console.error('Error fetching data:', error);
            }
        });
    }
    // Function to display the table rows
    function displayTable(filteredData) {
        const start = (currentPage - 1) * rowsPerPage;
        const end = currentPage * rowsPerPage;
        const tableBody = document.getElementById('tableBody');
        tableBody.innerHTML = '';

        // Slice the data for current page
        const pageData = filteredData.slice(start, end);

        pageData.forEach(row => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${row.username}</td>
                <td>${row.fullname}</td>
                <td>${row.office}</td>
                <td>${row.position}</td>
                <td><button class="x-btn-action">Modify</button></td>
            `;
            tableBody.appendChild(tr);
        });
        updateStatusDesign();
    }

    // Function to create the pagination links
    function createPagination(filteredData) {
        const paginationLinks = document.getElementById('paginationLinks');
        paginationLinks.innerHTML = '';

        const totalPages = Math.ceil(filteredData.length / rowsPerPage);

        // Create Previous page button
        const prevButton = document.createElement('li');
        prevButton.classList.add('page-item');
        prevButton.innerHTML = `<a class="page-link" href="#" aria-label="Previous">&laquo;</a>`;
        prevButton.onclick = () => changePage(currentPage - 1);
        paginationLinks.appendChild(prevButton);

        // Create page number buttons
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('li');
            pageButton.classList.add('page-item');
            pageButton.innerHTML = `<a class="page-link" href="#">${i}</a>`;
            pageButton.onclick = () => changePage(i);
            paginationLinks.appendChild(pageButton);
        }

        // Create Next page button
        const nextButton = document.createElement('li');
        nextButton.classList.add('page-item');
        nextButton.innerHTML = `<a class="page-link" href="#" aria-label="Next">&raquo;</a>`;
        nextButton.onclick = () => changePage(currentPage + 1);
        paginationLinks.appendChild(nextButton);
    }

    // Function to change the page
    function changePage(pageNumber) {
        const filteredData = filterData(); // Get filtered data
        const totalPages = Math.ceil(filteredData.length / rowsPerPage);

        if (pageNumber < 1 || pageNumber > totalPages) return;

        currentPage = pageNumber;
        displayTable(filteredData);
        createPagination(filteredData);
    }

    // Function to filter data based on search input
    function filterData() {
        const searchInput = document.getElementById('searchInput').value.toLowerCase();
        return data.filter(row => {
            return row.username.toLowerCase().includes(searchInput) ||
                row.office.toLowerCase().includes(searchInput) ||
                row.fullname.toLowerCase().includes(searchInput);
        });
    }

    // Event listener for search input
    document.getElementById('searchInput').addEventListener('keyup', function() {
        currentPage = 1; // Reset to the first page on new search
        const filteredData = filterData();
        displayTable(filteredData);
        createPagination(filteredData);
    });

    // Event listener for username input
    $('#username').on('blur', function() {
        const username = $(this).val();
        if (username) {
            checkUserExists('username', username);
        }
    });

    // Event listener for email input
    $('#email').on('blur', function() {
        const email = $(this).val();
        if (email) {
            checkUserExists('email', email);
        }
    });

    function checkUserExists(field, value) {
        $.ajax({
            url: 'conn/check_user.php',
            method: 'POST',
            data: {
                [field]: value
            },
            success: function(response) {
                response = JSON.parse(response);
                if (response.status === "exists") {
                    if (field === 'username') {
                        $('#CreateUserForm').addClass('is-invalid');
                        $('#CreateUserForm').next('.invalid-feedback').text(response.message).show();
                        $('#username').val('');
                        $('#username').focus();
                    } else if (field === 'email') {
                        $('#CreateUserForm').addClass('is-invalid');
                        $('#CreateUserForm').next('.invalid-feedback').text(response.message).show();
                        $('#email').val('');
                        $('#email').focus();
                    }
                } else {
                    if (field === 'username') {
                        $('#CreateUserForm').removeClass('is-invalid');
                        $('#CreateUserForm').next('.invalid-feedback').hide();
                    } else if (field === 'email') {
                        $('#CreateUserForm').removeClass('is-invalid');
                        $('#CreateUserForm').next('.invalid-feedback').hide();
                    }
                }
            },
            error: function(error) {
                console.error('Error checking user data:', error);
            }
        });
    }

    // Event listener for save changes button in modal
    document.getElementById('saveChanges').addEventListener('click', function() {
        const form = document.getElementById('CreateUserForm');
        if (form.checkValidity()) {
            const formData = {
                username: form.username.value,
                fullname: form.fullname.value,
                email: form.email.value,
                office: form.office.value,
                position: form.position.value
            };
            // Send form data to the server using AJAX
            $.ajax({
                url: 'conn/create_user.php', // Change this to your server-side script
                method: 'POST',
                data: formData,
                success: function(response) {
                    response = JSON.parse(response);
                    console.log('Form Data Saved:', response);
                    alert(response.status);
                    if (response.status === "success") {
                        Swal.fire({
                            title: response.message,
                            icon: "success",
                            timer: 2000
                        }).then(function() {
                            $('#customModal').modal('hide');
                            fetchData(); // Refresh the table data
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Insert Failed',
                            text: response.message,
                            confirmButtonText: 'Try Again'
                        });
                    }
                },
                error: function(error) {
                    console.error('Error saving form data:', error);
                }
            });
        } else {
            form.reportValidity();
        }
    });

    // Initial setup
    fetchData();
    </script>
</body>

</html>