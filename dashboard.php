<?php include('config.php'); 


if(!isset($_SESSION['id'])){
        header("Location: index.php");
    }

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>Dashboard</title>
    <!-- jQuery + Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>

<body>
     <!-- Header -->
    <?php include('header.php'); ?>

   
    <?php 
    $selectquery = "SELECT * FROM persons";
    ?>
    <div class="container mt-5">
        <div class="card">
           
             <div class="card-body">
                 <div class="card-title d-flex justify-content-between">
                      <h5 class="text-center mb-4">Users List</h5>
                     
                     <?php if($_SESSION['role'] == 'admin') { ?>
                  <a class="btn btn-warning"  href="adduser.php" role="button">Add New User</a>
                     <?php } ?>
                 </div>
                
                
                  
    <div class="row">
    <div class="col">
        <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
        <th scope="col">Role</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Address1</th>
        <th scope="col">Address2</th>
        <th scope="col">City</th>
        <th scope="col">State</th>
        <th scope="col">Zip Code</th>
    <?php if($_SESSION['role'] == 'admin') { ?>    <th scope="col">Options</th>
        <?php } ?>
    </tr>
  </thead>
  <tbody>
      <?php
      if ($result = mysqli_query($connection, $selectquery)) {
          while ($row = $result->fetch_assoc()) {
              
              $id     = $row["id"];
        $firstname     = $row["fname"];
        $lastname      = $row["lname"];
        $role      = $row["role"];      
        $email         = $row["email"];
        $mobilenumber  = $row["phone"];
        $address      = $row["address"];
        $address2      = $row["address2"];
        $city           = $row["city"];
        $state      = $row["state"];
        $zipcode      = $row["zip_code"];
      ?>
    <tr>
      <th scope="row"><?php echo $id ?></th>
        <td><?php echo $firstname ?></td>
      <td><?php echo $lastname ?></td>
        <td><?php echo $role ?></td>
         <td><?php echo $email ?></td>
      <td><?php echo $mobilenumber ?></td>
        <td><?php echo $address ?></td>
      <td><?php echo $address2 ?></td>
      <td><?php echo $city ?></td>
        <td><?php echo $state ?></td>
      <td><?php echo $zipcode ?></td>
        <td><?php if($_SESSION['role'] == 'admin') { ?>
            <a class="btn btn-outline-primary" href="edituser.php?id=<?php echo $id ?>" role="button">Edit</a>
           <a onClick="return confirm('Are you sure you want to delete <?php echo $firstname.' '.$lastname ?>')" class="btn btn-outline-danger" href="delete.php?id=<?php echo $id ?>" role="button">Delete</a>
      <?php } ?></td>
    </tr>
      
      <?php } 
       $result->free();
} 
      ?>
  </tbody>
</table>
        </div>
            </div>
    </div>
        </div>
    </div>
</body>

</html>