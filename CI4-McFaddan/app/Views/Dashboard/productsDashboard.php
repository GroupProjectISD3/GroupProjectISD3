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
</head>
<body>

    <?php


    helper(['url']);

$base = base_url() .  "uploads/ResourceImageProduct/";

$controller_base = $base."index.php/";

?>

       <div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
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
        <a class="nav-link text-light mb-2" href="<?= base_url('AdminDashboardController/logout') ?>">
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

                <h2 class="mb-4">Products Dashboard</h2>
                <table class="table">
                    <thead>
                        <tr>
                            

                            <th scope="col">Product Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">Image</th>
                            <th scope="col">Quantity</th>
                            <th scope="col"></th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($products as $product): ?>
                            <tr>
						<td><?= $product['productName'] ?></td>
						<td>€<?= $product['price'] ?></td>
						<td><?= $product['description'] ?></td>
                        <td><img src="<?= $base . $product['imagePath'] ?>" height="100" width="100"></td>
						<td><?= $product['stockQuantity'] ?></td>
    <td>
			

			
<?= form_open(base_url("AdminDashboardController/deleteProduct/" . ($product['id'] ?? '')), ['method' => 'post', 'style' => 'display:inline;']); ?>
<button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this product?');">Delete Product</button>
<?= form_close(); ?>

<?= form_open(base_url("AdminDashboardController/updateProduct/" . ($product['id'] ?? '')), ['method' => 'post', 'style' => 'display:inline;']); ?>
    <button type="submit" name="update" id="update" class="btn btn-primary">Update Product</button>
<?= form_close(); ?>



    </td>
</tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
<a href="<?= base_url('viewAddProductDashboard') ?>" class="btn btn-success">Add New</a>
<a href="<?= base_url('dashboard') ?>" class="btn btn-primary">Go Back </a>

            </div>
        </main>
    </div>
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