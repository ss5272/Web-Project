<?php

session_start(); 

$db = mysqli_connect('localhost', 'root', '', 'testdb') or die("Connect failed to Database! ");

$id = $_GET['id'];

$sql = "SELECT * FROM `posts` WHERE id =$id";
$result = mysqli_query($db, $sql);

$sql_comments = "SELECT * FROM `comments` WHERE post_id = $id";
$result_comments = mysqli_query($db, $sql_comments);

if (mysqli_num_rows($result) > 0) { 
    $row = mysqli_fetch_assoc($result);
}

// if (mysqli_num_rows($result_comments) > 0) { 
//     $row_comment = mysqli_fetch_assoc($result_comments);
// }

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Hotel Review</title>
        
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <link rel="stylesheet" href="main.css">
    </head>
    <body>
		
        <nav class="navbar navbar-dark bg-dark">
            <div class="container-fluid">   
                    <a class="navbar-brand" href="../index.php">
                        <i class="fas fa-image"></i>
                        Hotel Review
                      </a>
                      <ul class="nav navbar-nav navbar-right">
                        <a href="/main/add/new.php">Add New Review</a>
                        <?php  if (isset($_SESSION['username'])) : ?>
                            <span style="color:white;">Logged in as: <?php echo $_SESSION['username']; ?></span>
                        <?php endif ?>
                  </ul>
            </div>  
        </nav>
		


<div class="container">
    <div class="row">
        <div class="col-md-3">
            <p class="lead">Amenities</p>
            <div class="list-group">
                <li class="list-group-item"><i  class="material-icons md-18">ac_unit</i> AC</li>
                <li class="list-group-item"><i  class="material-icons md-18">tv</i> TV</li>
                <li class="list-group-item"><i  class="material-icons md-18">wifi</i> Free Wifi</li>
                <li class="list-group-item"><i  class="material-icons md-18">king_bed</i> King bed</li>
                <li class="list-group-item"><i  class="material-icons md-18">free_breakfast</i> Free breakfast</li>
                <li class="list-group-item"><i  class="material-icons md-18">power</i> Power Backup</li>
            </div>

            <div class="card" style="margin-top: 30px;">
                <div class="card-body">
                  <h5 class="card-title">Hotel policies</h5>
                  <p class="card-text" style="margin-left: 0;">
                      <ul style="padding-inline-start: 17px">
                          <li>Check-in time is 2 PM</li>
                          <li>Check-out time is 12 PM</li>
                          <li>Free parking service is available.</li>
                          <li>All credit cards are accepted at this property.</li>
                          <li>Pets are not allowed.</li>
                      </ul>
                  </p>
                </div>
              </div>

            <div class="card " style="margin-top: 30px;">
                <img class="card-img-top" src="https://www.thestatesman.com/wp-content/uploads/2020/04/googl_ED.jpg" alt="Card image cap">
                <div class="card-body">
                  <h5 class="card-title">Location</h5>
                  <p class="card-text">Dwarka Sector 9, Delhi.</p>
                </div>
              </div>

            
        </div>


        <div class="col-md-9">
            <div class="img-thumbnail">
                <img class="img-responsive" src=<?php echo $row["image"] ?>>
                <div class="caption">
                    <h5 class="text-right">₹1999/night</h5>
                    <h4><a><?php echo $row["name"] ?></a></h4>
                    <p><?php echo $row["description"] ?></p>
					  <p>	<em>Submitted By User</em> </p>
                </div>
            </div>


            <div class="comment">
                <div class="card bg-light p-3">
                    <div class="text-right">
                        <a class="btn btn-success" href="../add/new_comment.php?id=<?php echo $row["id"] ?>">Add New Comment</a>
                    </div>
                    <hr>
                    
                        <div class="row">
                            <div class="col-md-12">
                                <?php if (mysqli_num_rows($result_comments) > 0) { 
                                    while($row_comment = mysqli_fetch_assoc($result_comments)) { ?>
                                        <strong><?php echo $row_comment["username"]; ?></strong>
                                        <span class="pull-right">10 days ago</span>
                                        <p>
                                            <?php echo $row_comment["comment"]; ?>
                                        </p>
                                <?php } } ?>
                                
                            </div>
                        </div>
                </div>

            </div>

        </div>
    </div>
</div>


    </body>
</html>