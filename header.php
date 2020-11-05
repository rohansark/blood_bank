<?php
    include("config.php");
    error_reporting(0);
    $regNo = null;
    $email = null;
    if(!empty($_SESSION['regNo']) || !empty($_SESSION['email']))
    {
        $regNo = $_SESSION['regNo'];
        $email = $_SESSION['email'];
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloodmates.org</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/70f1960a74.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets\css\header.css">
	
	 <!--Favicon taken from Stack overflow-->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="red-divider"></div>

    <!-- Navbar  -->
    <nav class="navbar navbar-expand-lg sticky-top navbar-light bg-light">
        <a class="navbar-brand" href="index.php">
            <img src="images\logo.png" width="35" height="40" alt="" loading="lazy">
        </a>
        <a class="navbar-brand" href="index.php"><strong>BLOOD<span class="logo-red">MATES</span>.ORG</strong></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="available_blood_samples.php"> AVAILABLE BLOOD SAMPLES</a>

                <?php
                    /* Checking if hospital*/
                    if($regNo!=null && $email==null)
                    {
                        $query2 = "SELECT hospital_name from hospitals WHERE registration_no = '$regNo'";
                        $result1 = mysqli_query($con,$query2);
                        $row = $result1 ->fetch_assoc();

                        echo '<a class="nav-link" href="add_blood_info.php"> ADD BLOOD INFO</a>
                              <a class="nav-link" href="view_requests.php"> VIEW REQUESTS</a>
                        <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    ACCOUNT
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">'.$row['hospital_name'].'#</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">Log Out</a>
                                </div>
                            </li>';
                    }
                    /*Checking if receiver */
                    else if($email!=null && $regNo==null)
                    {
                        $query2 = "SELECT name from receivers WHERE email = '$email'";
                        $result1 = mysqli_query($con,$query2);
                        $row = $result1 ->fetch_assoc();

                        echo '<a class="nav-link" href="my_requests.php">MY REQUESTS</a>
                        <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            ACCOUNT
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">'.$row['name'].'#</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="logout.php">Log Out</a>
                        </div>
                    </li>';
                    }
                    /*Will be shown to everyone before login */
                    else
                    {
                        echo '
                        <a class="nav-link float-right" href="login_as_hospital.php">HOSPITAL LOGIN</a>
                        <a class="nav-link float-left" href="login_as_receiver.php">RECEIVER LOGIN</a>
                        <a class="nav-link float-left" href="register.php">REGISTER</a>';
                    }


                ?>
                
            </div>
        </div>
        
    </nav>
    <!-- navbar  -->
    


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>