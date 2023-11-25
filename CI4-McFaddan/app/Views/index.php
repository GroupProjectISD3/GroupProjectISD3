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


    
    
</head>

<body>
    
	
<?php


	helper(['url']);

$base = base_url() ;

$controller_base = $base."index.php/";

?>
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
                         <a href="<?= base_url('products') ?>" class="nav-item nav-link">Shop</a>
                        <div class="nav-item dropdown">
                         <a href="<?= base_url('products') ?>" class="nav-link dropdown-toggle" data-toggle="dropdown">Categories</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="<?= base_url('products') ?>" class="dropdown-item">Acoustic</a>
                                 <a href="<?= base_url('products') ?>"class="dropdown-item">Eletrics</a>
                                <a href="<?= base_url('products') ?>"class="dropdown-item">Drums</a>
                                <a href="<?= base_url('products') ?>" class="dropdown-item">Keyboards</a>
                              <a href="<?= base_url('products') ?>"class="dropdown-item">Accessories</a>
                                <a href="<?= base_url('products') ?>" class="dropdown-item">Amps</a>
                            </div>
                        </div>
                        <a href="<?= base_url('contact') ?>" class="nav-item nav-link">Contact</a>
                        <a href="<?= base_url('faq') ?>"class="nav-item nav-link">FAQ</a>
                        <a href="<?= base_url('adminLogin') ?>" class="nav-item nav-link"> Admin</a>
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
                        <?php if ($isLoggedIn): ?>
                            <!-- Display user-specific content, like user email -->
                            <p>Welcome, <?php echo $email; ?>!</p>
                        <?php endif; ?>
                        <a href="<?= base_url('cart') ?>"class="btn border">
                            <i class="fas fa-shopping-cart text-danger"></i>
                        </a>
                        <a href="<?= base_url('portal') ?>" class="btn border">
                            <i class="fas fa-user text-danger"></i>
                        
                        </a>

                         <a href="<?= base_url('wishlist') ?>" class="btn border">
                            <i class="fas fa-heart mr-2" style=" color:#dc3545"></i>
                        
                        </a>

                        
</div>
                </div>
                </a>
                
            </nav>
            
        
<!-- Navbar End -->
    
            
              <!-- Topbar (BANNER) content here -->
<div id="header-banner" class="d-flex justify-content-center align-items-center" style="height: 410px; background: url('<?php echo $base . "img/banner4.png"?>') no-repeat center center; background-size: cover;">
    <div class="text-center">
        <h4 class="text-light text-uppercase font-weight-medium mb-3">10% Off On Your First Order</h4>
        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Symphony <br>of Discounts!</h3>
        <a href="<?= base_url('products') ?>" class="btn btn-light py-2 px-3" style="background-color: #e7131a; color: white;">Shop Now</a>

    </div>
</div>
<!-- Topbar End -->



    

    <!-- Categories Start -->
                <div class="container">

    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="acoustics-item d-flex flex-column border mb-4" style="padding: 30px;">
                    
                     <a href="<?= base_url('products') ?>" class="acoustics-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="<?php echo $base . "img/guitar.png"?>" alt="">
                    </a>
                <h5 class="font-weight-semi-bold m-0" style="color: black;">Acoustics</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="amps-item d-flex flex-column border mb-4" style="padding: 30px;">
                   
                    <a href="<?= base_url('products') ?>"class="amps-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="<?php echo $base . "img/eletrics.png"?>" alt="">
                    </a>
                     <h5 class="font-weight-semi-bold m-0" style="color: black;">Eletrics</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="drums-item d-flex flex-column border mb-4" style="padding: 30px;">
                    
                    <a href="<?= base_url('products') ?>" class="drums-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="<?php echo $base . "img/drums.png"?>" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0" style="color: black;">Drums</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="keyboards-item d-flex flex-column border mb-4" style="padding: 30px;">
                   
                    <a href="<?= base_url('products') ?>" class="keyboards-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="<?php echo $base . "img/keyboards.png"?>" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0" style="color: black;">Keyboards</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="accessories-item d-flex flex-column border mb-4" style="padding: 30px;">
                  
                     <a href="<?= base_url('products') ?>" class="accessories-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="<?php echo $base . "img/accessories.png"?>" alt="">
                    </a>
                     <h5 class="font-weight-semi-bold m-0" style="color: black;">Accessories</h5>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="amps-item d-flex flex-column border mb-4" style="padding: 30px;">
                   
                   <a href="<?= base_url('products') ?>" class="amps-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="<?php echo $base . "img/amps.png"?>" alt="">
                    </a>
                     <h5 class="font-weight-semi-bold m-0" style="color: black;">Amps</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->


   


<!-- Deals Here -->
<div class="container-fluid pt-5">
    <div class="row justify-content-center"> 
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="acoustics-item d-flex flex-column border mb-4" style="padding: 60px; text-align: center; margin: 0 20px;"> 
                <a href="<?= base_url('products') ?>" class="acoustics-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid w-100" src="<?php echo $base . "img/landingPageSale.png"?>" alt="">
                    <span class="label">Acoustics Guitars<br> On Sale!</span>
                </a>
                
               <a href="<?= base_url('products') ?>" class="btn btn-light py-2 px-3" style="background-color: #e7131a; color: white;">Shop Now</a>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6 pb-1">
            <div class="drums-item d-flex flex-column border mb-4" style="padding: 60px; text-align: center; margin: 0 20px;"> 
                <a href="<?= base_url('products') ?>" class="drums-img position-relative overflow-hidden mb-3">
                    <img class="img-fluid w-100" src="<?php echo $base . "img/landingPageSale2.png"?>" alt="">
                    <span class="label">Amps <br> On Sale!</span>
                </a>
               
                 <a href="<?= base_url('products') ?>" class="btn btn-light py-2 px-3" style="background-color: #e7131a; color: white;">Shop Now</a>
            </div>
        </div>
    </div>
</div>
<!-- Deals ends Here -->
            
            



            
       <!-- Banner offer Content Here -->
<div id="second-banner" class="d-flex justify-content-start align-items-center" style="height: 410px; background: url('<?php echo $base . "img/landingPageSales3Banner.png"?>') no-repeat; background-size: contain;">
    <div class="text-left mx-5" style="margin-bottom: 20px;"> 
      
        <h3 class="display-4 text-white font-weight-semi-bold mb-4">Exclusive Offers <br>Just For You</h3>
        <a href="<?= base_url('products') ?>" class="btn btn-light py-2 px-3" style="background-color: #e7131a; color: white;">Explore Now</a>
    </div>
</div>
<!-- Banner offers End -->

            
            
            
            
            
            
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
    
     <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    </div>
    

<?php


?>