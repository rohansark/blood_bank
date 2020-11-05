<?php 
    include("config.php"); 
    $email = $_SESSION['email'];
  
     /* Fetching requested samples info */
     $query = "SELECT * FROM requested_samples WHERE requested_by = '$email' ORDER BY id desc";
     $result = mysqli_query($con,$query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My requests</title>
    <link rel="stylesheet" href="assets\css\index.css">
    <style>
        .card-title{
            color:white;
            background-color:rgb(216, 39, 39);
            padding:1rem;
            border-radius: 4rem;
            font-weight:bold;
        }


    </style>
</head>
<?php include("header.php"); ?>
<body>
    <div class="showcase-hospital-registration">
        <div class="showcase-view-request-content">
            <div class="container">
                <div class="table-div mx-auto text-center table-striped">
                    <div class="table-responsive">
                        <h3 class="text-center hero">MY REQUESTS</h3>
                        <table class="table table-bordered">
                            <thead class="thead-red">
                                <th scope="col">Serial No.</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Hospital Name</th>
                                <th scope="col">Request Date</th>
                            </thead>
                            <tbody class="tbody-white">
                                
                                <?php
                                    $i = 1;
                                    if(mysqli_num_rows($result)>=1)
                                    {
                                        while($row = $result->fetch_assoc())
                                        {
                                            $regNo = $row['registration_no'];
                                            /*Fetching Hospital Name */
                                            $query1 = "SELECT hospital_name FROM hospitals WHERE registration_no = '$regNo'";
                                            $hospitalNameResult = mysqli_query($con,$query1);
                                            $row2 = $hospitalNameResult -> fetch_assoc();

                                            /* Changing date format to dd-mm-yyyy Taken from Stack Overflow*/
                                            $date = date("d-m-Y", strtotime($row['request_date']));

                                            echo '
                                            <tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$row['blood_group'].'</td>
                                            <td>'.$row2['hospital_name'].'</td>
                                            <td>'.$date.'</td>
                                            </tr>';
                                            $i++;
                                        }
                                    }
                                    else
                                        echo '<tr>
                                        <td colspan="4">No records to show</td>
                                        </tr>';
                                   

                                ?>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
    
</body>
<?php include("footer.php");?>
</html>