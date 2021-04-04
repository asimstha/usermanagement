<?php include('update.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>User Registration</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
   
   <?php include('./header.php'); ?>

    <div class="App">
        <div class="vertical-center">
            <div class="inner-block">
                <form action="" method="post">
                    <h3>Edit Profile</h3>

                    <?php echo $success_msg; ?>
                    <?php echo $email_exist; ?>


                    <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <label>First name</label>
                        <input type="text" value="<?php echo $firstname ?>" class="form-control" name="firstname" id="firstName" />
                    </div>
                        </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <label>Last name</label>
                        <input type="text" value="<?php echo $lastname ?>" class="form-control" name="lastname" id="lastName" />
                    </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                     <select <?php if($_SESSION['role'] != 'admin') { ?> disabled <?php } ?> class="form-select form-control" aria-label="Default select example" name="role" id="role">
  
  <option <?php if($role == 'admin') { ?> selected <?php } ?> value="admin">admin</option>
  <option  <?php if($role == 'user') { ?> selected <?php } ?> value="user">User</option>
  
</select>
                    </div>

                    

                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" value="<?php echo $email ?>" class="form-control" name="email" id="email" />

                        <?php echo $_emailErr; ?>
                        <?php echo $emailEmptyErr; ?>
                    </div>

                    <div class="form-group">
                        <label>Phone</label>
                        <input type="text" value="<?php echo $mobilenumber ?>" class="form-control" name="mobilenumber" id="mobilenumber" />
                    </div>
                    
                    

                     <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <label>Address</label>
                        <input type="text" value="<?php echo $address ?>" class="form-control" name="address" id="address" />
                    </div>
                        </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                        <label>Address 2</label>
                        <input type="text" value="<?php echo $address2 ?>" class="form-control" name="address2" id="address2" />
                    </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                        <label>City</label>
                        <input type="text" value="<?php echo $city ?>" class="form-control" name="city" id="city" />
                    </div>
                        </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                        <label>State</label>
                        <input type="text" value="<?php echo $state ?>" class="form-control" name="state" id="state" />
                    </div>
                        </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="form-group">
                        <label>Zip Code</label>
                        <input type="text" value="<?php echo $zipcode ?>" class="form-control" name="zipcode" id="zipcode" />
                    </div>
                        </div>
                    </div>
                    

                    <button type="submit" name="update" id="update" class="btn btn-outline-primary btn-lg btn-block">Update User
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>