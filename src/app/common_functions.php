<?php
    function checkLoginSession() {
        if (!isset($_SESSION['username'])) {
            redirect("login.php?mustLogin");
        }
    }
  
    function redirect($path) {
        header("Location: {$path}");
        exit;
    }

    function debug($value) {
        echo "<pre>";
        print_r($value);
        echo "</pre>";
    }

    

   
    