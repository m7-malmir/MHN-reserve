<?php
session_start();

if (isset($_POST['getID'])){
     $delete_users=$_POST['getID'] ?? '';
    foreach ($_SESSION['users'] as $key => $val ) {
        var_dump($key.' => '. $val);
        if(in_array($val, $delete_users)){  
            unset($_SESSION['users'][$key]);
        }
    }
    header("Refresh:0");
    exit;
}




