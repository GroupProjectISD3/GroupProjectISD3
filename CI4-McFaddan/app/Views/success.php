<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>McFaddan Instruments</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
   

    <!-- Bootstrap -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">    
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>  
	
	<!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!--Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    
    <style>
       .not-found-bg {
            background-image: url(https://cdn.dribbble.com/users/1294292/screenshots/4844920/media/c60526d282edd29e6f675058b7e278b3.gif);
            height: 400px;
            background-position: center;
            background-size: contain;
            background-repeat: no-repeat;
            margin-top: 30px; /* Adjust the margin-top value for space between navbar and title */
        }

        /* Center the McFaddan title */
        .not-found-bg h1 {
            color: #ce1c01;
            text-align: center;
            margin-top: 20px; /* Adjust the margin-top value for space between title and message */
        }

        /* Add space between message and footer */
        .container mt-5 {
            margin-bottom: 100px; /* Adjust the margin-bottom value for space between message and footer */
        }
    </style>
</head>

<body>
  
<?php


	helper(['url']);

$base = base_url();

$controller_base = $base."contact.php/";

?>

   <?php if ($isLoggedIn && $userRole == 'member'): ?>
    <!-- HTML content for logged in members -->
     <!-- Navbar starts -->
	 
	 
	 
	 <!-- Add this section at the beginning to handle form submission -->
<?php
   
?>
 <div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="index.html" class="text-decoration-none d-block d-lg-none">
                    <a href="<?= base_url('index') ?>"class="text-decoration-none mr-3">
                        <img src="<?php echo $base . "img/IconMcFaddan3.png"?>" alt="IconMcFaddan" style="width: 125px; height: 125px;">
                    </a>
            
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                       <a href="<?= base_url('index') ?>"class="nav-item nav-link text-danger">Home</a>
                        <div class="nav-item dropdown">
                         <a href="<?= base_url('products') ?>" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <?php 
                                    if (is_array($categories)) {
                                        foreach ($categories as $category): ?>
                                            <a href="<?= base_url('MemberController/products/' . $category['categoryID']) ?>" class="dropdown-item"><?php echo $category['categoryName']; ?></a>
                                        <?php endforeach; 
                                    } else {
                                        echo '<p>' . $categories . '</p>';
                                    }
                                ?>
                            </div>
                        </div>
                        <a href="<?= base_url('contact') ?>" class="nav-item nav-link">Contact</a>
                        <a href="<?= base_url('faq') ?>"class="nav-item nav-link">FAQ</a>
                        <p class="nav-item nav-link" style="margin: 0; font-weight: bold; color: #47acae;">Welcome, <?= $first_name ?>!</p>
                    </div>
                    <div class="col-lg-4 col-6 ml-auto text-left">
                        <form action="">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search text-danger"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search for products">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-6 text-right d-flex align-items-center">
                        
                        <a href="<?= base_url('cart') ?>"class="btn border">
                            <i class="fas fa-shopping-cart text-danger"></i>
                            <span class="badge badge-light" style="position: relative; top: -10px; left: -5px; color:#328f91;"><?= $cartCount ?></span>
                        </a>
                        <a href="<?= base_url('logout') ?>" class="btn border" onclick="return confirm('Are you sure you want to log out?');">
                            <i class="fas fa-sign-out-alt" style=" color:#dc3545"></i>
                        </a>

                         <a href="<?= base_url('wishlist') ?>" class="btn border">
                            <i class="fas fa-heart mr-2" style=" color:#dc3545"></i>
                        
                        </a>

                        
</div>
                </div>
                </a>
                
            </nav>
            
        
<!-- Navbar End -->
<?php else: ?>
    <!-- Not Logged In content -->
     <!-- Navbar starts -->
 <div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="index.html" class="text-decoration-none d-block d-lg-none">
                    <a href="<?= base_url('index') ?>"class="text-decoration-none mr-3">
                        <img src="<?php echo $base . "img/IconMcFaddan3.png"?>" alt="IconMcFaddan" style="width: 125px; height: 125px;">
                    </a>
            
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                       <a href="<?= base_url('index') ?>"class="nav-item nav-link text-danger">Home</a>
                        <div class="nav-item dropdown">
                         <a href="<?= base_url('products') ?>" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <?php 
                                    if (is_array($categories)) {
                                        foreach ($categories as $category): ?>
                                            <a href="<?= base_url('MemberController/products/' . $category['categoryID']) ?>" class="dropdown-item"><?php echo $category['categoryName']; ?></a>
                                        <?php endforeach; 
                                    } else {
                                        echo '<p>' . $categories . '</p>';
                                    }
                                ?>
                            </div>
                        </div>
                        <a href="<?= base_url('contact') ?>" class="nav-item nav-link">Contact</a>
                        <a href="<?= base_url('faq') ?>"class="nav-item nav-link">FAQ</a>
                    </div>
                    <div class="col-lg-4 col-6 ml-auto text-left">
                        <form action="">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search text-danger"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" placeholder="Search for products">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-2 col-6 text-right d-flex align-items-center">
                        <a href="<?= base_url('cart') ?>"class="btn border">
                            <i class="fas fa-shopping-cart text-danger"></i>
                            <span class="badge badge-light" style="position: relative; top: -10px; left: -5px; color:#328f91;"><?= $cartCount ?></span>
                        </a>
                        <a href="<?= base_url('portal') ?>" class="btn border">
                            <i class="fas fa-user text-danger"></i>
                        
                        </a>
</div>
                </div>
                </a>
                
            </nav>
            
        
<!-- Navbar End -->
<?php endif; ?>

<div class="not-found-bg">
    <h1 style="color:#ce1c01">McFaddan</h1>
</div>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center font-weight-bold" style="color: black;">
                    Thank You
                </div>
                <div class="card-body">
                    <p>Your message has been received. We will keep in touch with you shortly.</p>
                    <a href="<?= base_url('index') ?>" class="btn btn-primary">Back to Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer starts -->
<div class="container-fluid" style="background-color: #f4f4f4; color: black; padding-top: 60px; padding-bottom: 60px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-12 mb-5 d-flex flex-column justify-content-center align-items-center">
                <div class="rounded p-2 text-center text-white mb-3" style="background-color: #e7131a; width: 200px;">
                    <div class="mb-2">Your Account</div>
                </div>
                <div class="rounded p-2 text-center" style="background-color: #e7131a; width: 200px;">
                    <div class="d-flex flex-column justify-content-center text-white">
                        <div class="mb-2">Login</div>
                        <div class="mb-2">Order History</div>
                        <div class="mb-2">Wish List</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 text-center mb-5">
                <h5 class="font-weight-bold text-dark mb-4">Connect with Us</h5>
                <div class="d-flex justify-content-center mb-3">
                    <div class="mr-3">
                        <i class="fab fa-facebook-f text-dark mb-2" style="font-size: 2rem;"></i>
                        <div class="text-muted">Facebook&nbsp;&nbsp;&nbsp;</div>
                    </div>
                    <div class="mr-3">
                        <i class="fab fa-youtube text-dark mb-2" style="font-size: 2rem;"></i>
                        <div class="text-muted">YouTube&nbsp;&nbsp;&nbsp;</div>
                    </div>
                    <div>
                        <i class="fab fa-twitter text-dark mb-2" style="font-size: 2rem;"></i>
                        <div class="text-muted">Twitter</div>
                    </div>
                </div>
                <div class="d-flex justify-content-center">
                    <div class="mr-3">
                        <i class="fab fa-instagram text-dark mb-2" style="font-size: 2rem;"></i>
                        <div class="text-muted">Instagram</div>
                    </div>
                    <div class="mr-3">
                        <i class="fab fa-pinterest text-dark mb-2" style="font-size: 2rem;"></i>
                        <div class="text-muted">Pinterest</div>
                    </div>
                    <div>
                        <i class="fab fa-linkedin text-dark mb-2" style="font-size: 2rem;"></i>
                        <div class="text-muted">LinkedIn</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 text-lg-left text-center">
                <h5 class="font-weight-bold text-dark mb-4">Contact Information</h5>
                <p class="text-muted mb-2">1234 Main Street</p>
                <p class="text-muted mb-2">City, State 12345</p>
                <p class="text-muted mb-2">Email: info@example.com</p>
                <p class="text-muted mb-2">Phone: +1 (555) 555-5555</p>
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

<script src="https://code.jquery.com/jquery-3.6.4.slim.min.js" integrity="sha384-xxxxxxxxxx" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-xxxxxxxxxx" crossorigin="anonymous"></script>
</body>

</html>
