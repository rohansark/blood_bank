<?php 
    include("config.php");
    $regNo = null;
    $email = null;
    if(!empty($_SESSION['regNo']) || !empty($_SESSION['email']))
    {
        $regNo = $_SESSION['regNo'];
        $email = $_SESSION['email'];
    }

    /*If not logged in, will be redirected to login page*/
    if(isset($_POST['submit-logout-members']))
    {
        header("location:login_as_receiver.php");
    }

    /*If user requests blood*/
    if(isset($_POST['submit-request']))
    {
        $hospitalName = $_POST['hospital_name'];
        $hospitalReg = $_POST['hospital_reg'];
        $bloodGroup = $_POST['blood_group'];
        $requestedBy = $_POST['requested_by'];

        /*Insert into requested samples table*/
        $query4 = "INSERT INTO requested_samples (hospital_name,registration_no,blood_group,requested_by) VALUES ('$hospitalName','$hospitalReg','$bloodGroup','$requestedBy')";

        mysqli_query($con,$query4);

        /*After requesting blood, 1 unit will be deducted from the total*/
        $query5 = "UPDATE available_samples SET quantity = quantity-1 WHERE registration_no = '$hospitalReg' AND blood_group = '$bloodGroup'";

        mysqli_query($con,$query5);

    }

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Blood Sample</title>
    <link rel="stylesheet" href="assets\css\index.css">
    <style>
        table{
            max-width:700px;
            padding-bottom:4rem;
        }
        .hospital-name{
            margin-top:1rem;
            color:white;
            padding: 0.5rem;;
            border-bottom: solid white 0.3rem;
            max-width:5rem;

        }
        .text-white{
            color:white;
        }
        .down-border{
            background-color:white;
            padding:0.01rem;
        }
    </style>
