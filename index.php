<?php

session_start(); 


  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: index.php");
  }

$db = mysqli_connect('localhost', 'root', '', 'testdb') or die("Connect failed to Database! ");;

$sql = "SELECT * FROM posts";
$result = mysqli_query($db, $sql);

?>

<html>

<head>
<title>Hotel Review</title>
<link rel="stylesheet" href="style.css">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>


</head>


<body>

    <nav class="navbar navbar-dark bg-dark">
    	<div class="container-fluid">   
                <a class="navbar-brand" href="landing.html">
                    <i class="fas fa-image"></i>
                    Hotel Review
                  </a>
                  <ul class="nav navbar-nav navbar-right">
                    <a href="add/new.php">Add New Review</a>
                    <?php  if (isset($_SESSION['username'])) : ?>
                      <span style="color:white;">Logged in as: <?php echo $_SESSION['username']; ?></span>
                    <?php endif ?>
                  </ul>
		</div>  
    </nav>
    
    <div class="jumbotron jumbotron-fluid-">
        <div class="content">
            <h1 class="display-3">Welcome!</h1>
            <p class="lead">The best place to check all hotels prices and their reviews.</p>
            <?php  if (isset($_SESSION['username'])) : ?>
              <a href="index.php?logout='1'"><button class="btn btn-danger">Logout</button></a>
            <?php else: ?> 
              <a href="login.php"><button class="btn btn-primary">Login</button></a>
              <a href="signup.php"><button class="btn btn-success">Sign Up</button></a>
            <?php endif ?>
        </div>
    </div>

    <div class="container">

      <div class="row">
      
         <!-- HOTEL CARDS START HERE -->

          <?php if (mysqli_num_rows($result) > 0) { 
            while($row = mysqli_fetch_assoc($result)) { ?>

              <div class="col-lg-4 col-md-6 mb-3">
              <div class="card" style="width: 20rem;">
                <img class="card-img-top" src=<?php echo $row["image"] ?>>
                <div class="card-body">
                  <h5 class="card-title"><?php echo $row["name"] ?></h5>
                  <p class="card-text"><?php echo $row["description"] ?></p>
                  <a href="hotel_list/hotel_one.php?id=<?php echo $row["id"] ?>" class="btn btn-primary">More Details</a>
                </div>
              </div>
            </div>
          <?php  } } ?>    
          
         <!-- HOTEL CARD ENDS HERE -->

      </div>
    

    </div>

    <footer style="margin-left: 20px;"> 
      <hr>
      <a href="abstract.html"><h6>About</h6></a>
      <!-- <h6 >Shivendra  Rai</h6> -->
    </footer>  
    

</body>

</html>