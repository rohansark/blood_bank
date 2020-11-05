<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bloodmate | Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets\css\index.css">
    <style>
        .showcase {
            background: url("images/available_blood.png");
        }
    </style>
</head>
<?php include('header.php') ?>
<body>
        <div class="showcase">
            <div class="showcase-content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 card-icon text-center">
                            <div class="card text-center card-main mx-auto">
                                <div class="card-body">
                                    <i class="fas fa-hospital fa-4x"></i>
                                    <h5 class="card-title">Register As Hospital</h5>
                                    <a href="register_as_hospital.php" class="btn" role="button">Register</a>  
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="card text-center card-main mx-auto">
                                <div class="card-body">
                                    <i class="fas fa-vials fa-4x"></i>
                                    <h5 class="card-title">Available Blood Samples</h5>
                                    <a href="available_blood_samples.php" class="btn" role="button">See</a>                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 card-icon text-center">
                            <div class="card text-center card-main mx-auto">
                                <div class="card-body">
                                    <i class="fas fa-users fa-4x"></i>
                                    <h5 class="card-title">Register As Receiver</h5>
                                    <a href="register_as_receiver.php" class="btn" role="button">Register</a>                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mid-part">
                        <h2 class="text-center mid-heading">Learn More About Us</h2>
                        <a href="about_us.php" class="btn" role="button">Click Here</a>  
                    </div>
  
                </div>
            </div>
        </div>

    
</body>
<?php include('footer.php') ?>
</html>