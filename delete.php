<?php
   
    // Database connection
    include('config.php');

global $success_msg;
    $delete_id = $_GET['id'];
    if($_SESSION['role'] != 'admin'){
        header("Location: dashboard.php");
    }
else{
    

    // Error & success messages
    

    
    if($delete_id == $_SESSION['id']){
         $success_msg = 'You Cannot Delete your self.';
             header("Location: dashboard.php");
    }
    else{

    if (mysqli_query($connection, "DELETE FROM persons WHERE id = '{$delete_id}'") ) {
         $success_msg = 'Successfully Deleted.';
                        header("Location: dashboard.php");
    }
    
    
    }
        }

?>