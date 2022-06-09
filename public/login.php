<?php
    require('../src/config.php');
    $pageTitle= 'Login';
    $pageId = 'login';
    $message = "";
    if (isset($_GET['mustLogin'])) {
        $message = '<div class="alert alert-danger" role="alert">Error! You need to log in to view this page. Please log in och sign up.</div>';
    }

    if (isset($_GET['logout'])) {
        $message = '<div class="alert alert-success" role="alert">You have logged out!</div>';
    }

    if (isset($_POST['doLogin'])) {
        $email    = trim($_POST['email']);
        $password = $_POST['password'];

        $user = $userDbHandler->fetchUserByEmail($email);
    


        // Tom array => false
        // Icke tim array => true
        if ($user && password_verify($password, $user['password'])) { // password_verify($password, $encryptedPassword);
            // User exists
            $_SESSION['username'] = $user['username'];
            $_SESSION['id']       = $user['id'];
            redirect('index.php');
        } else {
            $message = '
                <div class="error_msg">
                    Fel inloggningsuppgifter. Försök igen!
                </div>
            ';
        }


    }
?>


<?php include('layout/header.php'); ?>

    <div class="d-flex justify-content-center mt-5">
    <?=$message ?>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <table class="table-light card p-5 rounded border-0 shadow">
            <form method="POST">
                <tr>
                    <td>
                        <label for="input1">Email</label> <br>
                        <input type="text" class="text" name="email">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="input2">Password</label> <br>
                        <input type="password" class="text" name="password">
                    </td>
                </tr>
                <td>
                    <input type="submit" name="doLogin" value="Log in" class="btn btn-dark text-light mt-4 mx-auto d-block">
                </td>
            </form>
        </table>
    </div>

<?php include('layout/footer.php'); ?>