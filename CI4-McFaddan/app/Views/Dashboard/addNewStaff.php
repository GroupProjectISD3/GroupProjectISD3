

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


        <!-- Main content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-5">
            <div class="container">

                <h2 class="mb-4">Add Staffs</h2>
                <?php if (session()->has('error')): ?>
                    <div class="alert alert-danger">
                        <?php echo session('error'); ?>
                    </div>
                <?php endif; ?>
                <?php echo form_open_multipart('AdminDashboardController/addNewStaff'); ?>
                    
                    
                    <div class="mb-3 row">
                        <label for="firstname" class="col-sm-2 col-form-label">First Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo set_value('firstname'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('firstname'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="lastname" class="col-sm-2 col-form-label">Last Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo set_value('lastname'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('lastname'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('email'); }?></label>
                        </div>
                    </div>
                    


                    <div class="mb-3 row">
                        <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                        <div class="col-sm-10">
                            <input type="phone" class="form-control" id="phone" name="phone" value="<?php echo set_value('phone'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('phone'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="address1" class="col-sm-2 col-form-label">Address 1</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="address1" name="address1" value="<?php echo set_value('address1'); ?>" ><?php echo set_value('address1'); ?></textarea>
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('address1'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="address2" class="col-sm-2 col-form-label">Address 2</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="address2" name="address2" value="<?php echo set_value('address2'); ?>" ><?php echo set_value('address2'); ?></textarea>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="address3" class="col-sm-2 col-form-label">Address 3</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="address3" name="address3" value="<?php echo set_value('address3'); ?>" ><?php echo set_value('address3'); ?></textarea>
                        </div>
                    </div>

                    

                    <div class="mb-3 row">
                        <label for="city" class="col-sm-2 col-form-label">City</label>
                        <div class="col-sm-10">
                            <input type="city" class="form-control" id="city" name="city" value="<?php echo set_value('city'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('city'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="country" class="col-sm-2 col-form-label">Country</label>
                        <div class="col-sm-10">
                            <input type="country" class="form-control" id="countryfake" name="countryfake" value="Ireland" disabled>
                            <input type="hidden" class="form-control" id="country" name="country" value="Ireland">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="eircode" class="col-sm-2 col-form-label">Eircode</label>
                        <div class="col-sm-10">
                            <input type="eircode" class="form-control" id="eircode" name="eircode" value="<?php echo set_value('eircode'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('eircode'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="date" class="col-sm-2 col-form-label">Hire Date</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="date" name="date" value="<?php echo set_value('date'); ?>">
                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('date'); }?></label>
                        </div>
                    </div>

                    <!--// `firstname`, `lastname`, `email`, `phone`, `address1`, `address2`, `address3`, `city`, `country`, `eircode`, `hireDate`, `gender`, `title`, `jobTitle`, `role`, `passwordHash`,-->
                    <div class="mb-3 row">
    					<label for="gender" class="col-sm-2 col-form-label">Gender</label>
					    <div class="col-sm-10">
					        <select class="form-control" id="gender" name="gender">
					            <option value="Male">Male</option>
					            <option value="Female">Female</option>
					            <option value="Other">Other</option>
					        </select>
					    </div>
					</div>

					<div class="mb-3 row">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="title" class="form-control" id="title" name="title" value="<?php echo set_value('title'); ?>">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="jobTitle" class="col-sm-2 col-form-label">Job Title</label>
                        <div class="col-sm-10">
                            <input type="jobTitle" class="form-control" id="jobTitle" name="jobTitle" value="<?php echo set_value('jobTitle'); ?>">

                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('jobTitle'); }?></label>
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo set_value('password'); ?>">

                            <!-- Display validation error for the field -->
                            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('password'); }?></label>
                        </div>
                    </div>


                    <div class="mb-3 row">
                        <div class="col-sm-10 offset-sm-2">
                            <button type="submit" class="btn btn-success" name="addNewStaff">Add Staff</button>
                            <a href="<?= base_url('dashboard') ?>" class="btn btn-primary">Go Back </a>
                        </div>
                    </div>
                </form>
            </div>
            <?= form_close(); ?>
            <!-- Bootstrap JS and dependencies -->
            
            <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>