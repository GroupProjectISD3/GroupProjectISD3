<!DOCTYPE html>
<html>
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
</head>

<body>

<?php



helper(['url']);

$base = base_url() .  "/";

$controller_base = $base."dashboard.php/";

?>
   
<body>
   
<div class="container-fluid">
    <div class="row">
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
                            <i class="fas fa-chart-line me-2"></i>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="<?= base_url('dashboard') ?>">
                            <i class="fas fa-users me-2"></i>
                            Administrators
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="<?= base_url('dashboard') ?>">
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
                        <a class="nav-link text-light mb-2" href="<?= base_url('dashboard') ?>">
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

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
            <div class="pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">Dashboard</h1>
            </div>

            <?php if ($isLoggedIn): ?>
                            <!-- Display user-specific content, like user email -->
                            <p>Welcome, <?php echo $email; ?>!</p>
                        <?php endif; ?>

            <div class="row">
                <!-- Administrators Section -->
                <div class="col-lg-4">
                    <div class="card mb-4 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="card-title">Administrators</h2>
                            <a href="<?= base_url('') ?>"  class="btn btn-primary">Manage Administrators</a>
                        </div>
                    </div>
                </div>

                <!-- Staff Section -->
                <div class="col-lg-4">
                    <div class="card mb-4 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="card-title">Staff</h2>
                           <a href="<?= base_url('') ?>"  class="btn btn-primary">Manage Staff</a>
                        </div>
                    </div>
                </div>

                <!-- Customers Section -->
                <div class="col-lg-4">
                    <div class="card mb-4 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="card-title">Members</h2>
                            <a href="<?= base_url('viewMembersDashboard') ?>"  class="btn btn-primary">Manage Members</a>
                        </div>
                    </div>
                </div>

                <!-- Categories Section -->
                <div class="col-lg-4">
                    <div class="card mb-4 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="card-title">Categories</h2>
                            <a href="<?= base_url('viewCategoryDashboard') ?>"  class="btn btn-primary">Manage Categories</a>
                        </div>
                    </div>
                </div>

                <!-- Products Section -->
                <div class="col-lg-4">
                    <div class="card mb-4 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="card-title">Products</h2>
                            <a href="<?= base_url('viewProductsDashboard') ?>" class="btn btn-primary">Manage Products</a>
                        </div>
                    </div>
                </div>

                <!-- Sales Section -->
                <div class="col-lg-4">
                    <div class="card mb-4 d-flex flex-column">
                        <div class="card-body">
                            <h2 class="card-title">Sales</h2>
                            <a href="<?= base_url('viewSalesDashboard') ?>" class="btn btn-primary">View Sales</a>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="<?= base_url('assets/js/bootstrap.bundle.min.js') ?>"></script>
<!-- Font Awesome Icons -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>




<?php


?>