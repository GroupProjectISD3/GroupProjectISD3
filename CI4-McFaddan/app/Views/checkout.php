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

$base = base_url();

$controller_base = $base."checkout.php/";

?>

   <?php if ($isLoggedIn && $userRole == 'customer'): ?>
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

  

<!-- Cart Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5 justify-content-center"> 
        <div class="col-lg-8 mb-5">
          
            <div class="container mt-5">
                <div class="col">
                    <div class="col-md-7 ">
                        <h2>Checkout</h2>
                        
                        <!-- Change Shipping Address Section -->
                        <div class="mt-4 mb-5">
                            <h5 class="mb-3">Change Shipping Address</h5>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address 1">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address 2">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address 3">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="City">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="County">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Eircode">
                                </div>
                            </form>
                        </div>
                        
            
                        

                            <div class="mb-3 text-center">
                                <div>
                                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#popupMcForm" style="background-color: black; border: none;">Pay Now</button>
                                </div>                            

                                <!-- Modal -->
                                <div class="modal fade" id="popupMcForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <img class="modal-title" id="exampleModalLongTitle" src="img/stripe.png" alt="Credit Card Icon" style="max-width: 3.3rem;">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <!-- Payment Section -->
                                                <div class="mt-4 mb-4">
                                                    <div class="row ">
                                                        <div class="col-12">
                                                            <img src="<?php echo $base . "img/credit-card.png"?>" alt="Credit Card Icon" style="max-width: 5.3rem;">
                        
                                                        </div>
                                                    </div>

                                                    <!-- Amount input -->
                                                     <div class="mb-3">
                                                        <label for="amount" class="form-label">Amount</label>
                                                        <input type="text" class="form-control" id="amount" placeholder="€460.00" readonly required>
                                                    </div>
                                                     <!-- Credit card input -->
                                                    <div class="mb-3">
                                                        <label for="card-number" class="form-label">Credit Card Number</label>
                                                        <input type="text" class="form-control" id="card-number" placeholder="1234 5678 9012 3456" maxlength="19" required>
                                                    </div>
                                                    <!-- Expiration date and CVV inputs -->
                                                    <div class="row mb-4">
                                                        <!-- Expiration date input -->
                                                        <div class="col-md-6">
                                                            <label for="exp-date" class="form-label">Expiration Date</label>
                                                            <input type="text" class="form-control" id="exp-date" placeholder="MM/YY" maxlength="5" required>
                                                        </div>
                                                        <!-- CVV input -->
                                                        <div class="col-md-6">
                                                            <label for="cvv" class="form-label">CVV</label>
                                                            <input type="text" class="form-control" id="cvv" placeholder="123" maxlength="3" required>
                                                        </div>
                                                    </div>

                                                    <div class="mb-4 text-center">
                                                        <div>
                                                            <button type="button" class="btn btn-primary " style="background-color: black; border: none; width: 40%;">Pay</button>
                                                        </div>
                    
                                                    </div>
                
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        

                    </div>
            
                    
                </div>
            </div>
<!-- Checkout Container End -->





            <!-- Add more product containers for other products similarly -->
        </div>
            <div class="col-lg-4 mb-5" style="margin-top: 35px;"> <!-- Add margin-top here -->
               
                
                    <div class="mt-4 mb-4">

                            <!-- Review Items Section -->
                        <div class="bg-light px-1 py-4 mb-4 ">

                            <h5>Review Items and Shipping</h5>
                        
                        </div>
                        
                        <div class="item-list">

                            <!-- Shipping Information -->
                            <div class="shipping-info row border-bottom mb-2">
                                <span class="shipping-label col-12"><b>Address:</b><br>Thomond Village, Old Cratloe Road, Limerick, V94NN6E</span>
                                
                                
                            </div>
                
                            <!-- List of items in the order -->
                            <div class="item row border-bottom mb-2">
                                <span class="product-name col-6"><b>Product:</b><br> Acoustic inst Guitar</span>
                                <span class="quantity col-2"><b>QTY:</b><br> x2</span>
                                <span class="subtotal col-4 "><b>Subtotal:</b><br> €450.00</span>
                            </div>
                            <!-- Add more items here -->
                
                            <!-- ShippingCost -->
                            <div class="subtotal-row row border-bottom mb-2">
                                <span class="total-label col-8 font-weight-bold">Shipping Cost:</span>
                                <span class="total-amount col-4">€10.00</span>
                                
                            </div>
                
                        
                            <!-- Order Total -->
                            <div class="order-total row">
                                <span class="total-label col-8 font-weight-bold">Total:</span>
                                <span class="total-amount col-4">€460.00</span>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <!-- Cart End -->



            
            
            
            
            
                 
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