<?php

session_start();

$username = "";
$email    = "";
$errors = array(); 

$db = mysqli_connect('localhost', 'root', '', 'testdb') or die("Connect failed to Database! ");

if (isset($_POST['reg_user'])) {
  
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $mobile = mysqli_real_escape_string($db, $_POST['mobile']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $birthday = mysqli_real_escape_string($db, $_POST['birthday']);
  $gender = mysqli_real_escape_string($db, $_POST['gender']);

  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }
  if (empty($mobile)) { array_push($errors, "Mobile is required"); }
  if (empty($birthday)) { array_push($errors, "Birthday is required"); }

  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { 
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Email already exists");
    }
  }

  if (count($errors) == 0) {
  	$password = md5($password_1);
    
    $query = "INSERT INTO users (email, username, mobile, password, birthday, gender) VALUES ('$email', '$username', '$mobile', '$password', '$birthday', '$gender')";
    
    mysqli_query($db, $query);
      
  	$_SESSION['username'] = $username;
  	// $_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
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
    
    <div class="form-body">

        <div class="container">

            <div class="header">
                <h2>Create Account</h2>
            </div>
    
            <form id="form" class="form" action="signup.php" method="POST">

                <div class="form-group">
                    <label for="username">Email</label>
                    <input class="form-control" type="email" placeholder="example@gmail.com" name="email" />
                </div>
                
                <div class="form-group">
                    <label for="username">Username</label>
                    <input class="form-control" type="text" placeholder="NewUser123" name="username" />
                </div>
               
                <div class="form-group">
                    <label for="mobile">Mobile</label>
                    <input class="form-control" type="tel" placeholder="+91 9654022038" name="mobile" />
                </div>
                
                <div class="form-group">
                    <label for="username">Password</label>
                    <input class="form-control" type="password" placeholder="Password" name="password_1"/>
                </div>
    
                <div class="form-group">
                    <label for="username">Re-type Password</label>
                    <input class="form-control" type="password" placeholder="Re-type Password" name="password_2"/>
                </div>

                <div class="form-group">
                    <label for="birthday">Birthday</label>
                    <input class="form-control" type="date" placeholder="Birthday" name="birthday"/>
                </div>

                <div style="justify-content: center;">
                    <label for="radio"><b>Male: </b></label> 
                    <input type="radio"  name="gender" value="male" required>
                    <label for="radio"><b>Female: </b></label> 
                    <input type="radio" name="gender" value="female">
                    <label for="radio"><b>Other: </b></label> 
                    <input type="radio" name="gender" value="other">
                </div>

                <div>
                    <input type="checkbox" name="terms" value="terms" required>
                    <label for="checkbox">Agree to terms and services.</label>
                </div>

                <?php  if (count($errors) > 0) : ?>
                    <div class="error" style="color:red;">
                        <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                        <?php endforeach ?>
                    </div>
                <?php  endif ?>
                
                <button type="submit" name="reg_user">Sign Up</button>
    
            </form>
    
        </div>

    </div>


    

</body>

</html>