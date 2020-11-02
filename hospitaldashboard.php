<?php
        session_start();
        if (isset($_SESSION['email'])) {
            $sessionMail = $_SESSION['email'];
            include "conn.php";
            $fetchIdquery = "SELECT * FROM hospitalregister WHERE email = '$sessionMail'";
            $fetchIdRaw = mysqli_query($conn,$fetchIdquery);
            $row = mysqli_fetch_assoc($fetchIdRaw);
            $rowId = $row['id'];
            $_SESSION['userId'] = $rowId;
            $hid = $row['id'];
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Hospital Home</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>

        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
            <li class="nav-item navbar-brand">
                <a class="navbar-brand" href="#"><?php 
            echo $row['name']; 
            // echo $row['id'];
            ?></a>
            </li>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="patient.php">Add a Patient</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="plasmadonors.php">Donors</a>
                </li>

                <li class="nav-item">
                    <!-- <a class="nav-link" href="patientsreports.php"></a>  reports page -->
                </li>
            </ul>
            <li class="navbar-nav ml-auto">
                <a class="nav-link" href="logout.php">
                    <span class="">Logout</span>
                </a>
            </li>    
        </nav>




        <div class="container-fluid border"><h3>
            <?php echo $row['name']; ?> 's Dashboard</h3>
            </div>
                <div class="container-fluid">
                <?php 
                echo "Hospital id : ";
                echo $row['id'];
                echo " All Patients belong to : ";
                echo $row['drname'];
                echo ",<br> From ";
                echo $row['name'];  
                echo "'s Dashboard";
                ?></div>

        <?php
            include "conn.php";
            $hid = $_SESSION['hid'];
        

            if(isset($_POST['query'])){
                $s = $_POST['query'];
                    echo $s;
                $patients = "SELECT * FROM users WHERE type = 'patient'  AND hid = '$hid' AND email LIKE '%$s%' ";
                $result = mysqli_query($conn,$patients);
            } else {
                $patients = "SELECT * FROM users WHERE type = 'patient' AND hid = '$hid' ";
                $result = mysqli_query($conn,$patients);
            }
            


            $res = "SELECT COUNT(*) as total FROM users WHERE type = 'patient' AND recovered_on != '' AND hid = '$hid' ";
            $result1 = mysqli_query($conn,$res);


            $res2 = "SELECT COUNT(*) as total FROM users WHERE type = 'patient' AND hid = '$hid' AND recovered_on = '0000-00-00' ";
            $result2 = mysqli_query($conn,$res2); 
 
            
            $res3 = "SELECT COUNT(*) as total FROM users WHERE type = 'patient' AND hid = '$hid' And plasma_recieved = NULL AND recovered_on = NULL ";
            $result3 = mysqli_query($conn,$res3);

            
            //$orderDetailsAssoc = mysqli_fetch_assoc($rawData);
            //var_dump($orderDetailsAssoc);
                    echo mysqli_error($conn);
                if (mysqli_num_rows($result) == 0) {
                    echo "No Patients yet";
                    
                }else {
                       
                   
        ?>
        <div class="ml-4">
        <br>
            <h2>List of Patients</h2>
            <br>
            <div class="container mt-3 border">
                <div class="row justify-content-md-center">
                    <div class="col-6 col-sm-4">Recovered Patients</div>
                        <div class="col-6 col-sm-4">Under Recovery</div>
                            <div class="col-6 col-sm-4">Total Patients</div>

                            <!-- Force next columns to break to new line -->
                            <div class="w-100"></div>
                           
                            <div class="col-6 col-sm-4"><b><?php $data = mysqli_fetch_assoc($result1); echo '<span class="badge badge-success">'. $data['total'] .'</span>' ?> </b></div>
                        <div class="col-6 col-sm-4"><b><?php $data = mysqli_fetch_assoc($result2); echo '<span class="badge badge-warning">'. $data['total'] .'</span>' ?></b></div>
                    <div class="col-6 col-sm-4"><b><?php $data = mysqli_fetch_assoc($result3); echo '<span class="badge badge-danger">'. $data['total'] .'</span>' ?></b></div>
                </div>
            </div>
        </div>
                    <!-- search -->
        <form method="POST" actions="hospitaldashboard.php">
            <div class="form-group px-5">
            <label for="usr">Search</label>
            <input type="text" class="form-control" name="query" placeholder="Search by email">

            <button type="submit" name="search" value="search" class="btn btn-success">Search</button>
            </div>
        </form>           

            
        <div class="container-fluid table-responsive-md">
            <table class="table ">
                <thead class="thead-inverse">
                    <tr>
                        <th>  </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Blood group</th>
                        <th>plasma</th>
                        <!-- <th>Phone</th>
                        <th>Address</th>
                        <th>pincode</th>
                        <th>Aadhar</th> -->
                        <th>Covid_report</th>
                        <th>Plasma Recieved</th>
                        <th>Recovered_on</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
    
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                                $rowColor = '';
                                $status = '';
                                $statusColor = '';
                      
                                if($row['plasma_recieved'] == null && $row['recovered_on'] == null) {
                                    $rowColor = "table-danger";
                                    $status = "Reported";
                                    $statusColor = "badge-danger";
                                } else if($row['plasma_recieved'] != null && $row['recovered_on'] == '0000-00-00') {
                                    $rowColor = "table-warning";
                                    $status = "Under Recovery";
                                    $statusColor = "badge-warning";
                                } 
                                else {
                                    $rowColor = "table-success";
                                    $status = "Recovered";
                                    $statusColor = "badge-success";   
                                }
                        ?>


                        <tr class="<?php echo $rowColor;  ?>">
                        <td><a href="patientupdate.php?patientid=<?php echo $row['id'] ?>" class="btn btn-dark btn-sm" role="button">Update</a></td>
                        <!-- <td><a href="deletepatient.php?patientid=<?php echo $row['id'] ?>" class="btn btn-danger btn-sm" role="button">Delete</a></td> -->
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['blood_group']; ?></td>
                            <td><?php echo $row['plasma']; ?></td>
                            <!-- <td><?php echo $row['phone']; ?></td>
                            <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['pincode']; ?></td>
                            <td><?php echo $row['aadhar']; ?></td> -->
                            <td><?php echo $row['covid_report']; ?></td>
                            <td><?php if($row['plasma_recieved'] == null) {echo "NULL";} else {echo $row['plasma_recieved'];}  ?></td>
                            <td><?php if($row['recovered_on'] == null) {echo "NULL";} else {echo $row['recovered_on'];} ?></td>
                            <td><span class="badge <?php echo $statusColor; ?>"><?php echo $status; ?></span></td>
                        </tr>

                    <?php
                            }
                    ?>
                        
                    </tbody>
            </table>
        </div>
        <?php
            }
        ?>


        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>

<?php
        }else {
            header("location:index.php");
        }

?>