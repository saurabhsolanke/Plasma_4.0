<?php
        session_start();
        if (isset($_SESSION['email'])) {
            include "conn.php";
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
                <a class="navbar-brand" href="hospitaldashboard.php"><?php 
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
            </ul>
            <li class="navbar-nav ml-auto">
                <a class="nav-link" href="logout.php">
                    <span class="">Logout</span>
                </a>
            </li>
                
        </nav>


            <div class="px-5 border mt-4"><h4>List Of Donors</h4>
            </div>

        <?php
            include "conn.php";
            $hid = $_SESSION['hid'];
            $patients = "SELECT u.id,u.name AS 'user.name',u.email,u.age,u.gender,u.blood_group,u.phone as 'user.phone', p.name, p.phone FROM users AS u, plasma_banks AS p Where u.pid = p.id AND type = 'donor'";
            $result = mysqli_query($conn,$patients);
            //$orderDetailsAssoc = mysqli_fetch_assoc($rawData);
            //var_dump($orderDetailsAssoc);
                    
                if (mysqli_num_rows($result) == 0) {
                    echo "No Donors yet";
                    echo mysqli_error($conn);
                }else {
                       
                   
        ?>

        <div class="px-5 table-responsive-md">
            <table class="table table-dark table-striped">
                <thead class="thead-inverse">
                    <tr>
                        <th>Donor ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Donor Contact</th>
                        <th>Blood Group</th>
                        <th>Plasma bank</th>
                        <th>Bank Contact</th>
                    </tr>
                    </thead>
                    <tbody>
    
                        <?php
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['user.name']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['age']; ?></td>
                            <td><?php echo $row['gender']; ?></td>
                            <td><?php echo $row['user.phone']; ?></td>
                            <td><?php echo $row['blood_group']; ?></td>
                            <td><?php echo $row['name']; ?></td>
                            <td><?php echo $row['phone']; ?></td>
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