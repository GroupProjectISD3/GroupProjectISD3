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
        
        .small-input {
            width: 150px;
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

                <h2 class="mb-4">Add Category</h2>
                <!-- Check if there is an error flash data -->
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo session('error'); ?>
                    </div>
                <?php endif; ?>
                <?php echo form_open_multipart('AdminDashboardController/insertCategory'); ?>
                   

                    <div class="mb-3 row">
                        <label for="categoryName" class="col-sm-2 col-form-label">Category Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="categoryName" name="categoryName" value="<?php echo set_value('categoryName'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('categoryName'); }?></label>
                        </div>
                    </div>

                <div class="mb-3 row">
                    <label for="image" class="col-sm-2 col-form-label">Product Image</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" id="image" name="image">
                        <!-- Display validation error for the field -->
                        <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('image'); }?></label>
                    </div>
                </div>

                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" name="addCategory" class="btn btn-success">Add Category</button>
							<a href="<?= base_url('viewCategoryDashboard') ?>" class="btn btn-primary">Go Back </a>	
							
                        </div>
                    </div>
                </form>
            </div>
            <?= form_close(); ?>
            <!-- Bootstrap JS and dependencies -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>