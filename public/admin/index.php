<?php
      require('../../src/config.php');
    $pageTitle = "Users";
    $pageId    = "users";
    // checkLoginSession();
echo "<pre>";
  print_r($_GET);
  echo "</pre>";
  echo "<pre>";
  print_r($_POST);
  echo "</pre>";
   
?>
<?php include('layout/header.php'); ?>
	<h1>Admin page</h1>
	<ul>
		<li><a href="users.php">Users</a> </li>
	</ul>
  <?php include('layout/footer.php'); ?>

