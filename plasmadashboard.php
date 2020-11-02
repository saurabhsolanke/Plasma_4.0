<?php
        session_start();
        if (isset($_SESSION['email'])) {
            $pid = $_SESSION['pid'];
            $sessionMail = $_SESSION['email'];
            include "conn.php";
            $fetchIdquery = "SELECT * FROM plasma_banks WHERE email = '$sessionMail'";
            $fetchIdRaw = mysqli_query($conn,$fetchIdquery);
            $row = mysqli_fetch_assoc($fetchIdRaw);
            $rowId = $row['id'];
            $_SESSION['userId'] = $rowId;
            $pid = $row['id'];
?>

<!doctype html>
<html lang="en">
    <head>
        <title>plasma bank home</title>
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
                ?></a>
            </li>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="donor.php">Add a Donor</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="aboutus.php"></a>
                </li>
            </ul>
            <li class="navbar-nav ml-auto">
                <a class="nav-link" href="logout.php">
                    <span class="">Logout</span>   
                </a>
            </li>        
        </nav>


        <div class="container-fluid border"><h3>
            <?php echo $row['name']; ?> 's Dashboard with ID: <?php echo $pid; ?></h3>
        </div>
                <div class="container-fluid">
                <?php 
                echo "Plasma Bank id : ";
                echo $row['id'];
                echo " All Donors belong to : ";
                echo $row['name'];
                ?>
                </div>

        <?php
                    include "conn.php";
                    $donor = "SELECT * FROM users WHERE type = 'donor' AND pid = '$pid' ";
                    $result = mysqli_query($conn,$donor);

                    //$orderDetailsAssoc = mysqli_fetch_assoc($rawData);
                    //var_dump($orderDetailsAssoc);
                    
                    if (mysqli_num_rows($result) == 0) 
                    {
                        echo "No Donor yet";
                    }
                    else
                        {
        ?>
        
        <!-- <?php
                include "conn.php";
                $sort = "SELECT * FROM users WHERE type='donor' AND pid = '$pid' ORDER by 'age'";
                $sresult = mysqli_query($conn,$sort);
        ?> -->

       
            <div class="container">
            <h2>List Of Donors</h2></div>
            <div class="container">
            <button type="button" class="btn btn-success btn-sm">Sort by</button>
            </div>
            <table class="table">
                <thead class="thead-inverse">
                    <tr>
                        <th>  </th>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Blood group</th>
                        <th>Plasma</th>
                        <th>Phone</th>
                        <!-- <th>Address</th>
                        <th>pincode</th>
                        <th>Aadhar</th>
                        <th>Covid_report</th>
                        <th>Recovered_on</th>
                        <th>Plasma_donated</th> -->
                    </tr>
                    </thead>
                    <tbody>
    
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        
                        <tr>
                            <td><a href="donorupdate.php?donorid=<?php echo $row['id'] ?>" class="btn btn-info" role="button">Update</a></td>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['blood_group']; ?></td>
                            <td><?php echo $row['plasma']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
                            <!-- <td><?php echo $row['address']; ?></td>
                            <td><?php echo $row['pincode']; ?></td>
                            <td><?php echo $row['aadhar']; ?></td>
                            <td><?php echo $row['covid_report']; ?></td>
                            <td><?php echo $row['recovered_on']; ?></td>
                            <td><?php echo $row['plasma_donated']; ?></td> -->
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>

<?php
    }
        else 
        {
            header("location:index.php");
        }
?>