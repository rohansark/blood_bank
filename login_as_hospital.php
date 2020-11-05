<?php 
    include("config.php");
    $error = "";
    if(isset($_POST['submit']))
    {
        $regNo = $_POST['inputRegistrationNo'];
        $password = $_POST['inputPassword'];

        $query = "SELECT * FROM hospitals WHERE registration_no = '$regNo'";
        $result = mysqli_query($con,$query);
        $row = $result->fetch_assoc();

        /*Password checking */
        $passwordCheck = password_verify($password, $row['password']);
        if($passwordCheck==1)
        {
            
            $_SESSION['regNo'] = $row['registration_no'];
            $_SESSION['isHospital'] = true;
            header("location: add_blood_info.php");
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
    <title>Hospital | Login</title>
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
            color: blue;
        }
        


    </style>
</head>

<?php include('header.php') ?>
<body>
    <div class="showcase-hospital-login">
        <div class="showcase-hospital-login-content">
            <div class="jumbotron jumbotron-fluid">
                <div class="container">
                    <h1 class="text-center">WELCOME TO <br>BLOODMATE</h1>
                    <p class="lead text-center">Your all information will be kept private</p>
                </div>
            </div>
            <div class="container">
            
                <div class="row">
                    <div class="col-md mx-auto">
                        <div class="card card-main mx-auto">
                            <div class="card-body" id="form-wrapper">
                                <h5>Hospital Login</h5>
                                <hr>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="inputRegistrationNo">REG. NO</label>
                                        <input type="text" class="form-control" name="inputRegistrationNo" id="inputRegistrationNo" placeholder="Enter unique registration no.">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">PASSWORD</label>
                                        <input type="password" class="form-control" name="inputPassword" id="inputPassword" placeholder="Enter Password">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-danger">LogIn</button>
                                        <p id="error"><strong><?php echo $error; ?></strong></p>
                                        <p>If not registered - <a id="link" href="register_as_hospital.php"> Click Here</a></p>
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