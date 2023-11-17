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
                <ul class="nav flex-column w-100">
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="<?= base_url('dashboard') ?>">
                            <i class="fas fa-tachometer-alt me-2"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="#">
                            <i class="fas fa-users me-2"></i>
                            Administrators
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="#">
                            <i class="fas fa-users-cog me-2"></i>
                            Staff
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="#">
                            <i class="fas fa-user-friends me-2"></i>
                            Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-light mb-2" href="#">
                            <i class="fas fa-chart-line me-2"></i>
                            Sales
                        </a>
                    </li>
                </ul>
                
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

                <h2 class="mb-4">McFaddan Members</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Username</th>
                            <th scope="col">Email</th>
                            <th scope="col">Addresses</th>
                            
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($members)): foreach ($members as $member): ?>
                        <tr>
						    <td><?= $member['firstName'] ?></td>
                            <td><?= $member['lastName'] ?></td>
                            <td><?= $member['userName'] ?></td>
                            <td><?= $member['email'] ?></td>
                            <td><a href="<?= base_url('AdminDashboardController/getMemberAddress/' . $member['memberID']) ?>">More...</a></td>

                            
                        </tr>
                        <?php endforeach; 
                            else: ?>
                        <tr> <td colspan = "5"> No Member Found :) </td> </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
                <?php echo $pager->links(); ?>
                <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">Go Back </a>

            </div>
            
        </main>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>