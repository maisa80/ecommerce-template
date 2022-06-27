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
    <div class="grid-container">
        <div class="menu-icon">
            <i class="fas fa-bars header__menu"></i>
        </div>

        <header class="header">


            <div id="logo">
                <a href="../index.php">
                    <img class="logo" src="img/babysme_logo.png" alt="logo">
                </a>
            </div>





            <!-- Navbar -->
            <div class="d-flex justify-content-center text-center bg-transparent pb-4">
                <div class="col">
                    <form action="../index.php?">
                        <input type="submit" value="Home" class="btn navBtn">
                    </form>
                </div>
                <div class="col">
                    <form action="../products.php?">
                        <input type="submit" value="Products" class="btn navBtn">
                    </form>
                </div>
                <div class="col">
                    <form action="../contact.php?">
                        <input type="submit" value="Contact" class="btn navBtn">
                    </form>
                </div>

            </div>

        </header>

        <aside class="sidenav">
            <div class="sidenav__close-icon">
                <i class="fas fa-times sidenav__brand-close"></i>
            </div>

            <ul class="sidenav__list">
                <li class="sidenav__list-item"><a href="index.php"><i class="fas fa-gamepad"></i> Dashboard</a></li>
                <li class="sidenav__list-item"><a href="users.php"><i class="fas fa-users"></i> Users</a></li>
                <li class="sidenav__list-item"><a href="products.php"><i class="fas fa-baby"></i> Products</a></li>
                <li class="sidenav__list-item"><a href="orders.php"><i class="fas fa-cart-arrow-down"></i> Orders</a>
                </li>

            </ul>
        </aside>