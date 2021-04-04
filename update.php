<?php
   
    // Database connection
    include('config.php');

    $edit_id = $_GET['id'];

    if($_SESSION['role'] == 'user' && $_SESSION['id'] != $edit_id){
        header("Location: dashboard.php");
    }
    // Error & success messages
    global $success_msg, $email_exist, $f_NameErr, $l_NameErr, $_emailErr, $_mobileErr, $_passwordErr, $_repasswordErr;

    global $fNameEmptyErr, $lNameEmptyErr, $emailEmptyErr, $mobileEmptyErr, $passwordEmptyErr, $repasswordEmptyErr,$email_verify_err, $email_verify_success;
    
    // Set empty form vars for validation mapping
    $_first_name = $_last_name = $_email = $_phone_number = $_password = $_repassword = $_address = $_address2 = $_city = $_state = $_zipcode = "";


    $get_user_query =  mysqli_query($connection, "SELECT * FROM persons WHERE id = '{$edit_id}'");
    $result = mysqli_fetch_array($get_user_query);
        $id     = $result["id"];
        $firstname     = $result["fname"];
        $lastname      = $result["lname"];
        $role      = $result["role"];      
        $email         = $result["email"];
        $mobilenumber  = $result["phone"];
        $address      = $result["address"];
        $address2      = $result["address2"];
        $city           = $result["city"];
        $state      = $result["state"];
        $zipcode      = $result["zip_code"];
    
    

    if(isset($_POST["update"])) {
        $firstname     = $_POST["firstname"];
        $lastname      = $_POST["lastname"];
        $email         = $_POST["email"];
        $mobilenumber  = $_POST["mobilenumber"];
        $address      = $_POST["address"];
        $role      = $_POST["role"];      
        $address2      = $_POST["address2"];
        $city           = $_POST["city"];
        $state      = $_POST["state"];
        $zipcode      = $_POST["zipcode"];

        // check if email already exist
        $email_check_query = mysqli_query($connection, "SELECT * FROM persons WHERE email = '{$email}' AND id <> '{$id}' ");
        $rowCount = mysqli_num_rows($email_check_query);


        // PHP validation
        // Verify if form values are not empty
        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($mobilenumber) && !empty($address) && !empty($address2) && !empty($city) && !empty($state) && !empty($zipcode)){
            
            // check if user email already exist
            if($rowCount > 0) {
                $email_exist = '
                    <div class="alert alert-danger" role="alert">
                        User with email already exist!
                    </div>
                ';
            } else {
                // clean the form data before sending to database
                $_first_name = mysqli_real_escape_string($connection, $firstname);
                $_last_name = mysqli_real_escape_string($connection, $lastname);
                $_email = mysqli_real_escape_string($connection, $email);
                $_mobile_number = mysqli_real_escape_string($connection, $mobilenumber);
                

                // perform validation
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="alert alert-danger">
                            Email format is invalid.
                        </div>';
                }
               
                
                
                
                    // Query
                    $sql = "UPDATE persons SET fname = '$firstname',lname = '$lastname', email = '$email', role='$role', phone = '$mobilenumber', address = '$address', address2 = '$address2', city = '$city', state = '$state', zip_code = '$zipcode'   WHERE id = '{$id}'";
                    
                    // Create mysql query
                    $sqlQuery = mysqli_query($connection, $sql);
                    
                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($connection));
                    } 

                    // Send verification email
                    if($sqlQuery) {
                        $success_msg = 'Successfully Updated.';
                        header("Location: dashboard.php");
                    }
                }
            }
        } else {
            if(empty($firstname)){
                $fNameEmptyErr = '<div class="alert alert-danger">
                    First name can not be blank.
                </div>';
            }
            if(empty($lastname)){
                $lNameEmptyErr = '<div class="alert alert-danger">
                    Last name can not be blank.
                </div>';
            }
            if(empty($email)){
                $emailEmptyErr = '<div class="alert alert-danger">
                    Email can not be blank.
                </div>';
            }
            if(empty($mobilenumber)){
                $mobileEmptyErr = '<div class="alert alert-danger">
                    Mobile number can not be blank.
                </div>';
            }
            if(empty($password)){
                $passwordEmptyErr = '<div class="alert alert-danger">
                    Password can not be blank.
                </div>';
            }
            if(empty($repassword)){
                $repasswordEmptyErr = '<div class="alert alert-danger">
                    Password can not be blank.
                </div>';
            } 
        }
    
?>