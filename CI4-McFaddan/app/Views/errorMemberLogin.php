<?php


    helper(['url']);

$base = base_url() ;

$controller_base = $base."index.php/";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Login</title>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>McFaddan Error Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap">
    <style>
        /*======================
           McFaddan Error Login Page
        =======================*/

        body {
            font-family: 'Montserrat', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #fbfbfb; /* Set your desired background color here */
        }

        .page-not-found {
            padding: 40px 0;
            background: #fbfbfb;
            font-family: 'Arvo', serif;
            text-align: center;
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
        background-size: contain; /* Adjust this property */
        background-repeat: no-repeat;
    }
        .not-found-bg h1,
        .not-found-bg h3 {
            font-size: 80px;
            color: #fff;
            margin: 0;
        }

        .not-found-content {
            margin-top: -50px;
            color: #333;
        }

        .not-found-heading {
            font-size: 36px;
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
    <section class="page-not-found">
        <div class="container">
            <div class="row">   
                <div class="col-sm-12">
                    <div class="col-sm-10 col-sm-offset-1 text-center">
                        <div class="not-found-bg">
                            <h1 style="color:#ce1c01">McFaddan</h1>
                        </div>

                        <div class="not-found-content">
                            <h3 class="not-found-heading">
                                Hey There,
                            </h3>

                            <p>Please create an account or login to access this page!</p>

                            <a href="<?= base_url('memberlogin') ?>" class="not-found-link">Go to Login</a>

                            <a href="<?= base_url('portal') ?>" class="not-found-link">Create an account</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
