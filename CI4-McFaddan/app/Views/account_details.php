<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>McFaddan Instruments</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
   

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!--Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    
    
</head>

<body>

<?php


	helper(['url']);

$base = base_url() .  "/";



?>
   <?php if ($isLoggedIn && $userRole == 'member'): ?>
    <!-- HTML content for logged in members -->
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
                        <p class="nav-item nav-link" style="margin: 0; font-weight: bold; color: #47acae;">Welcome, <?= $first_name ?>!</p>
                    </div>
                    <div class="col-lg-4 col-6 ml-auto text-left">
                        <form action="">
                            
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


<div class="container mt-5" style="margin-bottom:5%;">
    <section class="container mt-5">
        <!-- Billing Address Section -->
        
        <div style="max-width: 800px; margin: auto;">
            <h3 style="margin-bottom: 5%;">Member Address</h3>
            <?php echo form_open_multipart('MemberController/addNewMemberAddress'); ?>
                <div class="form-group mb-3">
                    <label for="address1">Address 1</label>
                    <input type="text" class="form-control" id="address1" name="address1" value="<?php echo set_value('address1'); ?>">
                    <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('address1'); }?></label>
                </div>
                <div class="form-group mb-3">
                    <label for="address2">Address 2</label>
                    <input type="text" class="form-control" id="address2" name="address2" value="<?php echo set_value('address2'); ?>">
                    <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('address2'); }?></label>
                </div>
                <div class="form-group mb-3">
                    <label for="address3">Address 3</label>
                    <input type="text" class="form-control" id="address3" name="address3" value="<?php echo set_value('address3'); ?>">
                    <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('address3'); }?></label>
                </div>
                <div class="form-group mb-3">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo set_value('city'); ?>">
                    <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('city'); }?></label>
                </div>
                <div class="form-group mb-3">
                    <label for="county">County</label>
                    <input type="text" class="form-control" id="county" name="county" value="<?php echo set_value('county'); ?>">
                    <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('county'); }?></label>
                </div>
                <div class="form-group mb-3">
                    <label for="eircode">Eircode</label>
                    <input type="text" class="form-control" id="eircode" name="eircode" value="<?php echo set_value('eircode'); ?>">
                    <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('eircode'); }?></label>
                </div>
                <!-- Add more billing address details as needed -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary" style="background-color: black; outline-color: black; box-shadow: black; border-color: black;"name="submit">Use Address</button>
                </div>
            </form>
        </div>
    </section>
</div>
      
            
        
               
              
          <!--- footer --->
<div class="container-fluid" style="background-color: #f4f4f4; color: black; padding-top: 60px; padding-bottom: 60px;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-12 mb-5 d-flex flex-column justify-content-center align-items-center">
                <!-- Small Rectangle with "Quick Links" -->
                <div class="rounded p-2 text-center text-white mb-3" style="background-color: #e7131a; width: 200px;">
                    <div class="mb-2">Your Account</div>
                </div>
                <!-- Quick Links (left side) with Rectangle Background -->
                <div class="rounded p-2 text-center" style="background-color: #e7131a; width: 200px;">
                    <div class="d-flex flex-column justify-content-center text-white">
                        <div class="mb-2">Login</div>
                        <div class="mb-2">Order History</div>
                        <div class="mb-2">Wish List</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 text-center mb-5">
   
                
                
                <!-- Follow Us (centered) -->
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
    <div class="mr-3">
        <i class="fab fa-twitter text-dark mb-2" style="font-size: 2rem;"></i>
        <div class="text-muted">Twitter&nbsp;&nbsp;&nbsp;</div>
    </div>
    <div>
        <i class="fab fa-instagram text-dark mb-2" style="font-size: 2rem;"></i>
        <div class="text-muted">Instagram</div>
    </div>
</div>

</div>
            
            
            
            <!-- Quick Links (right side) -->

            <div class="col-lg-4 col-md-12 text-center mb-5">
                <h5 class="font-weight-bold text-dark mb-4">Quick Links</h5>
                <div class="d-flex flex-column justify-content-center">
                    <a class="text-dark mb-2"  <a href="<?= base_url('products') ?>">
                        <i class="fas fa-guitar fa-fw mr-2"></i>Acoustics
                    </a>
                    <a class="text-dark mb-2"<a href="<?= base_url('products') ?>">
                        <i class="fas fa-plug fa-fw mr-2"></i>Eletrics
                    </a>
                    <a class="text-dark mb-2" <a href="<?= base_url('products') ?>">
                        <i class="fas fa-drum fa-fw mr-2"></i>Drums
                    </a>
                    <a class="text-dark mb-2" <a href="<?= base_url('products') ?>">
                        <i class="fas fa-keyboard fa-fw mr-2"></i>Keyboards
                    </a>
                    <a class="text-dark mb-2" <a href="<?= base_url('products') ?>">
                        <i class="fas fa-headphones fa-fw mr-2"></i>Accessories
                    </a>
                    <a class="text-dark mb-2" <a href="<?= base_url('products') ?>">
                        <i class="fas fa-volume-up fa-fw mr-2"></i>Amps
                    </a>
                </div>
           


<!-- Footer End -->


        </div>
    </div>
    </div>

    
            </div>
        </div>
    </div>
    </div>
    
 <?php


?>