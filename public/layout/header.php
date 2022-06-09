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
	
    <title><?=$pageTitle ?></title>
</head>
<body id="<?=$pageId ?>">
      
	<div class="container-fluid p-0">
		<!-- Log in/ Log out -->
		<div class="d-flex justify-content-end bg-transparent">
			<div class="d-flex justify-content-end">
			
        	
			
			<?php
				if (isset($_SESSION['username'])) {
					
				// ucfirst makes the first letter to a CAPITAL letter :)
				$loggedInUsername = htmlentities(ucfirst($_SESSION['username']));
				$loggedInUserId = htmlentities($_SESSION['id']);
				$aboveNave = "<span class='logInBtn'><b>Hi {$loggedInUsername}</b></span>
				<a id='mypages' class='logInBtn' href='my-pages.php?userId=$loggedInUserId'>My pages</a>
				<a href='logout.php' class='logInBtn' >Log out</a>";
				} else {
				$aboveNave = "<a href='register.php' class='logInBtn'>Sin up</a> 
				 <a href='login.php' class='logInBtn'>Log in</a>";
				}

				echo $aboveNave;
				
        	?>
			<a id="dashboard"  class="logInBtn" href="admin/index.php">Dashboard</a>
		</div>			  
	</div>
	<!-- <form action="my-pages.php?" method="GET">
					<input type="hidden" name="id" value="">
					<input type="submit" value="My page" class="btn logInBtn">
				</form>

				<form action="admin/admin.php?">
					<input type="submit" value="Admin" class="btn logInBtn">
				</form>
			</div> -->
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
						<span class="fa fa-gift bigicon">View Cart</span>
						<span class="badge badge-pill badge-danger"></span>
					</button>
				</a>
				
				<!-- Dropdown Menu -->
				<div class="dropdown-menu">
					<div class="d-flex flex-column">
						<div class="col">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i>
						</div>

						<div class="col total-section text-left">
							
								<div class="row cart-detail">
									<div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
										<img src="admin/" style="width:50px;height:auto;">
									</div>
									<div class="col">									
									</div>
									<div class="col">
										Antal: 
									</div>
								</div>							
							<span class="count">Total:kr</span>
							<form action="checkout.php" method="POST">
								<input type="submit" name="" value="Checkout" class="btn btn-primary">
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>