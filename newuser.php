<?php
   
    // Database connection
    include('config.php');

    if($_SESSION['role'] != 'admin'){
        header("Location: dashboard.php");
    }
    // Error & success messages
    global $success_msg, $email_exist, $f_NameErr, $l_NameErr, $_emailErr, $_mobileErr, $_passwordErr, $_repasswordErr;

    global $fNameEmptyErr, $lNameEmptyErr, $emailEmptyErr, $mobileEmptyErr, $passwordEmptyErr, $repasswordEmptyErr,$email_verify_err, $email_verify_success;
    
    // Set empty form vars for validation mapping
    $_first_name = $_last_name = $_email = $_phone_number = $_password = $_repassword = $_address = $_address2 = $_city = $_state = $_zipcode = "";

    if(isset($_POST["addnew"])) {
        $firstname     = $_POST["firstname"];
        $lastname      = $_POST["lastname"];
        $email         = $_POST["email"];
        $role      = $_POST["role"];  
        $mobilenumber  = $_POST["mobilenumber"];
        $password      = $_POST["password"];
        $repassword      = $_POST["repassword"];
        $address      = $_POST["address"];
        $address2      = $_POST["address2"];
        $city           = $_POST["city"];
        $state      = $_POST["state"];
        $zipcode      = $_POST["zipcode"];

        // check if email already exist
        $email_check_query = mysqli_query($connection, "SELECT * FROM persons WHERE email = '{$email}' ");
        $rowCount = mysqli_num_rows($email_check_query);


        // PHP validation
        // Verify if form values are not empty
        if(!empty($firstname) && !empty($lastname) && !empty($email) && !empty($mobilenumber) && !empty($password) && !empty($repassword) && !empty($address) && !empty($address2) && !empty($city) && !empty($state) && !empty($zipcode)){
            
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
                $_password = mysqli_real_escape_string($connection, $password);
                 $_repassword = mysqli_real_escape_string($connection, $repassword);

                // perform validation
                if(!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                    $_emailErr = '<div class="alert alert-danger">
                            Email format is invalid.
                        </div>';
                }
               
                if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{16,20}$/", $_password)) {
                    $_passwordErr = '<div class="alert alert-danger">
                             Password should be between 16 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                        </div>';
                }
                
                if(!$_password == $_repassword){
                    $_repasswordErr = '<div class="alert alert-danger">
                             Password does not match.
                        </div>';
                }
                
                // Store the data in db, if all the preg_match condition met
                if( 
                 (filter_var($_email, FILTER_VALIDATE_EMAIL)) && 
                 (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $_password)) && ($_password == $_repassword)){

                    // Generate random salt
                    
                    //This string tells crypt to use blowfish for 5 rounds.
                    $Blowfish_Pre = '$2a$05$';
                    $Blowfish_End = '$';
                $Allowed_Chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789./';
                    $Chars_Len = 63;
                    $Salt_Length = 21;
                    $salt = '';
                    
                    for ($i=0; $i<$Salt_Length; $i++)
                        {
                        $salt .= $Allowed_Chars[mt_rand(0,$Chars_Len)];
                        }

                    $bcrypt_salt = $Blowfish_Pre . $salt . $Blowfish_End;
                    // Password hash
                    $password_hash = crypt($password, $bcrypt_salt);

                    // Query
                    $sql = "INSERT INTO persons (role,fname, lname, email, phone, password_hash, password_salt, address, address2, city, state, zip_code) VALUES ('{$role}', '{$firstname}', '{$lastname}', '{$email}', '{$mobilenumber}', '{$password_hash}', '{$bcrypt_salt}','{$address}', '{$address2}', '{$city}','{$state}','{$zipcode}')";
                    
                    // Create mysql query
                    $sqlQuery = mysqli_query($connection, $sql);
                    
                    if(!$sqlQuery){
                        die("MySQL query failed!" . mysqli_error($connection));
                    } 

                    // Send verification email
                    if($sqlQuery) {
                        $success_msg = 'New User Successfully Registered.';
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
    }
?>