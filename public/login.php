<?php
    require('../src/config.php');
    require('../src/dbconnect.php');

    $msg = "";
    if (isset($_GET['mustLogin'])) {
        $msg = '<div class="alert alert-danger" role="alert">Error! You need to log in to view this page. Please log in och sign up.</div>';
    }

    if (isset($_GET['logout'])) {
        $msg = '<div class="alert alert-success" role="alert">You have logged out!</div>';
    }

    if (isset($_POST['doLogin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user =($username);

        if ($user && $password === $user['password']) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            redirect('index.php');

        } else {
            $msg = '<div class="alert alert-danger" role="alert">Fel inloggningsuppgifter. Var snäll och försök igen.</div>';
        }
    }
?>

<?php include('layout/header.php'); ?>

    <div class="d-flex justify-content-center mt-5">
        <?=$msg?>
    </div>

    <div class="d-flex justify-content-center mt-5">
        <table class="table-light card p-5 rounded border-0 shadow">
            <form method="POST">
                <tr>
                    <td>
                        <label for="input1">Username:</label> <br>
                        <input type="text" class="text" name="username">
                    </td>
                </tr>

                <tr>
                    <td>
                        <label for="input2">Password:</label> <br>
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