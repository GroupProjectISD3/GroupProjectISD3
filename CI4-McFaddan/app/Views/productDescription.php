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
.product-img {
    height: 200px;
    overflow: hidden;
}
.product-img img {
    width: 100%;
    height: 100%;
    object-fit: cover; 
}
.card-body {
    height: 80px;
}

.page-not-found {
    padding: 40px 0;
    background: #fbfbfb;
    font-family: 'Arvo', serif;
    text-align: center;
    width: 100%;
}

.page-not-found img {
    max-width: 100%;
    height: auto;
    margin-bottom: 20px;
}
.not-found-bg {
    background-image: url(https://cdn.dribbble.com/users/1294292/screenshots/4844920/media/c60526d282edd29e6f675058b7e278b3.gif);
    height: 400px;
    background-position: center;
    background-size: contain; 
    background-repeat: no-repeat;
}

.not-found-bg h1,
.not-found-bg h3 {
    font-size: 60px;
    color: #fff;
    margin: 0;
}

.not-found-content {
    margin-top: -50px;
    color: #333;
}

.not-found-heading {
    font-size: 30px;
    margin-bottom: 10px;
}

.not-found-content p {
    font-size: 18px;
    margin-bottom: 20px;
}

.not-found-link {
    color: #fff!important;
    background: #2b8688; 
    padding: 10px 20px;
    margin: 10px;
    display: inline-block;
    text-decoration: none;
    border-radius: 5px;
}
</style>
    
    
    
</head>

<body>
 
<?php


	helper(['url']);

$base = base_url();

$controller_base = $base."productDescription.php/";

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













    <!-- Shop Detail Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 pb-5">
                <?php 
                    if (is_array($productInfo)) {
                        foreach ($productInfo as $productInformation): ?>
                            <img class="w-100 h-100" src="<?php echo $base . "uploads/ResourceImageProduct/{$productInformation['imagePath']}"; ?>" alt="Product Image">
                    
                    
                               </div>


                            <div class="col-lg-7 pb-5">
                                <h3 class="font-weight-semi-bold"><?php echo $productInformation['productName']; ?></h3>
                                <div class="d-flex mb-3">
                                    <div class="text-primary mr-2">
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star"></small>
                                        <small class="fas fa-star-half-alt"></small>
                                        <small class="far fa-star"></small>
                                    </div>
                                   
                                </div>
                                <h3 class="font-weight-semi-bold mb-4">€<?php echo $productInformation['price']; ?></h3>
                                <p class="mb-4"><?php echo $productInformation['color']; ?></p>
                                
                                <div class="d-flex align-items-center mb-4 pt-2">
                                    <div class="input-group quantity mr-3" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <div class="input-group quantity" style="width: 100px;">
                                                <input type="number" class="form-control bg-white text-dark text-center" value="1">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center">
                                        <i class="far fa-heart fa-lg mr-2" style="cursor: pointer; color:#e7131a"></i>
                                        <!--<i class="fas fa-heart" style="cursor: pointer;"></i> Swap between these two - Onclick-->
                                      <a href="<?= base_url('cart') ?>" class="btn btn-light py-2 px-1" style="background-color: #e7131a; color: white;">Add To Cart</a>
                                    </div>

                                    
                                </div>

                                
                            </div>
                        </div>
                        <div class="row px-xl-5">
                            <div class="col">
                                
                                <div class="tab-content">
                                    <div class="tab-pane fade show active" id="tab-pane-1">
                                        <h4 class="mb-3">Product Description</h4>
                                        <p><?php echo $productInformation['description']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <a href=""><?php echo $productInformation['productName']; ?></a>
                        <?php endforeach; 
                    } else {
                        echo "<section class=\"page-not-found\">
                                        <div class=\"container\">
                                            <div class=\"row\">   
                                                <div class=\"col-sm-12\">
                                                    <div class=\"col-sm-10 col-sm-offset-1 text-center\">
                                                        <div class=\"not-found-bg\">
                                                            <h1 style=\"color:#ce1c01\">McFaddan</h1>
                                                        </div>

                                                        <div class=\"not-found-content\">
                                                            <h3 class=\"not-found-heading\">
                                                                Hey There,
                                                            </h3>

                                                            <p>" . htmlspecialchars($productInfo) . "</p>

                                                            <a href=\"" . base_url('index') . "\" class=\"not-found-link\">Go Back</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>";
                    }
                ?>
            
            </div>
            
                          
    <!-- Shop Detail End -->
            
            
            
            
              
            
              
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