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
    }
   

    $users = $userDbHandler->fetchAllUsers();
 
?>
<?php include('layout/header.php'); ?>

    <!-- Sidans/Dokumentets huvudsakliga innehåll -->
    <div id="content">

        <article class="border">
            <h1>Manage users</h1>

         <?=$message ?> 

            <form action="create-user.php" method="GET">
            	<input type="submit" value="New user">
            </form>

            <br>
            
            <table calss="table">
            	<thead>
	            	<tr>
	            		<th>Id</th>
	            		<th>First name</th>
                        <th>Last name</th>
	            		<th>E-mail</th>
	            		<th>Date</th>
	            		<th>Manage</th>
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
                            <td>
                                <form action="update-user.php" method="GET">
                                    <input type="hidden" name="userId" value="<?=htmlentities($user['id']) ?>">
                                    <input type="submit" value="update">
                                </form>

                                <form action="" method="POST">
                                    <input type="hidden" name="userId" value="<?=htmlentities($user['id']) ?>">
                                    <input type="submit" name="deleteUserBtn" value="delete">
                                </form>
                            </td>
                        
                        </tr>
                    <?php endforeach; ?>
            	</tbody>
            </table>           

        </article>
   
    
    </div>

 <?php include('layout/footer.php'); ?> 