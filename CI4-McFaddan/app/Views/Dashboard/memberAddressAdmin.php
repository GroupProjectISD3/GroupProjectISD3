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
</head>
<body>

       <div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block sidebar bg-dark">
            <div class="position-sticky d-flex flex-column align-items-center justify-content-center vh-100">
                <?php if($isLoggedIn && $userRole == 'admin'): ?>
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
                <?php elseif($isLoggedIn && $userRole == 'staff'): ?>
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
                            <a class="nav-link text-light mb-2" href="<?= base_url('viewMembersDashboard') ?>">
                                <i class="fas fa-user-friends me-2"></i>
                                Members
                            </a>
                        </li>
                    </ul>
                <?php endif; ?>
                
                <ul class="nav flex-column w-100">
                    <!-- Other menu items -->
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="<?= base_url('logout') ?>">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
            <div class="container">
                <?php if($isLoggedIn && $userRole == 'admin'): ?>
                    <!-- Display user-specific content, like user email -->
                    <p>Super Admin</p>
                    <p>Welcome, <?= $first_name ?>!</p>
                <?php elseif($isLoggedIn && $userRole == 'staff'): ?>
                    <!-- Display content for staff -->
                    <p>Welcome, staff member <?= $first_name ?>!</p>
                <?php endif; ?>

                <h3 class="mb-4">Member Address</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Address 1</th>
                            <th scope="col">Address 2</th>
                            <th scope="col">Address 3</th>
                            <th scope="col">City</th>
                            <th scope="col">County</th>
                            <th scope="col">Eircode</th>
                            
                           
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php foreach ($addresses as $address): ?>
                        <tr>
						    <td><?php echo $address['address1']; ?></td>
                            <td><?php echo $address['address2']; ?></td>
                            <td><?php echo $address['address3']; ?></td>
                            <td><?php echo $address['city']; ?></td>
                            <td><?php echo $address['county']; ?></td>
                            <td><?php echo $address['eircode']; ?></td>

                            
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <a href="<?= base_url('viewMembersDashboard') ?>" class="btn btn-primary">Go Back </a>

            </div>
            
        </main>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>