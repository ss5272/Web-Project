<?php 

session_start();

$errors = array(); 
$db = mysqli_connect('localhost', 'root', '', 'testdb') or die("Connect failed to Database! ");

if(isset($_POST['login_user'])){
    
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password_1)) {
        array_push($errors, "Password is required");
    }

    if (count($errors) == 0) {
        $password = md5($password_1);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($db, $query);

        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }
        else{
            array_push($errors, "Wrong username/password combination");
        }
    }
        
}
?>

<html>

<head>
<title>Hotel Review</title>
<link rel="stylesheet" href="signup.css">

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

</head>


<body>

    <nav class="navbar navbar-dark bg-dark">
    	<div class="container-fluid">   
                <a class="navbar-brand" href="index.php">
                    <i class="fas fa-image"></i>
                    Hotel Review
                  </a>
                  <ul class="nav navbar-nav navbar-right">
                  </ul>
		</div>  
    </nav>


    <div class="form-body" style="min-height: 80vh;">

        <div class="container">

            <div class="header">
                <h2>Login Account</h2>
            </div>
    
            <form id="form" class="form" method="POST" action="#">

                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control"  type="text" placeholder="NewUser123" name="username"/>
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>
                
                <div class="form-group">
                    <label for="username">Password</label>
                    <input class="form-control" type="password" placeholder="Password" name="password">
                    <i class="fas fa-check-circle"></i>
                    <i class="fas fa-exclamation-circle"></i>
                    <small>Error message</small>
                </div>

                <?php  if (count($errors) > 0) : ?>
                    <div class="error" style="color:red;">
                        <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                        <?php endforeach ?>
                    </div>
                <?php  endif ?>
    
                
                <button name="login_user"> Login</button>
    
            </form>
    
        </div>

    </div>


    

</body>

<!-- <script type="text/javascript" src="signup.js"></script> -->

</html>