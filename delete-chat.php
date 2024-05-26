<?php
session_start();
//session_destroy();
print_r($_SESSION['users']);
if (isset($_POST['getID'])){
    $delete_users=$_POST['getID'] ?? '';

    foreach ($delete_users as $key => $val ) {
        //print_r($key);
        if(in_array("$val", $_SESSION['users'])){
            //echo 'ok';
            echo $key;
            unset($_SESSION['users'][$key]);
        }
    }

}