</head>
<?php include("header.php"); ?>
<body>
    <div class="showcase-hospital-registration">
        <div class="showcase-available-blood-content">
            <div class="container">
                <h3 class="text-center hero">AVAILABLE BLOOD SAMPLES</h3>
                <div class="table-div text-center">
                    <div class="table-responsive">

                        <?php 
                            /* If the user is logged in as a hospital */
                            if($regNo!=null && $email==null)
                            {
                                /*Fetching hospital_name and registration no */
                                $query1 = "SELECT hospital_name,registration_no FROM hospitals";
                                $result = mysqli_query($con,$query1);

                                /*Will create individual table for individual hospital*/
                                while($row = $result->fetch_assoc())
                                {
                                    $hospital_name = $row['hospital_name'];
                                    $hospital_reg = $row['registration_no'];
                                    $i=1;

                                    /*if any samples are present in the available_samples table then only the hospitals will be shown on the screen*/
                                    $query2 = "SELECT * FROM available_samples WHERE registration_no = '$hospital_reg'";
                                    $result2 = mysqli_query($con,$query2);
                                    if(mysqli_num_rows($result2)>0)
                                    {
                                        echo'<table class="table table-bordered mx-auto table-striped">
                                            <h4 class="text-center hospital-name">'.$hospital_name.'</h4>
                                            <hr style="height="0.2px;">
                                            <thead class="thead-red">
                                                <th scope="col">Serial No.</th>
                                                <th scope="col">Blood Group</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Request</th>
                                            </thead>
                                            <tbody class="tbody-white">
                                                
                                        ';
                                        /* This loop is for fetching all the blood samples available for a particular hospital*/
                                        while($row1 = $result2->fetch_assoc())
                                        {
                                            echo '<tr>
                                                    <th scope="row">'.$i.'</th>
                                                    <td>'.$row1['blood_group'].'</td>
                                                    <td>'.$row1['quantity'].'</td>
                                                    <td>Receivers Only</td>
                                                </tr>';
                                            $i++;
                                        }
                                        echo '</tbody>
                                        </table>';
                                    }
            
                                
                                }
                            }
                            /* If the user is a Receiver*/
                            else if($email!=null && $regNo==null)
                            {
                                 /*Fetching hospital_name and registration no */
                                 $query1 = "SELECT hospital_name,registration_no FROM hospitals";
                                 $result = mysqli_query($con,$query1);

                                 /*Fetching name and blood group */
                                 $query6 = "SELECT blood_group,name from receivers WHERE email='$email'";
                                 $result4 = mysqli_query($con,$query6);
                                 $row3 = $result4->fetch_assoc(); 

                                 echo '<h5 class="text-white">Hi '.$row3['name'].', You have '.$row3['blood_group'].'</h5>';
                                 echo '<p class="text-white">You can request blood samples which are compatible with your blood type.</p>';
                                 echo '<div class="down-border text-center"> </div>';
 
                                 /*Will create individual table for individual hospital*/
                                 while($row = $result->fetch_assoc())
                                 {
                                     $hospital_name = $row['hospital_name'];
                                     $hospital_reg = $row['registration_no'];
                                     $i=1;
                                     
                                     /*if any samples are present in the available_samples table then only the hospitals will be shown on the screen*/
                                     $query2 = "SELECT * FROM available_samples WHERE registration_no = '$hospital_reg'";
                                     $result2 = mysqli_query($con,$query2);  
                                     $query3 = "SELECT blood_group,name from receivers WHERE email='$email'";
                                     $result3 = mysqli_query($con,$query3);
                                     $row2 = $result3->fetch_assoc(); 
                                     $user_blood_group = $row2['blood_group'];
                                     
                            
                                     if(mysqli_num_rows($result2)>0)
                                     {
                                         echo'<table class="table table-bordered mx-auto table-striped">
                                             <h4 class="text-center hospital-name">'.$hospital_name.'</h4>
                                             <hr style="height="0.2px;">
                                             <thead class="thead-red">
                                                 <th scope="col">Serial No.</th>
                                                 <th scope="col">Blood Group</th>
                                                 <th scope="col">Quantity</th>
                                                 <th scope="col">Request</th>
                                             </thead>
                                             <tbody class="tbody-white">
                                          
                                         ';
                                         /* This loop is for fetching all the blood samples available for a particular hospital*/
                                         while($row1 = $result2->fetch_assoc())
                                         {
                                             $current_sample = $row1['blood_group'];
                                             $quantity_available = $row1['quantity'];
                                             if($quantity_available>0)
                                             {
                                                $form = '<tr>
                                                            <th scope="row">'.$i.'</th>
                                                            <td>'.$row1['blood_group'].'</td>
                                                            <td>'.$row1['quantity'].'</td>
                                                            <td>
                                                                <form method="post">
                                                                    <input type="hidden" name="hospital_reg" value="'.$hospital_reg.'">
                                                                    <input type="hidden" name="hospital_name" value="'.$hospital_name.'">
                                                                    <input type="hidden" name="blood_group" value="'.$row1['blood_group'].'">
                                                                    <input type="hidden" name="requested_by" value="'.$email.'">
                                                                    <button type="submit" name="submit-request" class="btn btn-danger btn-sm" onclick="requestFunction()">Request Sample</button>
                                                                </form>
                                                            </td>
                                                        </tr>';
                                                if($user_blood_group == "AB+")
                                                {
                                                    echo $form;
                                                    $i++;
                                                }
                                                else if($user_blood_group == "O-" && $current_sample=="O-")
                                                {
                                                    echo $form;
                                                    $i++;
                                                }
                                                else if($user_blood_group=="O+" && ($current_sample=="O-" || $current_sample=="O+"))
                                                {
                                                    echo $form;
                                                    $i++;
                                                }
                                                else if($user_blood_group=="B+" && ($current_sample=="O-" || $current_sample=="O+" ||$current_sample=="B-" ||$current_sample=="B+" ))
                                                {
                                                    echo $form;
                                                    $i++;
                                                }
                                                else if($user_blood_group=="A-" && ($current_sample=="O-" || $current_sample=="A-"))
                                                {
                                                    echo $form;
                                                    $i++;
                                                }
                                                else if($user_blood_group=="A+" && ($current_sample=="O-" || $current_sample=="O+" ||$current_sample=="A-" ||$current_sample=="A+" ))
                                                {
                                                    echo $form;
                                                    $i++;
                                                }
                                                else if($user_blood_group=="B-" && ($current_sample=="O-" || $current_sample=="B-"))
                                                {
                                                    echo $form;
                                                    $i++;
                                                }
                                                else if($user_blood_group=="AB-" && ($current_sample=="O-" || $current_sample=="A-" ||$current_sample=="B-" ||$current_sample=="AB-" ))
                                                {
                                                    echo $form;
                                                    $i++;
                                                }
                                                else
                                                {
                                                    echo '<tr>
                                                            <th scope="row">'.$i.'</th>
                                                            <td>'.$row1['blood_group'].'</td>
                                                            <td>'.$row1['quantity'].'</td>
                                                            <td>Can not Request</td>
                                                        </tr>';
                                                    $i++;
                                                }
                                            }
                                         }
                                         echo '</tbody>
                                         </table>';
                                     }
             
                                 
                                 }
                                
                            }
                            /* If the user is not logged in */
                            else
                            {
                                /*Fetching hospital_name and registration no */
                                $query1 = "SELECT hospital_name,registration_no FROM hospitals";
                                $result = mysqli_query($con,$query1);

                                /*Will create individual table for individual hospital*/
                                while($row = $result->fetch_assoc())
                                {
                                    $hospital_name = $row['hospital_name'];
                                    $hospital_reg = $row['registration_no'];
                                        $i=1;
                                    /*if any samples are present in the available_samples table then only the hospitals will be shown on the screen*/
                                    $query2 = "SELECT * FROM available_samples WHERE registration_no = '$hospital_reg'";
                                    $result2 = mysqli_query($con,$query2);
                                    if(mysqli_num_rows($result2)>0)
                                    {
                                        echo'<table class="table table-bordered mx-auto table-striped">
                                            <h4 class="text-center hospital-name">'.$hospital_name.'</h4>
                                            <hr style="height=1rem;">
                                            <thead class="thead-red">
                                                <th scope="col">Serial No.</th>
                                                <th scope="col">Blood Group</th>
                                                <th scope="col">Quantity</th>
                                                <th scope="col">Request</th>
                                            </thead>
                                            <tbody class="tbody-white">
                                                
                                        ';
                                        /* This loop is for fetching all the blood samples available for a particular hospital*/
                                        while($row1 = $result2->fetch_assoc())
                                        {
                                            echo '<tr>
                                                    <th scope="row">'.$i.'</th>
                                                    <td>'.$row1['blood_group'].'</td>
                                                    <td>'.$row1['quantity'].'</td>
                                                    <td><form method="post"><button type="submit" name="submit-logout-members" class="btn btn-danger btn-sm">Request Sample</button></form></td>
                                                </tr>';
                                            $i++;
                                        }
                                        echo '</tbody>
                                        </table>';
                                    }
            
                                
                                }
                            
                            }
                            
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function requestFunction(){
            window.alert("Confirm 1 unit request? ");
        }

    </script>
</body>
<?php include("footer.php");?>
</html>