<?php if($isLoggedIn && ($userRole == 'admin' || $userRole == 'staff')): ?>
    

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .sidebar {
            background-color: #343a40;
            color: #ffffff;
        }

        .sidebar a {
            color: #ffffff;
        }

        .sidebar a:hover {
            color: #007bff;
        }

        .content {
            background-color: #f8f9fa;
        }
    </style>
        <!-- Google Charts library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    google.charts.load('current', { 'packages': ['corechart'] });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Category');
        data.addColumn('number', 'Payment Count');

        // Assuming $categoryData is the result from your model
        <?php foreach ($categoryData as $category): ?>
            data.addRows([
            ['<?= trim($category['categoryName']) ?>', <?= $category['paymentCount'] ?>]
        ]);

        <?php endforeach; ?>

        var options = {
            title: 'Categories with Most Payments'
        };

        var chart = new google.visualization.BarChart(document.getElementById('yourChartDiv'));
        chart.draw(data, options);
    }
</script>


</head>
<body>

       <div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar bg-dark">
            <div class="position-sticky d-flex flex-column align-items-center justify-content-center vh-100">
                <ul class="nav flex-column w-100">
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="<?= base_url('dashboard') ?>">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="<?= base_url('viewProductsDashboard') ?>">
                            <!--fas fa-shopping-cart me-2-->
                            <i class="fas fa-box-open me-2"></i>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="<?= base_url('viewStaffsDashboard') ?>">
                            <i class="fas fa-users-cog me-2"></i>
                            Staff
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="<?= base_url('viewMembersDashboard') ?>">
                            <i class="fas fa-user-friends me-2"></i>
                            Members
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="<?= base_url('viewSalesDashboard') ?>">
                            <i class="fas fa-chart-line me-2"></i>
                            Sales
                        </a>
                    </li>
                </ul>

                <ul class="nav flex-column w-100">
                    <!-- Other menu items -->
                    <li class="nav-item">
        <a class="nav-link text-light mb-2" href="<?= base_url('AdminDashboardController/logout') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5 container">
            <?php if($isLoggedIn && $userRole == 'admin'): ?>
                <!-- Display user-specific content, like user email -->
                <p>Super Admin</p>
                <p>Welcome, <?= $first_name ?>!</p>
            <?php endif; ?>
        <div class="row">
            <!-- User Stats Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-user-friends"></i> Member Stats
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Total Members</h5>
                        <p class="card-text"><?= $memberCount ?></p>
                    </div>
                </div>
            </div>

            <!-- Sales Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-chart-line"></i> Sales
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text"><?= $totalSuccessfulPayments ?></p>
                    </div>
                </div>
            </div>

            <!-- Other Card -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <i class="fas fa-users"></i> Staff Stats
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Total  Staffs</h5>
                        <p class="card-text"><?= $staffCount ?></p>
                    </div>
                </div>
            </div>
                <!-- Chart container -->
            <div id="yourChartDiv" style="width: 100%; height: 400px;"></div>
        </div>
    </div>



 <!-- Content -->
            <!--
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                Chart container 
                <div id="yourChartDiv" style="width: 100%; height: 400px;"></div>
            </main>
        </div>-->


    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>

<?php else: ?>
<!-- Redirect to the member index page -->
    <script type="text/javascript">
        window.location.href = "<?= base_url('MemberController/index') ?>";
    </script>
    
<?php endif; ?>