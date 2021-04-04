

    if(isset($_SESSION['id'])){
        header("Location: dashboard.php");
    }
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="dashboard.php">User Management System</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02"
            aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor02">
            <ul class="navbar-nav ml-auto">
                
                <?php 

    if(isset($_SESSION['id'])){
       
        ?>
                <li class="nav-item">
                   <h5 style="color:#ffffff; margin-right:5px;"><?php echo $_SESSION['email'].'('.$_SESSION['role'] .')'; ?></h5>
                </li> 
                 <li class="nav-item" style="margin-right:5px;">
                    <a class="btn btn-success btn-block" href="edituser.php?id=<?php echo $_SESSION['id'] ?>">Edit Profile</a>
                </li>  
              <li class="nav-item">
                    <a class="btn btn-danger btn-block" href="logout.php">Log out</a>
                </li>  
                
   <?php }else { ?>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Sign in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php">Sign up</a>
                </li>
                
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>