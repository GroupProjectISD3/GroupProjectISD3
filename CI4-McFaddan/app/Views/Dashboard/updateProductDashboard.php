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
        
        .small-input {
            width: 150px;
        }
    </style>
</head>

<body>

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

                <h2 class="mb-4">Update Product</h2>

                <!-- Check if there is an error flash data -->
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo session('error'); ?>
                    </div>
                <?php endif; ?>
                <?php echo form_open_multipart('AdminDashboardController/updateProduct/'.$product['productID']); ?>

                    <div class="mb-3 row">
                        <label for="productName" class="col-sm-2 col-form-label">Product Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="productName" name="productName" value="<?php echo set_value('productName'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('productName'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="description" class="col-sm-2 col-form-label">Description</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="description" name="description" value="<?php echo set_value('description'); ?>" ></textarea>
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('description'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="price" class="col-sm-2 col-form-label">Price</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="price" name="price" value="<?php echo set_value('price'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('price'); }?></label>
                        </div>
                    </div>

                     <div class="mb-3 row">
                        <label for="image" class="col-sm-2 col-form-label">Product Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('image'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="stock" class="col-sm-2 col-form-label">Stock Quantity</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control" id="stock" name="stockQuantity" value="<?php echo set_value('stockQuantity'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('stockQuantity'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="color" class="col-sm-2 col-form-label">Color</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="color" name="color" value="<?php echo set_value('color'); ?>" >
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('color'); }?></label>
                        </div>
                    </div>

                    
                    <div class="mb-3 row">
                        <label for="categoryID" class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-10">
                            <select class="form-control" id="categoryID" name="categoryID" value="<?php echo set_value('categoryID'); ?>">
                                <?php foreach ($categories  as $categoryItem): ?>
                                    <option value="<?= $categoryItem['categoryID'] ?>"><?= $categoryItem['categoryName'] ?></option>
                                <?php endforeach; ?>
                            </select>
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('categoryID'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-success" name="updateProductButton">Update Product</button>
							<a href="<?= base_url('viewProductsDashboard') ?>" class="btn btn-primary">Go Back </a>

							
							
							
<?php if (session()->has('updatedProduct')) : ?>
    <!-- Display updated product data -->
    <div class="alert alert-success">
        Product updated successfully! Updated product details:
        <?= print_r(session('updatedProduct')) ?>
    </div>
<?php endif; ?>

							
				</div>
                    </div>
                </form>
            </div>
            <?= form_close(); ?>
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