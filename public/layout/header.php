<?php
//unset($_SESSION['items']);
if (!isset($_SESSION['items'])) {
    $_SESSION['items'] = [];
}

$articleItemCount = count($_SESSION['items']);

$articleTotalSum = 0;
count($_SESSION['items']);

foreach ($_SESSION['items'] as $articleId => $articleItem) {
    $articleTotalSum += $articleItem['price'] * $articleItem['quantity'];
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a97da01e51.js" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title><?=$pageTitle ?></title>
</head>

<body id="<?=$pageId ?>">
    <div class="container-fluid p-0">
        <!-- Log in/ Log out -->
        <div class="header">
            <div id="logo">
                <img class="logo" src="img/babysme_logo.png" alt="logo">
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
            <div class="d-flex justify-content-end mr-2">
                <a href="products.php" data-toggle="dropdown" role="button" aria-expanded="false">
                    <button type="button" class="btn dropdown-toggle cartBtn" data-toggle="dropdown-toggle">
                        <span class="fa fa-gift big">View Cart</span>
                        <span class="badge badge-pill badge-danger"><?= $articleItemCount ?></span>
                    </button>
                </a>

                <!-- Dropdown Menu -->
                <div class="dropdown-menu">
                    <div class="d-flex flex-column">
                        <div class="col">
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </div>

                        <div class="col total-section text-left">
                            <?php foreach ($_SESSION['items'] as $articleId => $articleItem) { ?>
                                <div class="row cart-detail">
                                    <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                                        <img src="admin/<?= $articleItem['img_url'] ?>" style="width:50px;height:auto;">
                                    </div>
                                    <div class="col">
                                        <?= $articleItem['title'] ?>
                                    </div>
                                    <div class="col">
                                        Antal:<?= $articleItem['quantity'] ?>
                                    </div>
                                </div>
                            <?php } ?>
                            <span class="count">Total: <?= $articleTotalSum ?>kr</span>
                            <form action="checkout.php" method="POST">
                                <input type="submit" name="" value="Checkout" class="btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>