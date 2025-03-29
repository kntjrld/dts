<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Document</title>
    <!-- icon -->
    <link rel="icon" href="media/DepED logo.png">
    <!-- jquery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- default.css -->
    <link rel="stylesheet" href="css/default.css">
    <!-- dashboard.css -->
    <link rel="stylesheet" href="css/create.css">
    <!-- swalfire.css -->
    <link rel="stylesheet" href="css/swalfire.css">
    <!-- font-awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- sweet alert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div id="default-container"></div>
    <!-- modals -->
    <div id="modal-container"></div>
    <div class="content">
        <!-- Create Document | input field name Tracking Number, Document Title, Document Destination, Deadline and Priority Status. Create and reset button -->
        <div class="form">
            <h2>Create Document</h2>
            <div class="form-container">
                <form method="POST" id="document-form">
                    <!-- Tracking Number Field -->
                    <div class="form-field">
                        <label for="tracking_number">Tracking Number:</label>
                        <input type="text" id="tracking_number" name="tracking_number" disabled>
                    </div>

                    <!-- Document Title Field -->
                    <div class="form-field">
                        <label for="document_title">Document Title:</label>
                        <input type="text" id="document_title" name="document_title" required>
                    </div>

                    <!-- Document Destination Field -->
                    <div class="form-field">
                        <label for="document_destination">Document Destination:</label>
                        <select id="document_destination" name="document_destination" required>
                            <!-- Options will be populated here -->
                        </select>
                    </div>

                    <!-- Deadline Field -->
                    <div class="form-field">
                        <label for="deadline">Deadline:</label>
                        <input type="date" id="deadline" name="deadline" required>
                    </div>

                    <!-- Priority Status Field -->
                    <div class="form-field">
                        <label for="priority_status">Priority Status:</label>
                        <select id="priority_status" name="priority_status" required>
                            <option value="Urgent">Urgent</option>
                            <option value="High Priority">High Priority</option>
                            <option value="Medium Priority">Medium Priority</option>
                            <option value="Low Priority">Low Priority</option>
                        </select>
                    </div>

                    <!-- Create and Reset Buttons -->
                    <div class="form-actions">
                        <button type="submit" id="create_button">Create</button>
                        <button type="reset-x" id="reset_button">Reset</button>
                    </div>
                </form>
            </div>
            <script src="js/default.js"></script>
            <!-- connection js -->
            <script src="js/connection.js"></script>
            <!-- validation js -->
            <script src="js/validation.js"></script>
            <!-- insert js -->
            <script src="js/insert.js"></script>
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
                            const destinationSelect = $('#document_destination');
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
</body>

</html>