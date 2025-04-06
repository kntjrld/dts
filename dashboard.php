<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- icon -->
    <link rel="icon" href="media/DepED logo.png">
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- default.css -->
    <link rel="stylesheet" href="css/default.css">
    <!-- dashboard.css -->
    <link rel="stylesheet" href="css/dashboard.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <div id="default-container"></div>
    <!-- modals -->
    <div id="modal-container"></div>
    <div class="content">
        <!-- Dashboard for incoming, outgoing, terminal docs and total Docs -->
        <!-- Main Content -->
        <div class="main-content">
            <h3>Dashboard</h3>
            <div class="dashboard">
                <div class="dashboard-card">
                    <span>1</span>
                    <h6>Incoming</h6>
                </div>
                <div class="dashboard-card">
                    <span>2</span>
                    <h6>Outgoing</h6>
                </div>
                <div class="dashboard-card">
                    <span>3</span>
                    <h6>Terminal Docs</h6>
                </div>
                <!-- <div class="dashboard-card">
                    <span>4</span>
                    <h6>Total Docs</h6>
                </div> -->
                <!-- dropdown by month year -->
                <div class="dropdown">
                    <!-- select -->
                    <select id="monthYearSelect" class="form-control">
                        <option value="all">All</option>
                        <!-- dynamic month year -->
                    </select>
                </div>
            </div>
            <!-- Chart Section -->
            <div class="chart-container">
                <canvas id="dashboardChart"></canvas>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- default -->
    <script src="js/default.js"></script>
    <!-- connection js -->
    <script src="js/connection.js"></script>
    <!-- chart js -->
    <script src="js/chart.js"></script>
</body>

</html>