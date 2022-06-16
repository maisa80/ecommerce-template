<?php
    require('../src/config.php');

    echo "<pre>";
    print_r($_POST);
    echo "</pre>";

    if (!empty($_POST['articleId'])
        && !empty($_POST['stock'])
        && isset($_SESSION['items'][$_POST['articleId']])
    ) {
        $_SESSION['items'][$_POST['articleId']]['stock'] = $_POST['stock'];
    }

    header('Location: checkout.php');
    exit;
