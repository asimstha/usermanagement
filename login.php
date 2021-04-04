<?php
    // Database connection
    include('config.php');

    if(isset($_SESSION['id'])){
        header("Location: dashboard.php");
    }

    global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $verificationRequiredErr, $email_empty_err, $pass_empty_err;

    if(isset($_POST['login'])) {
        $email_signin        = $_POST['email_signin'];
        $password_signin     = $_POST['password_signin'];

        // clean data 
        $user_email = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
        $pswd = mysqli_real_escape_string($connection, $password_signin);

        // Query if email exists in db
        $sql = "SELECT * From persons WHERE email = '{$email_signin}' ";
        $query = mysqli_query($connection, $sql);
        $rowCount = mysqli_num_rows($query);

        // If query fails, show the reason 
        if(!$query){
           die("SQL query failed: " . mysqli_error($connection));
        }

        if(!empty($email_signin) && !empty($password_signin)){
            if(!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pswd)) {
                $wrongPwdErr = '<div class="alert alert-danger">
                        Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                    </div>';
            }
            // Check if email exist
            if($rowCount <= 0) {
                $accountNotExistErr = '<div class="alert alert-danger">
                        User account does not exist.
                    </div>';
            } else {
                // Fetch user data and store in php session
                while($row = mysqli_fetch_array($query)) {
                    $id            = $row['id'];
                    $firstname     = $row['fname'];
                    $lastname      = $row['lname'];
                    $pass_word     = $row['password_hash'];
                    $salt     = $row['password_salt'];
                    $email         = $row['email'];
                    $role   = $row['role'];
                }
                
                if($email_signin == 'admin@admin.com'){
                     if($email_signin == $email && $password_signin == 'admin') {
                      
                       
                       $_SESSION['id'] = $id;
                       $_SESSION['firstname'] = $firstname;
                       $_SESSION['lastname'] = $lastname;
                       $_SESSION['email'] = $email;
                       $_SESSION['role'] = $role;
                        
                         header("Location: ./dashboard.php");

                    }
                    else {
                        $emailPwdErr = '<div class="alert alert-danger">
                                Either email or password is incorrect.
                            </div>';
                    }
                }
                else if($email_signin == 'user@user.com'){
                   if($email_signin == $email && $password_signin == 'user') {
                      
                       
                       $_SESSION['id'] = $id;
                       $_SESSION['firstname'] = $firstname;
                       $_SESSION['lastname'] = $lastname;
                       $_SESSION['email'] = $email;
                       $_SESSION['role'] = $role;
                        
                         header("Location: ./dashboard.php");

                    }
                    else {
                        $emailPwdErr = '<div class="alert alert-danger">
                                Either email or password is incorrect.
                            </div>';
                    } 
                }
                else{
                // Verify password
                $password = crypt($password_signin, $salt);

                // Allow only verified user
               
                    if($email_signin == $email && $pass_word == $password) {
                      
                       
                       $_SESSION['id'] = $id;
                       $_SESSION['firstname'] = $firstname;
                       $_SESSION['lastname'] = $lastname;
                       $_SESSION['email'] = $email;
                       $_SESSION['role'] = $role;
                        
                         header("Location: ./dashboard.php");

                    } else {
                        $emailPwdErr = '<div class="alert alert-danger">
                                Either email or password is incorrect.
                            </div>';
                    }
                
                }
                } 

            }

        } else {
            if(empty($email_signin)){
                $email_empty_err = "<div class='alert alert-danger email_alert'>
                            Email not provided.
                    </div>";
            }
            
            if(empty($password_signin)){
                $pass_empty_err = "<div class='alert alert-danger email_alert'>
                            Password not provided.
                        </div>";
            }            
        }

    

?>    