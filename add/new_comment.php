<?php

session_start(); 
if (!isset($_SESSION['username'])) {
    echo "<script>alert('You have to login first!');window.location.href='/main/login.php';</script>";
}

$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'testdb') or die("Connect failed to Database! ");

$id = $_GET['id'];
$username = $_SESSION['username'];


if (isset($_POST['submit_post'])) {
  
    $comment = mysqli_real_escape_string($db, $_POST['comment']);
    if (empty($comment)) { array_push($errors, "Comment is required"); }
  
    if (count($errors) == 0) {
      
        $query = "INSERT INTO comments(post_id, username, comment) VALUES ('$id','$username','$comment')";
        
        mysqli_query($db, $query);
        header('location: /Main/hotel_list/hotel_one.php?id='.$id);
    }
  }

?>
  
<!DOCTYPE html>
<html>
    <head>
        <title>Hotel Review</title>

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    </head>
    <body>
		
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">   
                    <a class="navbar-brand" href="../index.php">
                        <i class="fas fa-image"></i>
                        Hotel Review
                      </a>
                      <ul class="nav navbar-nav navbar-right">
                        <!-- <li><a href="#"> Sign Up</a></li>
                        <li><a href="#"> Login</a></li> -->
                      </ul>
            </div>  
        </nav>
		
	<div class="container">
        
			
			
    </div>


<!-- Comment NEW PAGE -->

<div class="container">
    <div class="row" style="display: inline;">
        <h1 style="text-align: center">Add New Comment </h1>
        <div style="width: 30%; margin: 25px auto;">
            <form action="#" method="POST">
                <div class="form-group">
                    <input class="form-control" type="text" name="comment" placeholder="Text">
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
            <a href="javascript:history.back()">Go Back</a>
        </div>
    </div>
</div>

    </body>
</html>