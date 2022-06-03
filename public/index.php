<?php
    require('../src/config.php');
    require('../src/dbconnect.php');
?>

<?php include('layout/header.php'); ?>

	<div class="container-fluid indexPage">
		<div class="d-flex flex-column justify-content-center logoContainer">
			<img class="logo" src="img/babysme_logo.png" alt="" style="width: 65vh;">
			<button class="btn shopBtn align-self-center" style="width:10em;"><a class="indexBtn" href="products.php">Shop now</a></button>
		</div>
	</div>

<?php include('layout/footer.php'); ?>