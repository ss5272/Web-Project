<?php

session_start();

  if (!isset($_SESSION['username'])) {
    echo "<script>alert('You have to login first!');window.location.href='/main/login.php';</script>";
  }

$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'testdb') or die("Connect failed to Database! ");;

if (isset($_POST['submit_post'])) {
  
  $name = mysqli_real_escape_string($db, $_POST['name']);
  $image = mysqli_real_escape_string($db, $_POST['image']);
  $description = mysqli_real_escape_string($db, $_POST['description']);

  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($image)) { array_push($errors, "Image is required"); }
  if (empty($description)) { array_push($errors, "Description is required"); }

  if (count($errors) == 0) {
    
    $query = "INSERT INTO posts (name, image, description) VALUES ('$name', '$image', '$description')";
    
    mysqli_query($db, $query);

  	header('location: /Main/index.php');
  }
}

?>



<!DOCTYPE html>

<html>
    <head>
        <title>Hotel Review</title>
        <link rel="stylesheet" href="main.css">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    </head>
    <body>
		
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">   
                    <a class="navbar-brand" href="/Main/index.php">
                        <i class="fas fa-image"></i>
                        Hotel Review
                      </a>
                      <ul class="nav navbar-nav navbar-right">
                      </ul>
            </div>  
        </nav>
		
	<div class="container">
        
			
			
    </div>


<!-- Hotel Review NEW PAGE -->

<div class="container">
    <div class="row" style="display: inline;">
        <h1 style="text-align: center">Create a New Hotel Review</h1>
        <div style="width: 30%; margin: 25px auto;">
            <form action="new.php" method="POST">
                <div class="form-group">
                    <input class="form-control" type="text" name="name" placeholder="Hotel Name">
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="image" placeholder="Image url">
                </div>
				<div class="form-group">
                    <input class="form-control" type="text" name="description" placeholder="Description">
                </div>

                <?php  if (count($errors) > 0) : ?>
                    <div class="error" style="color:red;">
                        <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                        <?php endforeach ?>
                    </div>
                <?php  endif ?>

                <div class="form-group">
                    <button class="btn btn-lg btn-primary btn-block" name="submit_post">Submit!</button>
                </div>
            </form>
            <a href="/Main/index.php">Go Back</a>
        </div>
    </div>
</div>



    </body>
</html>