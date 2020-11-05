<?php
    include("config.php");
    if(isset($_POST['submit']))
    {
        $name = $_POST['inputName'];
        $bloodGroup = $_POST['blood_group'];
        $email = $_POST['inputEmail'];
        $phone = $_POST['inputPhone'];
        $password = $_POST['inputPassword'];
        $address = $_POST['inputAddress'];
        $state = $_POST['inputState'];
        $city = $_POST['inputCity'];
        $zip = $_POST['inputZip'];
        $dob = $_POST['inputDob'];

        /*Checking if already exists*/
        $query2 = "SELECT id from receivers WHERE email = '$email'";
        $res = mysqli_query($con,$query2);
        $row = mysqli_num_rows($res);
        if($row>0)
        {
            $message = "Already Exists";
        }
        else
        {
            /*password hash function is taken from php website*/
            $pass = password_hash($password, PASSWORD_BCRYPT);

            $query1 = "INSERT INTO receivers (name,blood_group,dob,email,phn_no,password,address,state,city,zip)VALUES('$name','$bloodGroup','$dob','$email','$phone','$pass','$address','$state','$city','$zip')";

            $result = mysqli_query($con,$query1);
            if($result!=null)
            {
                echo '<script language="javascript">alert("Successfully Registered");</script>';
                header("location:login_as_receiver.php");
            }
            else
                echo 'error';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receiver Registration</title>
    <link rel="stylesheet" href="assets\css\index.css">
    <style>
        .card{
            border-radius:1rem !important;
            max-width:30rem;
            background-color:#edf0ef !important;
            margin-bottom: 05rem;
        }
        .btn{
            color:white !important;
            background-color:red !important;
        }
        .btn:hover{
            background-color: rgb(216, 39, 39);
        }
        .card-title{
            color:white;
            background-color:rgb(216, 39, 39);
            padding:2rem;
            border-radius: 1rem 1rem;
            font-weight:bold;
        }


    </style>
</head>

<?php include('header.php') ?>
<body>
    <div class="showcase-hospital-registration">
        <div class="showcase-hospital-registration-content">
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="card card-main mx-auto">
                            <div class="card-body" id="form-wrapper">
                                <h5 class="card-title text-center">RECEIVER REGISTRATION</h5>
                                <h4 style="color:red;" class="text-center"><?php echo $message ?></h4>
                                <form action="" method="post" name="receiverRegistration" onsubmit="return validateForm()">
                                    <div class="form-group">
                                        <label for="inputName">Name of The Receiver*</label>
                                        <input type="text" class="form-control" name="inputName" id="inputname" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputBloodGroup">Select Blood Group*</label>
                                        <select id="inputBloodGroup" name="blood_group" class="form-control" required>
                                            <option selected>Choose...</option>
                                            <option>A+</option>
                                            <option>B+</option>
                                            <option>AB+</option>
                                            <option>O+</option>
                                            <option>A-</option>
                                            <option>B-</option>
                                            <option>AB-</option>
                                            <option>O-</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDob">Dob</label>
                                        <input type="date" class="form-control" name="inputDob" id="inputDob">
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail">Email*</label>
                                        <input type="email" class="form-control" name="inputEmail" id="inputEmail" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPhone">Contact No</label>
                                        <input type="text" class="form-control" name="inputPhone" id="inputPhone">
                                        <small class="form-text text-muted">Just provide 10 digit contact no.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputPassword">Password*</label>
                                        <input type="password" class="form-control" name="inputPassword" id="inputPassword" required>
                                        <small class="form-text text-muted">Password length must be greater than or equal 8</small>
                                    </div>
                                
                                    <div class="form-group">
                                        <label for="inputAddress">Address</label>
                                        <input type="text" class="form-control" name="inputAddress" id="inputAddress" >
                                    </div>
                                    <div class="form-group">
                                        <label for="inputState">State*</label>
                                        <select id="inputState" name="inputState" class="form-control" required>
                                        <!-- options taken from https://www.codentricks.com/indian-states-and-union-territories-drop-down-list-html-ascending-order/  -->
                                            <option selected>Choose...</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chandigarh">Chandigarh</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                                            <option value="Daman and Diu">Daman and Diu</option>
                                            <option value="Delhi">Delhi</option>
                                            <option value="Lakshadweep">Lakshadweep</option>
                                            <option value="Puducherry">Puducherry</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputCity">City*</label>
                                        <input type="text" class="form-control" name="inputCity" id="inputCity" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputZip">Zip*</label>
                                        <input type="text" class="form-control" name="inputZip" id="inputZip" required>
                                    </div>
                                   
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-danger">Register</button>
                                    </div>
                                    
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src = ./assets/js/formValidation.js></script>
</body>
<?php include('footer.php') ?>
</html>
