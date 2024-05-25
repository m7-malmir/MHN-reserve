<?php
if (isset($_POST['getID'])){
    $delete_users=$_POST['getID'] ?? '';
   // print_r($_SESSION['users']);
    print_r($delete_users);
    // foreach ($delete_users as $key ) {
    
    //     if(in_array("$key", $_SESSION['users'])){
    //         unset($_SESSION['variable_name'][$key]);
    //     }

    // }

}




