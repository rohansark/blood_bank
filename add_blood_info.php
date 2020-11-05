<?php 
    include("config.php"); 
    $regNo = $_SESSION['regNo'];
    
     /* Fetching hospital name */
     $query4 = "SELECT hospital_name FROM hospitals WHERE registration_no = '$regNo'";
     $results = mysqli_query($con,$query4);
     $row2 = $results->fetch_assoc();
    if(isset($_POST['submit']))
    {
        $bloodGroup = $_POST['blood_group'];
        $quantity = $_POST['inputQuantity'];

        /*Checking if the blood group is already added then only quantity will be updated*/ 
        $query3 = "SELECT id FROM available_samples WHERE registration_no = '$regNo' AND blood_group = '$bloodGroup'";
        $res = mysqli_query($con,$query3);
        
        if(mysqli_num_rows($res)>0)
        {
            //Taken from w3schools
            $time = time();
            $date = date("Y-m-d",$time);
            $query2 = "UPDATE available_samples SET quantity = quantity+$quantity, last_updated_at = '$date' WHERE registration_no = '$regNo' AND blood_group = '$bloodGroup'";
            mysqli_query($con,$query2);
        }
        else
        {
            $query2 = "INSERT INTO available_samples(registration_no,blood_group,quantity)VALUES('$regNo','$bloodGroup',$quantity)";
            mysqli_query($con,$query2);
        }
        
    }
    if(isset($_POST['delete']))
    {
        $ids = $_POST['blood_id'];
        $query2 = "DELETE FROM available_samples WHERE id='$ids'";
        mysqli_query($con,$query2);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Blood Info</title>
    <link rel="stylesheet" href="assets\css\index.css">
    <style>
        .card{
            max-width: 500px;
            margin-top:4rem;
            border-radius:4rem;
        }
        #hospital-name{
            margin-top:2rem;
            color:white !important;
            border-bottom:0.2rem solid white;
            padding-bottom:0.4rem;
        }
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
        <div class="showcase-add-blood-info-content">
            <div class="container">
                <div class="row">
                    <div class="col mx-auto">
                        <div class="card card-form mx-auto">
                            <div class="card-body" id="form-wrapper">
                                <h5 class="text-center card-title">ADD BLOOD INFO</h5>
                                <hr>
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="inputBloodGroup">Select Blood Group</label>
                                            <select id="inputBloodGroup" name="blood_group" class="form-control">
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
                                        <label for="inputQuantity">Quantity</label>
                                        <input type="number" class="form-control" name="inputQuantity" id="inputQuantity" placeholder="Enter Quantity">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" name="submit" class="btn btn-danger">ADD</button>
                                        <!-- <p id="error"><strong><?php echo $error; ?></strong></p> -->
                                    </div>     
                                </form>
                          
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="table-div mx-auto text-center">
                    <h3 id="hospital-name" class="text-white"><?php echo $row2['hospital_name']; ?></h3>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead class="thead-red">
                                <th scope="col">Serial No.</th>
                                <th scope="col">Blood Group</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Last Added</th>
                                <th scope="col">Delete</td>
                            </thead>
                            <tbody class="tbody-white">
                                
                                <?php
                                    echo '<h1 class="text-white">'.$regNo.'</h1>';
                                    echo '<p style="color:white;">BLOOD SAMPLES</p>';

                                    /*Fetching all samples of a particular hospital*/
                                    $query1="SELECT * FROM available_samples WHERE registration_no = '$regNo'";
                                    $result = mysqli_query($con,$query1);
                                    $i = 1;
                                    if(mysqli_num_rows($result)>=1)
                                    {
                                        while($row = $result->fetch_assoc())
                                        {
                                            $lastUpdateDate = date("d-m-Y", strtotime($row['last_updated_at']));
                                            $blood_id = $row['id'];
                                            echo '
                                            <tr>
                                            <th scope="row">'.$i.'</th>
                                            <td>'.$row['blood_group'].'</td>
                                            <td>'.$row['quantity'].'</td>
                                            <td>'.$lastUpdateDate.'</td>
                                            <td><form method="post">
                                            <input type="hidden" name="blood_id" value="'.$blood_id.'">
                                            <button type="submit" class="btn btn-small btn-danger" name="delete" >Delete</button></form></td>
                                            </tr>';
                                            $i++;
                                        }
                                    }
                                    else
                                        echo '<tr class="text-center">
                                        <td colspan="5">No records to show</td>
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