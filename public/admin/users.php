<?php

require('../../src/config.php');
    $pageTitle = "users";
    $pageId    = "users";
    // checkLoginSession();
   


    $message = "";
    if (isset($_GET['invalidUser'])) {
        $message = '
            <div class="error_msg">
               User är invalid
            </div>
        ';
    }
    
    if (isset($_POST['deleteUserBtn'])) {
        $userDbHandler->deleteUser();
         // Success message
      $message = '   
      <div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        <i class="bi-check-circle-fill"></i>
        <strong class="mx-2">Success!</strong> The user was successfully deleted.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    ';
    }
   

    $users = $userDbHandler->fetchAllUsers();
   
?>
<?php include('layout/header.php'); ?>

    <!-- Sidans/Dokumentets huvudsakliga innehåll -->
    <div id="content">

        <h4>Manage users</h4>


        <div id="user">
            <form action="create-user.php" method="GET">
           <button type="submit" class="btn btn-warning"><i class="fas fa-plus"></i> Add new user</button> 
            </form>
        </div>
            <br>
            <?=$message ?>
            <table class="table ">
            	<thead>
	            	<tr>
	            		<th>Id</th>
                        <th>User name</th>
	            		<th>First name</th>
                        <th>Last name</th>
	            		<th>E-mail</th>
	            		<th>Date</th>
	            		<th class="manage">Manage</th>
	            	</tr>
            	</thead>
            	<tbody>
                    <?php foreach($users as $user) : ?>
                        <tr>
                            <td><?=htmlentities($user['id']) ?></td>
                            <td><?=htmlentities($user['username']) ?></td>
                            <td><?=htmlentities($user['first_name']) ?></td>
                            <td><?=htmlentities($user['last_name']) ?></td>
                            <td><?=htmlentities($user['email']) ?></td>
                            <td><?=htmlentities($user['create_date']) ?></td>
                            <td class="manage">
                                <form action="update-user.php" method="GET">
                                    <input type="hidden" name="userId" value="<?=htmlentities($user['id']) ?>">
                                    <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                                </form>

                                <form action="" method="POST">
                                    <input type="hidden" name="userId" value="<?=htmlentities($user['id']) ?>">
                                    <button type="submit" name="deleteUserBtn" class="btn btn-danger"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        
                        </tr>
                    <?php endforeach; ?>
            	</tbody>
            </table>          
     
    </div>
   
 <?php include('layout/footer.php'); ?> 