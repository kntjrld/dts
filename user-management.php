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
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <div id="default-container"></div>
    <!-- modals -->
    <div id="modal-container"></div>
    <div class="content">
        <div class="container">
            <h3>Users</h3>
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

    // Initial setup
    fetchData();
    </script>
</body>

</html>