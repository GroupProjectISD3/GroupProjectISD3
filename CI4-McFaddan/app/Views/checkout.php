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

<script src="https://js.stripe.com/v3/"></script>
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!--Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

<style>
    #card-element {
        width: 100%;
    }

    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
    }
</style>
    
    
</head>

<body>

<?php


	helper(['url']);

$base = base_url();

$controller_base = $base."checkout.php/";

$orderID = $_SESSION['orderID'];
$total = $_SESSION['total'];

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
                       <a href="<?= base_url('index') ?>"class="nav-item nav-link">Home</a>
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
                            <?php if (!empty($address)) : ?>
                            <h5 class="mb-3">Shipping Address</h5>
                            <form>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address 1" value="<?= $address['address1'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address 2" value="<?= $address['address2'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Address 3" value="<?= $address['address3'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="City" value="<?= $address['city'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="County" value="<?= $address['county'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Eircode" value="<?= $address['eircode'] ?>" disabled>
                                </div>

                                <div style="margin-left: 35%;">
                                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#popupMcForm" style="background-color: black; border: none;">Pay Now</button>
                                </div>  

                            </form>
                            <?php else : ?>
                                <a href="<?= base_url('MemberController/account_details')?>"><p>Create an address in your profile to checkout.</p></a>
                            <?php endif; ?>

                        </div>
                        
            
                        

                            <div class="mb-3 text-center">                          

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
                                                        <input type="text" class="form-control" id="amount" placeholder="€<?php echo $_SESSION['total']; ?>" readonly required>
                                                    </div>
                                                     <!-- Credit card input -->
                                                    <form action="/GroupProjectISD3/CI4-McFaddan/public/MemberController/processPayment" method="POST" id="payment-form">
                                                        <!-- Hidden fields for the total and other values -->
                                                        <input type="hidden" name="total" value="<?php echo $_SESSION['total']; ?>">
                                                        <input type="hidden" name="orderID" value="<?php echo $_SESSION['orderID']; ?>">
                                                        <!-- Add this inside your form -->
                                                        <input type="hidden" id="stripeToken" name="stripeToken">

                                                        <div class="form-row" style="width: 100%;">
                                                            <label style="width:100%;" for="card-element">
                                                                Credit Card Number
                                                                <div id="card-element" class="form-control stripe-card-number"></div>
                                                            </label>
                                                        </div>

                                                        <div class="mb-4 text-center">
                                                            <div>
                                                                <button type="submit" class="btn btn-primary " style="background-color: black; border: none; width: 40%;">Pay</button>
                                                            </div>
                                                        </div>
                                                    </form>

                
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
                        
                            <!-- Order Total -->
                            <div class="order-total row">
                                <span class="total-label col-8 font-weight-bold">Shipping:</span>
                                <span class="total-amount col-4">Free</span>
                            </div>
                            <div class="order-total row">
                                <span class="total-label col-8 font-weight-bold">Total:</span>
                                <span class="total-amount col-4">€<?php echo $_SESSION['total']; ?></span>
                            </div>
                        </div>
                    </div>
                
            </div>
        </div>
    </div>
    <!-- Cart End -->



            
            
            
            
<script>
    var stripe = Stripe('pk_test_51OHqKsDJTbFTfK1en8Cq6I40zECzKgvvARPFyRqGvylC40pjpbuLZV5w4CURqlVxLgDopm0vjCyNm3KdqmC09H9J00UxWpiThH');
    var elements = stripe.elements();

    var style = {
            base: {
        fontSize: '16px',
        color: '#32325d',
        '::placeholder': {
            color: '#aab7c4'
        }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    var card = elements.create('card', {style: style});
    card.mount('#card-element');  // Changed from '#card-number' to '#card-element'

    card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
    });

    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
                var errorElement = document.getElementById('card-errors');
                errorElement.textContent = result.error.message;
            } else {
                stripeTokenHandler(result.token);
            }
        });
    });

    function stripeTokenHandler(token) {
        console.log("Stripe Token ID: " + token.id);

        var form = document.getElementById('payment-form');
        var hiddenInput = document.getElementById('stripeToken');

        hiddenInput.value = token.id;

        form.submit();
    }
</script>


            
                 
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
                    <a class="text-dark mb-2"  <a href="#">
                        <i class="fas fa-guitar fa-fw mr-2"></i>Acoustics
                    </a>
                    <a class="text-dark mb-2"<a href="#">
                        <i class="fas fa-plug fa-fw mr-2"></i>Eletrics
                    </a>
                    <a class="text-dark mb-2" <a href="#">
                        <i class="fas fa-drum fa-fw mr-2"></i>Drums
                    </a>
                    <a class="text-dark mb-2" <a href="#">
                        <i class="fas fa-keyboard fa-fw mr-2"></i>Keyboards
                    </a>
                    <a class="text-dark mb-2" <a href="#">
                        <i class="fas fa-headphones fa-fw mr-2"></i>Accessories
                    </a>
                    <a class="text-dark mb-2" <a href="#">
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