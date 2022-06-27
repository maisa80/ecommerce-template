<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a97da01e51.js" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title><?= $pageTitle ?></title>
</head>

<body id="<?= $pageId ?>">

    <div class="container-fluid p-0 m-0">
        <div class="header">
            <div id="logo">
                <a href="../public/index.php">
                    <img class="logo" src="img/babysme_logo.png" alt="logo">
                </a>
            </div>
            
                    
                
            <div id="topmenu">
                <?php
                if (isset($_SESSION['username'])) {
                    // ucfirst makes the first letter to a CAPITAL letter :)
                    $loggedInUsername = htmlentities(ucfirst($_SESSION['username']));
                    $loggedInUserId = htmlentities($_SESSION['id']);
                    $aboveNave = "<span class='logInBtn'><b>Hi {$loggedInUsername}</b></span>
						<a id='mypages' class='logInBtn' href='my-pages.php?userId=$loggedInUserId'><i class='fas fa-user-alt'></i> My account</a>
						<a href='logout.php' class='logInBtn' ><i class='fas fa-sign-out-alt'></i> Log out</a>";
                } else {
                    $aboveNave = "<a href='register.php' class='logInBtn'><i class='fas fa-user'></i> Sign up</a> 
						<a href='login.php' class='logInBtn'><i class='fas fa-sign-in-alt'></i> Log in</a>";
                }
                echo $aboveNave;
                ?>
            </div>
        </div>

   

    <!-- Navbar -->
    <div class="d-flex justify-content-center text-center bg-transparent pb-4">
        <div class="col">
            <form action="index.php?">
                <input type="submit" value="Home" class="btn navBtn">
            </form>
        </div>
        <div class="col">
            <form action="products.php?">
                <input type="submit" value="Products" class="btn navBtn">
            </form>
        </div>
        <div class="col">
            <form action="contact.php?">
                <input type="submit" value="Contact" class="btn navBtn">
            </form>
        </div>    
    <div class="cart-col">
        <?php include('cart.php') ?>
    </div>
    </div>
    
