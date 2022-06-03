<?php
// Turn on/off error reporting
error_reporting(-1);

// Start session
session_start();

define('ROOT_PATH', '..' . __DIR__ . '/'); // path to 'ecommerce-template/'
define('SRC_PATH',  __DIR__ . '/'); // path to 'ecommerce-template/src/'


// Examine the dynamic paths
// print_r(ROOT_PATH);
// print_r(SRC_PATH);
// print_r(__DIR__);


// Include functions and classes
require(SRC_PATH . '/dbconnect.php');
require(SRC_PATH . '/app/common_functions.php');

require(SRC_PATH . '/app/UserDbHandler.php');
$userDbHandler = new UserDbHandler($pdo);

require(SRC_PATH . '/app/ProductDbHandler.php');
$productDbHandler = new ProductDbHandler($pdo);