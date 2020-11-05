<?php
    include("config.php");
    $error = "";
    if(isset($_POST['submit']))
    {
        $email = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];

       

        $query = "SELECT * FROM receivers WHERE email = '$email'";
        $result = mysqli_query($con,$query);
        $row = $result->fetch_assoc();

        /* Password Checking */

        $passwordCheck = password_verify($password, $row['password']);
        echo $passwordCheck;
        if($passwordCheck==1)
        {
            echo '<script language="javascript">alert("Successfully Logged in");</script>';
            $_SESSION['email'] = $row['email'];
            $_SESSION['isReceiver'] = true;
            header("location: available_blood_samples.php");

        }
        else
        {
            $error = "Invalid Login Credentials";
        }
    } 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receiver | Login</title>
    <link rel="stylesheet" href="assets\css\index.css">
    <link rel="stylesheet" href="assets\css\header.css">
    <style>
        .card{
            border-radius:0.5rem !important;
            max-width:30rem;
            background-color:#edf0ef !important;
            margin-bottom: 5rem;
            margin-top:3rem;
        }
        .btn{
            color:white !important;
            background-color:red !important;
        }
        .btn:hover{
            background-color: rgb(216, 39, 39);
        }
        #link{
            color:blue;
        }


    </style>
</head>

<?php include('header.php') ?>
<body>
    <div class="showcase-hospital-login">
        <div class="showcase-hospital-login-content">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="text-center">WELCOME TO <br>BLOODMATES</h1>
                    <p class="lead text-center">Your all information will be kept private</p>
                </div>
            </div>
            <div class="container">
            
                <div class="row">
                    <div class="col mx-auto">
                        <div class="card card-main mx-auto">
                            <div class="card-body" id="form-wrapper">
                                <h5>Receiver Login</h5>
                                <hr>
                            <form action="" method="post">
                                    <div class="form-group">
                                        <label for="inputEmail4">EMAIL</label>
                                        <input type="email" class="form-control" name="inputEmail" id="inputEmail4" placeholder="Enter email address">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword4">PASSWORD</label>
                                        <input type="password" class="form-control" name="inputPassword" id="inputPassword4" placeholder="Enter Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-danger">LogIn</button>
                                        <p id="error"><strong><?php echo $error; ?></strong></p>
                                        <p>If not registered - <a id="link" href="register_as_receiver.php"> Click Here</a></p>
                                    </div>
                                    
                                </form>
                          
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include('footer.php') ?>
</html>