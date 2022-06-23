<?php
require('../src/config.php');
$pageTitle = 'Login';
$pageId = 'login';
$message = "";
if (isset($_GET['mustLogin'])) {
    $message = '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
        <i class="bi-check-circle-fill"></i>
        Error! You need to log in to view this page. Please log in och sign up.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
}

if (isset($_GET['logout'])) {
    $message = '<div class="alert alert-success alert-dismissible d-flex align-items-center fade show">
        <i class="bi-check-circle-fill"></i>
        You have logged out!
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>';
}

if (isset($_POST['doLogin'])) {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $user = $userDbHandler->fetchUserByEmail($email);

    // Check if user exists
    // If user does not exist, show error message
    if ($user && password_verify($password, $user['password'])) { // password_verify($password, $encryptedPassword);
        // User exists
        $_SESSION['username'] = $user['username'];
        $_SESSION['id']       = $user['id'];
        redirect('index.php');
    } else {
        $message = '<div class="alert alert-danger alert-dismissible d-flex align-items-center fade show">
            <i class="bi-check-circle-fill"></i>
            Unvalid e-mail OR password. Please try again!
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>';
    }
}
?>


<?php include('layout/header.php'); ?>
<div class="container">
    <div class="d-flex justify-content-center mt-5">
        <?= $message ?>
    </div>
    <h2 class="text-center">Log in</h2>
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
                    <input type="submit" name="doLogin" value="Log in"
                        class="btn btn-dark text-light mt-4 mx-auto d-block">
                </td>
            </form>
        </table>
    </div>
</div>
<?php include('layout/footer.php'); ?>