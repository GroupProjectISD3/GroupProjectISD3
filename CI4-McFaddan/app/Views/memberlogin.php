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

$base = base_url() .  "/";

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
    
    <!-- New User Registration Section -->
    <!-- Check if there is an error flash data -->
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger">
            <?php echo session('error'); ?>
        </div>
    <?php endif; ?>
    <section class="container mt-5">
    <h2>Login</h2>
    <?php echo form_open('LoginController/authenticate'); ?>
        
        <div class="form-group">
            <label for="email">Email/Username</label>
            <input type="text" class="form-control" id="email" value="<?php echo set_value('emailOrUsername'); ?>" name="emailOrUsername" placeholder="Enter your email or username" >
            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('emailOrUsername'); }?></label>
        </div>
        
    
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" value="<?php echo set_value('password'); ?>" name="password" placeholder="Enter password">
            <label style="color: red;"><?php if (isset($validation)) { echo $validation->getError('password'); }?></label>
        </div>
        
        
        <button type="submit" name="login" class="btn btn-primary" style="display: block; margin-left: auto; margin-right: auto; width: 20%;">Login</button>

        <!--Add a registration anchor here-->
        <a href="<?= base_url('portal') ?>" style="display: block; text-align: center; color: black; text-decoration: underline; margin-top:3%;">Don't have an account? Register Here</a>
    </form>
</section>        
            
    
   
            
            
            
        
           


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